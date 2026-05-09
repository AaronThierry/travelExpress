<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MonTailleurAuthController extends Controller
{
    /**
     * POST /api/auth/register
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'role'                  => 'nullable|string|in:client,tailleur,admin',
            'telephone'             => 'nullable|string|max:20',
            'adresse'               => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Données invalides',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->input('role', 'client'),
            'telephone' => $request->telephone,
            'adresse'   => $request->adresse,
            'bio'       => 'Nouveau membre de Mon Tailleur',
        ]);

        $token = $user->createToken('mon-tailleur-token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'user'    => $this->formatUser($user),
            'token'   => $token,
        ], 201);
    }

    /**
     * POST /api/auth/login
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Données invalides',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Les identifiants fournis sont incorrects.',
            ], 401);
        }

        $user->tokens()->where('name', 'mon-tailleur-token')->delete();
        $token = $user->createToken('mon-tailleur-token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user'    => $this->formatUser($user),
            'token'   => $token,
        ]);
    }

    /**
     * GET /api/auth/me
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json($this->formatUser($request->user()));
    }

    /**
     * POST /api/auth/logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie']);
    }

    private function formatUser(User $user): array
    {
        return [
            'id'                => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
            'role'              => $user->role ?? 'client',
            'telephone'         => $user->telephone,
            'adresse'           => $user->adresse,
            'bio'               => $user->bio,
            'photo_profil'      => $user->photo_profil,
            'email_verified_at' => $user->email_verified_at?->toIso8601String(),
            'created_at'        => $user->created_at->toIso8601String(),
            'updated_at'        => $user->updated_at->toIso8601String(),
        ];
    }
}
