<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Token expiration time in days
     */
    private const TOKEN_EXPIRATION_DAYS = 1;
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|string|max:255',
            'specialty' => 'required|string|max:500',
        ], [
            'name.required' => 'Le nom et prénom sont requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'country.required' => 'Veuillez sélectionner votre pays.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'status.required' => 'Veuillez sélectionner votre statut.',
            'specialty.required' => 'Veuillez indiquer votre spécialité.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'position' => $request->status, // Using position field for status
            'bio' => $request->specialty, // Using bio field for specialty
            'language' => 'fr',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $expiresAt = Carbon::now()->addDays(self::TOKEN_EXPIRATION_DAYS);

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie!',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expiresAt->toISOString(),
                'expires_in' => self::TOKEN_EXPIRATION_DAYS * 24 * 60 * 60, // seconds
            ]
        ], 201);
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'password.required' => 'Le mot de passe est requis.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les informations d\'identification fournies sont incorrectes.'],
            ]);
        }

        // Revoke all previous tokens
        $user->tokens()->delete();

        // Create new token
        $token = $user->createToken('auth_token')->plainTextToken;
        $expiresAt = Carbon::now()->addDays(self::TOKEN_EXPIRATION_DAYS);

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie!',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expiresAt->toISOString(),
                'expires_in' => self::TOKEN_EXPIRATION_DAYS * 24 * 60 * 60, // seconds
            ]
        ], 200);
    }

    /**
     * Logout user (Revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie!'
        ], 200);
    }

    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ], 200);
    }

    /**
     * Refresh token
     */
    public function refresh(Request $request)
    {
        $user = $request->user();

        // Revoke current token
        $request->user()->currentAccessToken()->delete();

        // Create new token
        $token = $user->createToken('auth_token')->plainTextToken;
        $expiresAt = Carbon::now()->addDays(self::TOKEN_EXPIRATION_DAYS);

        return response()->json([
            'success' => true,
            'message' => 'Token rafraîchi!',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expiresAt->toISOString(),
                'expires_in' => self::TOKEN_EXPIRATION_DAYS * 24 * 60 * 60,
            ]
        ], 200);
    }

    /**
     * Verify token validity
     */
    public function verify(Request $request)
    {
        $user = $request->user();
        $token = $user->currentAccessToken();

        return response()->json([
            'success' => true,
            'message' => 'Token valide',
            'data' => [
                'user' => $user,
                'token_created_at' => $token->created_at->toISOString(),
                'is_admin' => (bool) $user->is_admin,
            ]
        ], 200);
    }

    /**
     * Logout from all devices
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion de tous les appareils réussie!'
        ], 200);
    }
}
