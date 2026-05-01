<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Http\Resources\YuanFlow\TransactionResource;
use App\Models\YuanFlow\ExchangeRate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * GET /api/v1/wallet/balance
     */
    public function balance(Request $request): JsonResponse
    {
        $user   = $request->user();
        $wallet = $user->wallet ?? $user->wallet()->create(['balance_xof' => 0, 'balance_cny' => 0]);
        $rate   = ExchangeRate::current('XOF', 'CNY');

        return response()->json([
            'success'       => true,
            'balance_xof'   => (float) $wallet->balance_xof,
            'balance_cny'   => (float) $wallet->balance_cny,
            'exchange_rate' => $rate ? [
                'rate'              => (float) $rate->rate,
                'change_percentage' => (float) $rate->change_percentage,
                'trend'             => $rate->trend,
                'updated_at'        => $rate->updated_at,
            ] : null,
        ]);
    }

    /**
     * GET /api/v1/wallet/transactions
     */
    public function transactions(Request $request): JsonResponse
    {
        $perPage = min((int) $request->query('limit', 10), 50);
        $type    = $request->query('type', 'all');

        $query = $request->user()
            ->transactions()
            ->with('recipient');

        if ($type !== 'all') {
            $query->where('payment_method', $type);
        }

        $paginator = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => TransactionResource::collection($paginator->items()),
            'meta'    => [
                'current_page' => $paginator->currentPage(),
                'total'        => $paginator->total(),
                'per_page'     => $paginator->perPage(),
                'last_page'    => $paginator->lastPage(),
            ],
        ]);
    }
}
