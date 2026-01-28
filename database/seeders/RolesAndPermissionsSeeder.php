<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = $this->createPermissions();

        // Create roles
        $roles = $this->createRoles();

        // Assign permissions to roles
        $this->assignPermissions($roles, $permissions);

        // Assign super-admin role to existing admins
        $this->assignSuperAdminToExistingAdmins();
    }

    /**
     * Create all permissions
     */
    private function createPermissions(): array
    {
        $permissionsData = [
            // Dashboard
            ['name' => 'Voir le tableau de bord', 'slug' => 'dashboard-view', 'module' => 'dashboard'],
            ['name' => 'Voir les statistiques', 'slug' => 'dashboard-stats', 'module' => 'dashboard'],

            // Users
            ['name' => 'Voir les utilisateurs', 'slug' => 'users-view', 'module' => 'users'],
            ['name' => 'Créer un utilisateur', 'slug' => 'users-create', 'module' => 'users'],
            ['name' => 'Modifier un utilisateur', 'slug' => 'users-edit', 'module' => 'users'],
            ['name' => 'Supprimer un utilisateur', 'slug' => 'users-delete', 'module' => 'users'],
            ['name' => 'Gérer les rôles utilisateur', 'slug' => 'users-manage-roles', 'module' => 'users'],

            // Roles & Permissions
            ['name' => 'Voir les rôles', 'slug' => 'roles-view', 'module' => 'roles'],
            ['name' => 'Créer un rôle', 'slug' => 'roles-create', 'module' => 'roles'],
            ['name' => 'Modifier un rôle', 'slug' => 'roles-edit', 'module' => 'roles'],
            ['name' => 'Supprimer un rôle', 'slug' => 'roles-delete', 'module' => 'roles'],
            ['name' => 'Voir les permissions', 'slug' => 'permissions-view', 'module' => 'roles'],
            ['name' => 'Gérer les permissions', 'slug' => 'permissions-manage', 'module' => 'roles'],

            // Testimonials
            ['name' => 'Voir les témoignages', 'slug' => 'testimonials-view', 'module' => 'testimonials'],
            ['name' => 'Approuver les témoignages', 'slug' => 'testimonials-approve', 'module' => 'testimonials'],
            ['name' => 'Rejeter les témoignages', 'slug' => 'testimonials-reject', 'module' => 'testimonials'],
            ['name' => 'Supprimer les témoignages', 'slug' => 'testimonials-delete', 'module' => 'testimonials'],

            // Contact Requests
            ['name' => 'Voir les demandes de contact', 'slug' => 'contacts-view', 'module' => 'contacts'],
            ['name' => 'Répondre aux demandes', 'slug' => 'contacts-respond', 'module' => 'contacts'],
            ['name' => 'Mettre à jour le statut', 'slug' => 'contacts-update-status', 'module' => 'contacts'],
            ['name' => 'Supprimer les demandes', 'slug' => 'contacts-delete', 'module' => 'contacts'],

            // Evaluations
            ['name' => 'Voir les évaluations', 'slug' => 'evaluations-view', 'module' => 'evaluations'],
            ['name' => 'Vérifier les évaluations', 'slug' => 'evaluations-verify', 'module' => 'evaluations'],
            ['name' => 'Supprimer les évaluations', 'slug' => 'evaluations-delete', 'module' => 'evaluations'],
            ['name' => 'Exporter les PDF', 'slug' => 'evaluations-export', 'module' => 'evaluations'],

            // Student Applications
            ['name' => 'Voir les dossiers étudiants', 'slug' => 'applications-view', 'module' => 'applications'],
            ['name' => 'Créer un dossier', 'slug' => 'applications-create', 'module' => 'applications'],
            ['name' => 'Modifier un dossier', 'slug' => 'applications-edit', 'module' => 'applications'],
            ['name' => 'Supprimer un dossier', 'slug' => 'applications-delete', 'module' => 'applications'],
            ['name' => 'Approuver les documents', 'slug' => 'applications-approve-docs', 'module' => 'applications'],
            ['name' => 'Générer les liens d\'accès', 'slug' => 'applications-generate-links', 'module' => 'applications'],
            ['name' => 'Télécharger les documents', 'slug' => 'applications-download', 'module' => 'applications'],

            // Settings
            ['name' => 'Voir les paramètres', 'slug' => 'settings-view', 'module' => 'settings'],
            ['name' => 'Modifier les paramètres', 'slug' => 'settings-edit', 'module' => 'settings'],
        ];

        $permissions = [];
        foreach ($permissionsData as $permData) {
            $permissions[$permData['slug']] = Permission::firstOrCreate(
                ['slug' => $permData['slug']],
                $permData
            );
        }

        return $permissions;
    }

    /**
     * Create all roles
     */
    private function createRoles(): array
    {
        $rolesData = [
            [
                'name' => 'Super Administrateur',
                'slug' => Role::SUPER_ADMIN,
                'description' => 'Accès complet à toutes les fonctionnalités',
                'color' => '#DC2626',
                'is_system' => true,
            ],
            [
                'name' => 'Administrateur',
                'slug' => Role::ADMIN,
                'description' => 'Gestion quotidienne de la plateforme',
                'color' => '#2563EB',
                'is_system' => true,
            ],
            [
                'name' => 'Modérateur',
                'slug' => Role::MODERATOR,
                'description' => 'Modération du contenu et gestion des demandes',
                'color' => '#7C3AED',
                'is_system' => true,
            ],
            [
                'name' => 'Utilisateur',
                'slug' => Role::USER,
                'description' => 'Utilisateur standard',
                'color' => '#6B7280',
                'is_system' => true,
            ],
        ];

        $roles = [];
        foreach ($rolesData as $roleData) {
            $roles[$roleData['slug']] = Role::firstOrCreate(
                ['slug' => $roleData['slug']],
                $roleData
            );
        }

        return $roles;
    }

    /**
     * Assign permissions to roles
     */
    private function assignPermissions(array $roles, array $permissions): void
    {
        // Admin gets almost all permissions (except some super-admin only ones)
        $adminPermissions = array_filter($permissions, function ($perm) {
            return !in_array($perm->slug, ['permissions-manage', 'settings-edit']);
        });
        $roles[Role::ADMIN]->permissions()->sync(
            collect($adminPermissions)->pluck('id')->toArray()
        );

        // Moderator permissions
        $moderatorPermissions = [
            'dashboard-view',
            'dashboard-stats',
            'users-view',
            'testimonials-view',
            'testimonials-approve',
            'testimonials-reject',
            'contacts-view',
            'contacts-respond',
            'contacts-update-status',
            'evaluations-view',
            'evaluations-verify',
            'applications-view',
            'applications-approve-docs',
        ];
        $roles[Role::MODERATOR]->permissions()->sync(
            Permission::whereIn('slug', $moderatorPermissions)->pluck('id')->toArray()
        );

        // User role - basic permissions only
        $userPermissions = [
            'dashboard-view',
        ];
        $roles[Role::USER]->permissions()->sync(
            Permission::whereIn('slug', $userPermissions)->pluck('id')->toArray()
        );
    }

    /**
     * Assign super-admin role to existing admin users
     */
    private function assignSuperAdminToExistingAdmins(): void
    {
        $superAdminRole = Role::where('slug', Role::SUPER_ADMIN)->first();

        if ($superAdminRole) {
            // Find all users with is_admin = true and assign super-admin role
            User::where('is_admin', true)->each(function ($user) use ($superAdminRole) {
                if (!$user->hasRole(Role::SUPER_ADMIN)) {
                    $user->roles()->attach($superAdminRole);
                }
            });
        }
    }
}
