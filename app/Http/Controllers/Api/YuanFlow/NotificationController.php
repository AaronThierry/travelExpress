<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Http\Resources\YuanFlow\NotificationResource;
use App\Models\YuanFlow\YfNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * GET /api/v1/notifications
     */
    public function index(Request $request): JsonResponse
    {
        $perPage       = min((int) $request->query('limit', 20), 50);
        $unreadOnly    = $request->boolean('unread_only', false);

        $query = $request->user()
            ->notifications()
            ->latest();

        if ($unreadOnly) {
            $query->whereNull('read_at');
        }

        $paginator = $query->paginate($perPage);

        return response()->json([
            'success'      => true,
            'data'         => NotificationResource::collection($paginator->items()),
            'unread_count' => $request->user()->notifications()->whereNull('read_at')->count(),
            'meta'         => [
                'current_page' => $paginator->currentPage(),
                'total'        => $paginator->total(),
                'per_page'     => $paginator->perPage(),
                'last_page'    => $paginator->lastPage(),
            ],
        ]);
    }

    /**
     * POST /api/v1/notifications/{id}/read
     */
    public function markRead(Request $request, int $id): JsonResponse
    {
        $notification = YfNotification::where('id', $id)
            ->where('yf_user_id', $request->user()->id)
            ->firstOrFail();

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * POST /api/v1/notifications/read-all
     */
    public function markAllRead(Request $request): JsonResponse
    {
        $request->user()
            ->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Toutes les notifications marquées comme lues.']);
    }
}
