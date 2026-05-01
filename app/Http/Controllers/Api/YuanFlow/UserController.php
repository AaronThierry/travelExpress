<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Http\Requests\YuanFlow\CompleteProfileRequest;
use App\Http\Requests\YuanFlow\SetPinRequest;
use App\Http\Resources\YuanFlow\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * GET /api/v1/user/profile
     */
    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'user'    => new UserResource($request->user()),
        ]);
    }

    /**
     * PUT /api/v1/user/profile
     */
    public function updateProfile(CompleteProfileRequest $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->only(['first_name', 'last_name', 'email', 'country']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('yf-avatars', 'public');
            $data['avatar_url'] = Storage::url($path);
        }

        $user->update($data);

        $user->update(['is_profile_complete' => $this->isProfileComplete($user)]);

        return response()->json([
            'success' => true,
            'user'    => new UserResource($user->fresh()),
        ]);
    }

    /**
     * POST /api/v1/user/set-pin
     */
    public function setPin(SetPinRequest $request): JsonResponse
    {
        $user = $request->user();

        if ($user->pin_hash && $request->filled('current_pin')) {
            if (!$user->verifyPin($request->current_pin)) {
                return response()->json(['success' => false, 'message' => 'PIN actuel incorrect.', 'code' => 'INVALID_PIN'], 401);
            }
        } elseif ($user->pin_hash && !$request->filled('current_pin')) {
            return response()->json(['success' => false, 'message' => 'Le PIN actuel est requis pour changer de PIN.'], 422);
        }

        $user->update(['pin_hash' => Hash::make($request->pin)]);

        return response()->json(['success' => true, 'message' => 'PIN défini avec succès.']);
    }

    /**
     * POST /api/v1/user/verify-pin
     */
    public function verifyPin(Request $request): JsonResponse
    {
        $request->validate(['pin' => 'required|string|size:4|regex:/^\d{4}$/']);

        $valid = $request->user()->verifyPin($request->pin);

        if (!$valid) {
            return response()->json(['success' => false, 'message' => 'PIN incorrect.', 'code' => 'INVALID_PIN'], 401);
        }

        return response()->json(['success' => true, 'message' => 'PIN vérifié.']);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    private function isProfileComplete($user): bool
    {
        return filled($user->first_name)
            && filled($user->last_name)
            && filled($user->email)
            && filled($user->country)
            && !is_null($user->pin_hash);
    }
}
