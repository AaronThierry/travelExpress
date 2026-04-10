<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Models\YuanFlow\OtpCode;
use App\Models\YuanFlow\YfUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Envoyer un code OTP
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone'        => 'required|string|max:20',
            'country_code' => 'required|string|max:5',
            'type'         => 'required|in:registration,login,transaction,reset_pin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides', 'details' => $validator->errors()],
            ], 400);
        }

        $phone = $request->country_code . $request->phone;

        // Rate limiting : 3 OTP max par heure
        $recentCount = OtpCode::where('phone', $phone)
            ->where('created_at', '>', now()->subHour())
            ->count();

        if ($recentCount >= 3) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'OTP_RATE_LIMIT', 'message' => 'Trop de tentatives. Réessayez dans 1 heure.'],
            ], 429);
        }

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpCode::create([
            'phone'      => $phone,
            'code'       => $code,
            'type'       => $request->type,
            'expires_at' => now()->addMinutes(5),
        ]);

        // TODO: Envoyer SMS via Twilio / Orange SMS
        \Log::info("YuanFlow OTP for $phone: $code");

        return response()->json([
            'success' => true,
            'message' => 'Code OTP envoyé avec succès',
            'data'    => [
                'phone'      => $phone,
                'expires_in' => 300,
                'code'       => config('app.debug') ? $code : null,
            ],
        ]);
    }

    /**
     * Vérifier le code OTP
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone'        => 'required|string|max:20',
            'country_code' => 'required|string|max:5',
            'code'         => 'required|string|size:6',
            'type'         => 'required|in:registration,login,transaction,reset_pin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides'],
            ], 400);
        }

        $phone = $request->country_code . $request->phone;

        $otp = OtpCode::where('phone', $phone)
            ->where('type', $request->type)
            ->where('verified', false)
            ->latest()
            ->first();

        if (!$otp) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'INVALID_OTP', 'message' => 'Code OTP incorrect'],
            ], 400);
        }

        if ($otp->isExpired()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'OTP_EXPIRED', 'message' => 'Code OTP expiré'],
            ], 400);
        }

        if ($otp->attempts >= 3) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'OTP_MAX_ATTEMPTS', 'message' => 'Trop de tentatives'],
            ], 429);
        }

        $otp->increment('attempts');

        if ($otp->code !== $request->code) {
            return response()->json([
                'success' => false,
                'error'   => [
                    'code'    => 'INVALID_OTP',
                    'message' => 'Code OTP incorrect',
                    'details' => 'Il vous reste ' . (3 - $otp->attempts) . ' tentative(s)',
                ],
            ], 400);
        }

        $otp->update(['verified' => true, 'verified_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Code OTP vérifié',
            'data'    => ['verified' => true],
        ]);
    }

    /**
     * Finaliser l'inscription
     */
    public function completeRegistration(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone'        => 'required|string|max:20',
            'country_code' => 'required|string|max:5',
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'nullable|email|unique:yf_users,email',
            'pin'          => 'required|string|size:4|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides', 'details' => $validator->errors()],
            ], 400);
        }

        $phone = $request->country_code . $request->phone;

        // Vérifier OTP validé
        $otpVerified = OtpCode::where('phone', $phone)
            ->where('type', 'registration')
            ->where('verified', true)
            ->where('created_at', '>', now()->subMinutes(10))
            ->exists();

        if (!$otpVerified) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'OTP_NOT_VERIFIED', 'message' => 'Veuillez vérifier votre numéro de téléphone'],
            ], 400);
        }

        if (YfUser::where('phone', $phone)->exists()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'PHONE_ALREADY_EXISTS', 'message' => 'Ce numéro est déjà utilisé'],
            ], 409);
        }

        $user = YfUser::create([
            'phone'             => $phone,
            'country_code'      => $request->country_code,
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'             => $request->email,
            'pin_hash'          => Hash::make($request->pin),
            'phone_verified_at' => now(),
        ]);

        $token = $user->createToken('yf-auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie',
            'data'    => [
                'user'  => $this->formatUser($user),
                'token' => 'Bearer ' . $token,
            ],
        ], 201);
    }

    /**
     * Connexion avec PIN
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone'        => 'required|string|max:20',
            'country_code' => 'required|string|max:5',
            'pin'          => 'required|string|size:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides'],
            ], 400);
        }

        $phone = $request->country_code . $request->phone;
        $user  = YfUser::where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'INVALID_CREDENTIALS', 'message' => 'Identifiants incorrects'],
            ], 401);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'ACCOUNT_' . strtoupper($user->status), 'message' => 'Compte ' . $user->status],
            ], 403);
        }

        if (!$user->verifyPin($request->pin)) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'INVALID_PIN', 'message' => 'PIN incorrect'],
            ], 401);
        }

        $token = $user->createToken('yf-auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'data'    => [
                'user'  => $this->formatUser($user),
                'token' => 'Bearer ' . $token,
            ],
        ]);
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => true, 'message' => 'Déconnexion réussie']);
    }

    /**
     * Profil utilisateur connecté
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => ['user' => $this->formatUser($request->user())],
        ]);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    private function formatUser(YfUser $user): array
    {
        return [
            'id'                => $user->id,
            'phone'             => $user->phone,
            'first_name'        => $user->first_name,
            'last_name'         => $user->last_name,
            'email'             => $user->email,
            'kyc_status'        => $user->kyc_status,
            'biometric_enabled' => $user->biometric_enabled,
            'status'            => $user->status,
            'phone_verified_at' => $user->phone_verified_at,
        ];
    }
}
