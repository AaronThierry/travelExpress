<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Get all permissions
     */
    public function index()
    {
        $permissions = Permission::withCount('roles')
            ->orderBy('module')
            ->orderBy('name')
            ->get()
            ->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'slug' => $permission->slug,
                    'module' => $permission->module,
                    'description' => $permission->description,
                    'roles_count' => $permission->roles_count,
                    'created_at' => $permission->created_at->format('d M Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $permissions
        ]);
    }

    /**
     * Get permissions grouped by module
     */
    public function grouped()
    {
        $permissions = Permission::all()->groupBy('module')->map(function ($group) {
            return $group->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'slug' => $permission->slug,
                    'description' => $permission->description,
                ];
            });
        });

        return response()->json([
            'success' => true,
            'data' => $permissions
        ]);
    }

    /**
     * Get available modules
     */
    public function modules()
    {
        $modules = Permission::getModules();

        return response()->json([
            'success' => true,
            'data' => $modules
        ]);
    }

    /**
     * Create a new permission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:permissions,slug',
            'module' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Le nom de la permission est obligatoire.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
        ]);

        $permission = Permission::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'module' => $validated['module'] ?? 'general',
            'description' => $validated['description'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission créée avec succès!',
            'data' => $permission
        ], 201);
    }

    /**
     * Update a permission
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'module' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $permission->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Permission mise à jour avec succès!',
            'data' => $permission->fresh()
        ]);
    }

    /**
     * Delete a permission
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->roles()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cette permission est attribuée à des rôles. Veuillez d\'abord la retirer des rôles.'
            ], 400);
        }

        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permission supprimée avec succès!'
        ]);
    }

    /**
     * Bulk create permissions for a module
     */
    public function bulkCreate(Request $request)
    {
        $validated = $request->validate([
            'module' => 'required|string|max:100',
            'permissions' => 'required|array|min:1',
            'permissions.*.name' => 'required|string|max:255',
            'permissions.*.slug' => 'nullable|string|max:255',
            'permissions.*.description' => 'nullable|string|max:1000',
        ]);

        $created = [];
        foreach ($validated['permissions'] as $permData) {
            $slug = $permData['slug'] ?? Str::slug($validated['module'] . '-' . $permData['name']);

            // Skip if already exists
            if (Permission::where('slug', $slug)->exists()) {
                continue;
            }

            $permission = Permission::create([
                'name' => $permData['name'],
                'slug' => $slug,
                'module' => $validated['module'],
                'description' => $permData['description'] ?? null,
            ]);
            $created[] = $permission;
        }

        return response()->json([
            'success' => true,
            'message' => count($created) . ' permission(s) créée(s) avec succès!',
            'data' => $created
        ], 201);
    }
}
