<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PinController extends Controller
{
    private const MAX_ATTEMPTS  = 3;
    private const LOCK_MINUTES  = 15;

    /**
     * POST /api/auth/pin/setup
     */
    public function setup(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pin'              => ['required', 'string', 'regex:/^\d{4}$/', 'confirmed'],
            'pin_confirmation' => ['required', 'string'],
        ], [
            'pin.regex'     => 'Le PIN doit contenir exactement 4 chiffres',
            'pin.confirmed' => 'La confirmation ne correspond pas',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Données invalides',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = $request->user();
        $user->update([
            'pin_hash'         => hash('sha256', $request->pin),
            'pin_set_at'       => now(),
            'pin_attempts'     => 0,
            'pin_locked_until' => null,
        ]);

        return response()->json([
            'message'    => 'PIN configuré avec succès',
            'pin_set_at' => $user->pin_set_at,
        ]);
    }

    /**
     * POST /api/auth/pin/verify
     */
    public function verify(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pin' => ['required', 'string', 'regex:/^\d{4}$/'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Données invalides', 'valid' => false], 422);
        }

        $user = $request->user();

        if ($user->pin_locked_until && Carbon::now()->lt($user->pin_locked_until)) {
            return response()->json([
                'message'      => 'Trop de tentatives. Réessayez dans ' . self::LOCK_MINUTES . ' minutes',
                'locked_until' => $user->pin_locked_until,
            ], 429);
        }

        if (!$user->pin_hash) {
            return response()->json(['message' => 'Aucun PIN configuré', 'valid' => false], 400);
        }

        if (hash('sha256', $request->pin) === $user->pin_hash) {
            $user->update(['pin_attempts' => 0, 'pin_locked_until' => null]);

            return response()->json(['message' => 'PIN vérifié avec succès', 'valid' => true]);
        }

        $attempts  = $user->pin_attempts + 1;
        $lockUntil = $attempts >= self::MAX_ATTEMPTS ? Carbon::now()->addMinutes(self::LOCK_MINUTES) : null;

        $user->update(['pin_attempts' => $attempts, 'pin_locked_until' => $lockUntil]);

        return response()->json([
            'message'           => 'PIN incorrect',
            'valid'             => false,
            'attempts_remaining' => max(0, self::MAX_ATTEMPTS - $attempts),
        ], 401);
    }

    /**
     * GET /api/auth/pin/status
     */
    public function status(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'pin_set'    => !is_null($user->pin_hash),
            'pin_set_at' => $user->pin_set_at,
        ]);
    }

    /**
     * POST /api/auth/pin/reset
     */
    public function reset(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'old_pin'             => ['required', 'string', 'regex:/^\d{4}$/'],
            'new_pin'             => ['required', 'string', 'regex:/^\d{4}$/', 'confirmed'],
            'new_pin_confirmation' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Données invalides', 'errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        if (hash('sha256', $request->old_pin) !== $user->pin_hash) {
            return response()->json(['message' => "L'ancien PIN est incorrect"], 401);
        }

        $user->update([
            'pin_hash'         => hash('sha256', $request->new_pin),
            'pin_set_at'       => now(),
            'pin_attempts'     => 0,
            'pin_locked_until' => null,
        ]);

        return response()->json(['message' => 'PIN réinitialisé avec succès']);
    }
}
