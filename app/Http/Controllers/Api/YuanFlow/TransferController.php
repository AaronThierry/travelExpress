<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Http\Requests\YuanFlow\InitiateTransferRequest;
use App\Http\Resources\YuanFlow\TransactionResource;
use App\Models\YuanFlow\ExchangeRate;
use App\Models\YuanFlow\TransactionFee;
use App\Models\YuanFlow\YfNotification;
use App\Models\YuanFlow\YfRecipient;
use App\Models\YuanFlow\YfTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * POST /api/v1/transfers/initiate
     */
    public function initiate(InitiateTransferRequest $request): JsonResponse
    {
        $user      = $request->user();
        $amountXof = (float) $request->amount_xof;

        $rate = ExchangeRate::current('XOF', 'CNY');
        if (!$rate) {
            return response()->json(['success' => false, 'message' => 'Taux de change indisponible.'], 503);
        }

        $fee       = TransactionFee::calculate($amountXof);
        $totalXof  = $amountXof + $fee;
        $amountCny = round($amountXof / $rate->rate, 2);

        // Vérifier solde
        $wallet = $user->wallet;
        if (!$wallet || $wallet->balance_xof < $totalXof) {
            return response()->json(['success' => false, 'message' => 'Solde insuffisant.', 'code' => 'INSUFFICIENT_BALANCE'], 422);
        }

        // Résoudre ou créer le destinataire
        $recipient = $this->resolveRecipient($user->id, $request);

        $transfer = YfTransaction::create([
            'transaction_ref'  => YfTransaction::generateRef(),
            'yf_user_id'       => $user->id,
            'yf_recipient_id'  => $recipient->id,
            'send_amount'      => $amountXof,
            'receive_amount'   => $amountCny,
            'exchange_rate'    => $rate->rate,
            'transfer_fee'     => $fee,
            'total_amount'     => $totalXof,
            'payment_method'   => $request->payment_method,
            'status'           => 'pending',
        ]);

        return response()->json([
            'success'  => true,
            'transfer' => [
                'id'                   => $transfer->id,
                'amount_xof'           => $amountXof,
                'amount_cny'           => $amountCny,
                'exchange_rate'        => (float) $rate->rate,
                'fee'                  => $fee,
                'total_xof'            => $totalXof,
                'status'               => 'pending',
                'estimated_completion' => now()->addHours(2)->toIso8601String(),
            ],
        ]);
    }

    /**
     * POST /api/v1/transfers/{id}/confirm
     */
    public function confirm(Request $request, int $id): JsonResponse
    {
        $request->validate(['pin' => 'required|string|size:4|regex:/^\d{4}$/']);

        $user     = $request->user();
        $transfer = YfTransaction::where('id', $id)->where('yf_user_id', $user->id)->firstOrFail();

        if ($transfer->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Ce transfert ne peut plus être confirmé.'], 422);
        }

        if (!$user->verifyPin($request->pin)) {
            return response()->json(['success' => false, 'message' => 'PIN incorrect.', 'code' => 'INVALID_PIN'], 401);
        }

        DB::transaction(function () use ($transfer, $user) {
            $wallet = $user->wallet;
            $wallet->debit((float) $transfer->total_amount);

            $transfer->update([
                'status'              => 'processing',
                'payment_completed_at' => now(),
            ]);

            // Simuler complétion (en prod: webhook Alipay/WeChat)
            $transfer->update([
                'status'             => 'completed',
                'payout_completed_at' => now()->addMinutes(rand(5, 30)),
            ]);

            YfNotification::create([
                'yf_user_id' => $user->id,
                'type'       => 'transfer_completed',
                'title'      => 'Transfert réussi',
                'message'    => "Votre transfert de {$transfer->receive_amount} CNY a été complété.",
                'data'       => ['transfer_id' => $transfer->id],
            ]);
        });

        $transfer->refresh();

        return response()->json([
            'success'  => true,
            'transfer' => [
                'id'          => $transfer->id,
                'status'      => $transfer->status,
                'receipt_url' => url("/api/v1/transfers/{$transfer->id}/receipt"),
            ],
        ]);
    }

    /**
     * GET /api/v1/transfers/{id}
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $transfer = YfTransaction::where('id', $id)
            ->where('yf_user_id', $request->user()->id)
            ->with('recipient')
            ->firstOrFail();

        return response()->json([
            'success'  => true,
            'transfer' => new TransactionResource($transfer),
        ]);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    private function resolveRecipient(int $userId, InitiateTransferRequest $request): YfRecipient
    {
        if ($request->filled('recipient_id')) {
            $r = YfRecipient::where('id', $request->recipient_id)->where('yf_user_id', $userId)->first();
            if ($r) {
                $r->touchLastUsed();
                return $r;
            }
        }

        $recipientData = $request->input('recipient', []);

        return YfRecipient::firstOrCreate(
            [
                'yf_user_id'     => $userId,
                'payment_method' => $request->payment_method,
                $request->payment_method === 'alipay' ? 'alipay_id' : 'wechat_id'
                    => $request->payment_method === 'alipay'
                        ? $recipientData['alipay_id']
                        : $recipientData['wechat_id'],
            ],
            [
                'name'      => $recipientData['name'] ?? 'Destinataire',
                'bank'      => $recipientData['bank'] ?? null,
                'last_used' => now(),
            ]
        );
    }
}
