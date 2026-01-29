<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get all users
     */
    public function index()
    {
        $users = User::with('roles')->latest()
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'country' => $user->country,
                    'position' => $user->position,
                    'is_admin' => $user->is_admin,
                    'roles' => $user->roles->map(function ($role) {
                        return [
                            'id' => $role->id,
                            'name' => $role->name,
                            'slug' => $role->slug,
                        ];
                    }),
                    'role_slugs' => $user->roles->pluck('slug')->toArray(),
                    'created_at' => $user->created_at->format('d M Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }

    /**
     * Toggle admin status
     */
    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);

        // Prevent removing admin from self
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas modifier vos propres droits administrateur.'
            ], 400);
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => $user->is_admin
                ? 'Droits administrateur accordés avec succès!'
                : 'Droits administrateur retirés avec succès!',
            'data' => $user
        ], 200);
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas supprimer votre propre compte.'
            ], 400);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès!'
        ], 200);
    }
}
