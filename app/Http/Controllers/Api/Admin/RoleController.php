<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Get all roles with permissions count
     */
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])
            ->latest()
            ->get()
            ->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'slug' => $role->slug,
                    'description' => $role->description,
                    'is_system' => $role->is_system,
                    'users_count' => $role->users_count,
                    'permissions_count' => $role->permissions_count,
                    'created_at' => $role->created_at->format('d M Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $roles
        ]);
    }

    /**
     * Get a single role with its permissions
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $role->id,
                'name' => $role->name,
                'slug' => $role->slug,
                'description' => $role->description,
                'is_system' => $role->is_system,
                'permissions' => $role->permissions->pluck('slug')->toArray(),
                'created_at' => $role->created_at->format('d M Y'),
            ]
        ]);
    }

    /**
     * Create a new role
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:roles,slug',
            'description' => 'nullable|string|max:1000',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,slug',
        ], [
            'name.required' => 'Le nom du rôle est obligatoire.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_system' => false,
        ]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rôle créé avec succès!',
            'data' => $role->load('permissions')
        ], 201);
    }

    /**
     * Update a role
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Prevent editing system roles (except permissions)
        if ($role->is_system && ($request->has('name') || $request->has('slug'))) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de modifier le nom ou le slug d\'un rôle système.'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'description' => 'nullable|string|max:1000',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,slug',
        ]);

        if (!$role->is_system) {
            $role->update([
                'name' => $validated['name'] ?? $role->name,
                'slug' => $validated['slug'] ?? $role->slug,
                'description' => $validated['description'] ?? $role->description,
            ]);
        } else {
            // For system roles, only allow description changes
            $role->update([
                'description' => $validated['description'] ?? $role->description,
            ]);
        }

        if (isset($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rôle mis à jour avec succès!',
            'data' => $role->fresh()->load('permissions')
        ]);
    }

    /**
     * Delete a role
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->is_system) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de supprimer un rôle système.'
            ], 403);
        }

        if ($role->users()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Ce rôle est attribué à des utilisateurs. Veuillez d\'abord retirer ce rôle aux utilisateurs.'
            ], 400);
        }

        $role->permissions()->detach();
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rôle supprimé avec succès!'
        ]);
    }

    /**
     * Get all available permissions grouped by module
     */
    public function permissions()
    {
        $permissions = Permission::all()->groupBy('module');

        return response()->json([
            'success' => true,
            'data' => $permissions
        ]);
    }

    /**
     * Assign role to user
     */
    public function assignToUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = \App\Models\User::findOrFail($validated['user_id']);
        $role = Role::findOrFail($validated['role_id']);

        // Prevent non-super-admin from assigning super-admin role
        if ($role->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Seul un super administrateur peut attribuer ce rôle.'
            ], 403);
        }

        $user->assignRole($role);

        return response()->json([
            'success' => true,
            'message' => "Rôle '{$role->name}' attribué à {$user->name} avec succès!"
        ]);
    }

    /**
     * Remove role from user
     */
    public function removeFromUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = \App\Models\User::findOrFail($validated['user_id']);
        $role = Role::findOrFail($validated['role_id']);

        // Prevent removing own super-admin role
        if ($user->id === auth()->id() && $role->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas retirer votre propre rôle de super administrateur.'
            ], 403);
        }

        $user->removeRole($role);

        return response()->json([
            'success' => true,
            'message' => "Rôle '{$role->name}' retiré de {$user->name} avec succès!"
        ]);
    }

    /**
     * Sync user roles (replace all roles)
     */
    public function syncUserRoles(Request $request, $userId)
    {
        $validated = $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,slug',
        ]);

        $user = \App\Models\User::findOrFail($userId);

        // Prevent non-super-admin from assigning super-admin role
        if (in_array(Role::SUPER_ADMIN, $validated['roles']) && !auth()->user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Seul un super administrateur peut attribuer le rôle super-admin.'
            ], 403);
        }

        // Prevent removing own super-admin role
        if ($user->id === auth()->id() && $user->isSuperAdmin() && !in_array(Role::SUPER_ADMIN, $validated['roles'])) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas retirer votre propre rôle de super administrateur.'
            ], 403);
        }

        $user->syncRoles($validated['roles']);

        return response()->json([
            'success' => true,
            'message' => 'Rôles de l\'utilisateur mis à jour avec succès!',
            'data' => [
                'user' => $user->fresh()->load('roles'),
                'roles' => $user->role_names,
            ]
        ]);
    }
}
