<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Models\YuanFlow\ExchangeRate;
use App\Models\YuanFlow\TransactionFee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * GET /api/v1/rates/current
     */
    public function current(): JsonResponse
    {
        $rate = ExchangeRate::current('XOF', 'CNY');

        if (!$rate) {
            return response()->json(['success' => false, 'message' => 'Aucun taux disponible.'], 404);
        }

        return response()->json([
            'success' => true,
            'xof_to_cny' => [
                'rate'              => (float) $rate->rate,
                'change_percentage' => (float) $rate->change_percentage,
                'trend'             => $rate->trend,
                'updated_at'        => $rate->updated_at,
            ],
        ]);
    }

    /**
     * GET /api/v1/rates/history?period=24h|7d|30d
     */
    public function history(Request $request): JsonResponse
    {
        $period = $request->query('period', '24h');

        $from = match ($period) {
            '7d'    => now()->subDays(7),
            '30d'   => now()->subDays(30),
            default => now()->subHours(24),
        };

        $rates = ExchangeRate::where('from_currency', 'XOF')
            ->where('to_currency', 'CNY')
            ->where('valid_from', '>=', $from)
            ->orderBy('valid_from')
            ->get(['rate', 'change_percentage', 'trend', 'valid_from']);

        return response()->json([
            'success' => true,
            'period'  => $period,
            'data'    => $rates->map(fn($r) => [
                'rate'              => (float) $r->rate,
                'change_percentage' => (float) $r->change_percentage,
                'trend'             => $r->trend,
                'timestamp'         => $r->valid_from,
            ]),
        ]);
    }

    /**
     * POST /api/v1/rates/calculate
     */
    public function calculate(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'from'   => 'required|string|size:3',
            'to'     => 'required|string|size:3',
        ]);

        $rate = ExchangeRate::current($request->from, $request->to);

        if (!$rate) {
            // Essai inverse
            $rateInverse = ExchangeRate::current($request->to, $request->from);
            if (!$rateInverse) {
                return response()->json(['success' => false, 'message' => 'Paire de devises non disponible.'], 404);
            }
            $effectiveRate = 1 / $rateInverse->rate;
        } else {
            $effectiveRate = $rate->rate;
        }

        $amount    = (float) $request->amount;
        $converted = round($amount / $effectiveRate, 2);
        $fee       = TransactionFee::calculate($request->from === 'XOF' ? $amount : $converted);

        return response()->json([
            'success'          => true,
            'amount'           => $amount,
            'from_currency'    => strtoupper($request->from),
            'to_currency'      => strtoupper($request->to),
            'converted_amount' => $converted,
            'rate'             => round($effectiveRate, 6),
            'fee'              => $fee,
            'total'            => $amount + $fee,
        ]);
    }
}
