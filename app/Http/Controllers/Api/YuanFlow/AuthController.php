<?php

namespace App\Http\Controllers\Api\YuanFlow;

use App\Http\Controllers\Controller;
use App\Http\Resources\YuanFlow\UserResource;
use App\Models\YuanFlow\YfUser;
use App\Services\YuanFlow\OtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(private OtpService $otpService) {}

    /**
     * POST /api/v1/auth/send-otp
     * Supporte phone et email comme canal
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'channel'      => 'required|in:phone,email',
            'phone'        => 'required_if:channel,phone|string|max:20',
            'country_code' => 'required_if:channel,phone|string|max:5',
            'email'        => 'required_if:channel,email|email|max:191',
            'type'         => 'required|in:registration,login,transaction,reset_pin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides', 'details' => $validator->errors()],
            ], 400);
        }

        $channel = $request->channel;
        $value   = $channel === 'email' ? $request->email : $request->country_code . $request->phone;

        $result = $this->otpService->send($channel, $value, $request->type);

        if (!$result['success']) {
            $status = $result['code'] === 'OTP_RATE_LIMIT' ? 429 : 400;
            return response()->json([
                'success' => false,
                'error'   => ['code' => $result['code'], 'message' => $result['message']],
            ], $status);
        }

        return response()->json([
            'success' => true,
            'message' => 'Code OTP envoyé avec succès',
            'data'    => [
                'channel'    => $channel,
                'expires_in' => $result['expires_in'],
                'code'       => $result['debug_code'],
            ],
        ]);
    }

    /**
     * POST /api/v1/auth/verify-otp
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'channel'      => 'required|in:phone,email',
            'phone'        => 'required_if:channel,phone|string|max:20',
            'country_code' => 'required_if:channel,phone|string|max:5',
            'email'        => 'required_if:channel,email|email|max:191',
            'code'         => 'required|string|size:6',
            'type'         => 'required|in:registration,login,transaction,reset_pin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides'],
            ], 400);
        }

        $channel = $request->channel;
        $value   = $channel === 'email' ? $request->email : $request->country_code . $request->phone;

        $result = $this->otpService->verify($channel, $value, $request->code, $request->type);

        if (!$result['valid']) {
            $status = $result['code'] === 'OTP_MAX_ATTEMPTS' ? 429 : 400;
            return response()->json([
                'success' => false,
                'error'   => ['code' => $result['code'], 'message' => $result['message']],
            ], $status);
        }

        return response()->json([
            'success' => true,
            'message' => 'Code OTP vérifié',
            'data'    => ['verified' => true],
        ]);
    }

    /**
     * POST /api/v1/auth/complete-registration
     */
    public function completeRegistration(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'channel'      => 'required|in:phone,email',
            'phone'        => 'required_if:channel,phone|string|max:20',
            'country_code' => 'required_if:channel,phone|string|max:5',
            'email'        => 'required_if:channel,email|email|unique:yf_users,email',
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'pin'          => 'required|string|size:4|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides', 'details' => $validator->errors()],
            ], 400);
        }

        $channel = $request->channel;
        $value   = $channel === 'email' ? $request->email : $request->country_code . $request->phone;

        // OTP must have been verified recently
        if (!$this->otpService->wasVerified($channel, $value, 'registration')) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'OTP_NOT_VERIFIED', 'message' => 'Veuillez vérifier votre ' . ($channel === 'email' ? 'adresse email' : 'numéro de téléphone')],
            ], 400);
        }

        // Prevent duplicate accounts
        if ($channel === 'phone') {
            $phone = $value;
            if (YfUser::where('phone', $phone)->exists()) {
                return response()->json([
                    'success' => false,
                    'error'   => ['code' => 'PHONE_ALREADY_EXISTS', 'message' => 'Ce numéro est déjà utilisé'],
                ], 409);
            }
        }

        $userData = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'pin_hash'   => Hash::make($request->pin),
        ];

        if ($channel === 'phone') {
            $userData['phone']             = $value;
            $userData['country_code']      = $request->country_code;
            $userData['phone_verified_at'] = now();
            if ($request->filled('email')) {
                $userData['email'] = $request->email;
            }
        } else {
            $userData['email']             = $value;
            $userData['email_verified_at'] = now();
            if ($request->filled('phone')) {
                $userData['phone']        = $request->country_code . $request->phone;
                $userData['country_code'] = $request->country_code;
            }
        }

        $user  = YfUser::create($userData);
        $token = $user->createToken('yf-auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie',
            'data'    => [
                'user'  => new UserResource($user),
                'token' => 'Bearer ' . $token,
            ],
        ], 201);
    }

    /**
     * POST /api/v1/auth/login
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'channel'      => 'required|in:phone,email',
            'phone'        => 'required_if:channel,phone|string|max:20',
            'country_code' => 'required_if:channel,phone|string|max:5',
            'email'        => 'required_if:channel,email|email',
            'pin'          => 'required|string|size:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Données invalides'],
            ], 400);
        }

        $channel = $request->channel;
        $user    = $channel === 'email'
            ? YfUser::where('email', $request->email)->first()
            : YfUser::where('phone', $request->country_code . $request->phone)->first();

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
                'user'  => new UserResource($user),
                'token' => 'Bearer ' . $token,
            ],
        ]);
    }

    /**
     * POST /api/v1/auth/email-login
     * Flux simplifié Flutter : email seul → token (PIN géré localement)
     */
    public function emailLogin(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email|max:191',
            'first_name' => 'nullable|string|max:100',
            'last_name'  => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'VALIDATION_ERROR', 'message' => 'Email invalide', 'details' => $validator->errors()],
            ], 400);
        }

        $isNewUser = false;
        $user = YfUser::where('email', $request->email)->first();

        if (!$user) {
            $isNewUser = true;
            $user = YfUser::create([
                'email'             => $request->email,
                'first_name'        => $request->input('first_name', ''),
                'last_name'         => $request->input('last_name', ''),
                'status'            => 'active',
                'email_verified_at' => now(),
            ]);

            // Créer le wallet automatiquement
            $user->wallet()->create(['balance_xof' => 0, 'balance_cny' => 0]);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'success' => false,
                'error'   => ['code' => 'ACCOUNT_SUSPENDED', 'message' => 'Compte suspendu'],
            ], 403);
        }

        // Révoquer les anciens tokens et créer un nouveau
        $user->tokens()->where('name', 'yf-flutter-token')->delete();
        $token = $user->createToken('yf-flutter-token')->plainTextToken;

        return response()->json([
            'success'     => true,
            'is_new_user' => $isNewUser,
            'token'       => 'Bearer ' . $token,
            'user'        => new UserResource($user),
        ]);
    }

    /**
     * POST /api/v1/auth/logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => true, 'message' => 'Déconnexion réussie']);
    }

    /**
     * GET /api/v1/auth/me
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => ['user' => new UserResource($request->user())],
        ]);
    }
}
