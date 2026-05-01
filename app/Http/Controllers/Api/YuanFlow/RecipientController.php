<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Http\Requests\YuanFlow\SaveRecipientRequest;
use App\Http\Resources\YuanFlow\RecipientResource;
use App\Models\YuanFlow\YfRecipient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    /**
     * GET /api/v1/recipients
     */
    public function index(Request $request): JsonResponse
    {
        $recipients = $request->user()
            ->recipients()
            ->orderByDesc('is_favorite')
            ->orderByDesc('last_used')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => RecipientResource::collection($recipients),
        ]);
    }

    /**
     * POST /api/v1/recipients
     */
    public function store(SaveRecipientRequest $request): JsonResponse
    {
        $user = $request->user();

        $identifier = $request->payment_method === 'alipay'
            ? ['alipay_id' => $request->alipay_id]
            : ['wechat_id' => $request->wechat_id];

        $recipient = YfRecipient::firstOrCreate(
            array_merge(['yf_user_id' => $user->id, 'payment_method' => $request->payment_method], $identifier),
            [
                'name'      => $request->name,
                'bank'      => $request->input('bank'),
                'last_used' => now(),
            ]
        );

        if (!$recipient->wasRecentlyCreated) {
            $recipient->update(['name' => $request->name, 'bank' => $request->input('bank')]);
        }

        return response()->json([
            'success'   => true,
            'recipient' => new RecipientResource($recipient),
        ], $recipient->wasRecentlyCreated ? 201 : 200);
    }

    /**
     * DELETE /api/v1/recipients/{id}
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $recipient = YfRecipient::where('id', $id)
            ->where('yf_user_id', $request->user()->id)
            ->firstOrFail();

        $recipient->delete();

        return response()->json(['success' => true, 'message' => 'Destinataire supprimé.']);
    }

    /**
     * PATCH /api/v1/recipients/{id}/favorite
     */
    public function toggleFavorite(Request $request, int $id): JsonResponse
    {
        $recipient = YfRecipient::where('id', $id)
            ->where('yf_user_id', $request->user()->id)
            ->firstOrFail();

        $recipient->update(['is_favorite' => !$recipient->is_favorite]);

        return response()->json([
            'success'     => true,
            'is_favorite' => $recipient->is_favorite,
        ]);
    }
}
