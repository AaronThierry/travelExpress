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
            // ==========================================
            // TABLEAU DE BORD (Dashboard)
            // ==========================================
            [
                'name' => 'Accéder au tableau de bord',
                'slug' => 'dashboard-view',
                'module' => 'dashboard',
                'description' => 'Permet d\'accéder à la page du tableau de bord'
            ],
            [
                'name' => 'Voir les statistiques globales',
                'slug' => 'dashboard-stats',
                'module' => 'dashboard',
                'description' => 'Permet de voir les statistiques et métriques du tableau de bord'
            ],
            [
                'name' => 'Exporter les rapports',
                'slug' => 'dashboard-export',
                'module' => 'dashboard',
                'description' => 'Permet d\'exporter les rapports et statistiques'
            ],

            // ==========================================
            // UTILISATEURS (Users)
            // ==========================================
            [
                'name' => 'Voir la liste des utilisateurs',
                'slug' => 'users-view',
                'module' => 'users',
                'description' => 'Permet de voir la liste de tous les utilisateurs'
            ],
            [
                'name' => 'Créer un utilisateur',
                'slug' => 'users-create',
                'module' => 'users',
                'description' => 'Permet de créer de nouveaux comptes utilisateur'
            ],
            [
                'name' => 'Modifier un utilisateur',
                'slug' => 'users-edit',
                'module' => 'users',
                'description' => 'Permet de modifier les informations des utilisateurs'
            ],
            [
                'name' => 'Supprimer un utilisateur',
                'slug' => 'users-delete',
                'module' => 'users',
                'description' => 'Permet de supprimer des comptes utilisateur'
            ],
            [
                'name' => 'Gérer le statut admin',
                'slug' => 'users-toggle-admin',
                'module' => 'users',
                'description' => 'Permet de promouvoir ou rétrograder les administrateurs'
            ],
            [
                'name' => 'Attribuer des rôles',
                'slug' => 'users-assign-roles',
                'module' => 'users',
                'description' => 'Permet d\'attribuer des rôles aux utilisateurs'
            ],

            // ==========================================
            // RÔLES & PERMISSIONS (Roles)
            // ==========================================
            [
                'name' => 'Voir les rôles',
                'slug' => 'roles-view',
                'module' => 'roles',
                'description' => 'Permet de voir la liste des rôles'
            ],
            [
                'name' => 'Créer un rôle',
                'slug' => 'roles-create',
                'module' => 'roles',
                'description' => 'Permet de créer de nouveaux rôles'
            ],
            [
                'name' => 'Modifier un rôle',
                'slug' => 'roles-edit',
                'module' => 'roles',
                'description' => 'Permet de modifier les rôles existants'
            ],
            [
                'name' => 'Supprimer un rôle',
                'slug' => 'roles-delete',
                'module' => 'roles',
                'description' => 'Permet de supprimer des rôles (non-système)'
            ],
            [
                'name' => 'Voir les permissions',
                'slug' => 'permissions-view',
                'module' => 'roles',
                'description' => 'Permet de voir la liste des permissions'
            ],
            [
                'name' => 'Créer des permissions',
                'slug' => 'permissions-create',
                'module' => 'roles',
                'description' => 'Permet de créer de nouvelles permissions'
            ],
            [
                'name' => 'Modifier les permissions',
                'slug' => 'permissions-edit',
                'module' => 'roles',
                'description' => 'Permet de modifier les permissions existantes'
            ],
            [
                'name' => 'Supprimer des permissions',
                'slug' => 'permissions-delete',
                'module' => 'roles',
                'description' => 'Permet de supprimer des permissions'
            ],
            [
                'name' => 'Attribuer des permissions aux rôles',
                'slug' => 'permissions-assign',
                'module' => 'roles',
                'description' => 'Permet d\'attribuer des permissions aux rôles'
            ],

            // ==========================================
            // TÉMOIGNAGES (Testimonials)
            // ==========================================
            [
                'name' => 'Voir les témoignages',
                'slug' => 'testimonials-view',
                'module' => 'testimonials',
                'description' => 'Permet de voir la liste des témoignages'
            ],
            [
                'name' => 'Approuver les témoignages',
                'slug' => 'testimonials-approve',
                'module' => 'testimonials',
                'description' => 'Permet d\'approuver les témoignages en attente'
            ],
            [
                'name' => 'Rejeter les témoignages',
                'slug' => 'testimonials-reject',
                'module' => 'testimonials',
                'description' => 'Permet de rejeter les témoignages'
            ],
            [
                'name' => 'Annuler l\'approbation',
                'slug' => 'testimonials-unapprove',
                'module' => 'testimonials',
                'description' => 'Permet d\'annuler l\'approbation d\'un témoignage'
            ],
            [
                'name' => 'Supprimer les témoignages',
                'slug' => 'testimonials-delete',
                'module' => 'testimonials',
                'description' => 'Permet de supprimer des témoignages'
            ],

            // ==========================================
            // DEMANDES DE CONTACT (Contacts)
            // ==========================================
            [
                'name' => 'Voir les demandes de contact',
                'slug' => 'contacts-view',
                'module' => 'contacts',
                'description' => 'Permet de voir la liste des demandes de contact'
            ],
            [
                'name' => 'Voir les détails d\'une demande',
                'slug' => 'contacts-show',
                'module' => 'contacts',
                'description' => 'Permet de voir les détails d\'une demande de contact'
            ],
            [
                'name' => 'Mettre à jour le statut',
                'slug' => 'contacts-update-status',
                'module' => 'contacts',
                'description' => 'Permet de changer le statut des demandes'
            ],
            [
                'name' => 'Ajouter des notes',
                'slug' => 'contacts-add-notes',
                'module' => 'contacts',
                'description' => 'Permet d\'ajouter des notes aux demandes'
            ],
            [
                'name' => 'Marquer comme contacté',
                'slug' => 'contacts-mark-contacted',
                'module' => 'contacts',
                'description' => 'Permet de marquer une demande comme contactée'
            ],
            [
                'name' => 'Supprimer les demandes',
                'slug' => 'contacts-delete',
                'module' => 'contacts',
                'description' => 'Permet de supprimer des demandes de contact'
            ],
            [
                'name' => 'Voir les statistiques contacts',
                'slug' => 'contacts-stats',
                'module' => 'contacts',
                'description' => 'Permet de voir les statistiques des demandes'
            ],

            // ==========================================
            // ÉVALUATIONS (Evaluations)
            // ==========================================
            [
                'name' => 'Voir les évaluations',
                'slug' => 'evaluations-view',
                'module' => 'evaluations',
                'description' => 'Permet de voir la liste des évaluations'
            ],
            [
                'name' => 'Voir les statistiques évaluations',
                'slug' => 'evaluations-stats',
                'module' => 'evaluations',
                'description' => 'Permet de voir les statistiques des évaluations'
            ],
            [
                'name' => 'Vérifier les évaluations',
                'slug' => 'evaluations-verify',
                'module' => 'evaluations',
                'description' => 'Permet de vérifier et valider les évaluations'
            ],
            [
                'name' => 'Supprimer les évaluations',
                'slug' => 'evaluations-delete',
                'module' => 'evaluations',
                'description' => 'Permet de supprimer des évaluations'
            ],
            [
                'name' => 'Exporter les PDF',
                'slug' => 'evaluations-export-pdf',
                'module' => 'evaluations',
                'description' => 'Permet d\'exporter les évaluations en PDF'
            ],

            // ==========================================
            // DOSSIERS ÉTUDIANTS (Applications)
            // ==========================================
            [
                'name' => 'Voir les dossiers étudiants',
                'slug' => 'applications-view',
                'module' => 'applications',
                'description' => 'Permet de voir la liste des dossiers étudiants'
            ],
            [
                'name' => 'Voir les statistiques dossiers',
                'slug' => 'applications-stats',
                'module' => 'applications',
                'description' => 'Permet de voir les statistiques des dossiers'
            ],
            [
                'name' => 'Voir les détails d\'un dossier',
                'slug' => 'applications-show',
                'module' => 'applications',
                'description' => 'Permet de voir les détails complets d\'un dossier'
            ],
            [
                'name' => 'Créer un dossier',
                'slug' => 'applications-create',
                'module' => 'applications',
                'description' => 'Permet de créer de nouveaux dossiers étudiants'
            ],
            [
                'name' => 'Modifier un dossier',
                'slug' => 'applications-edit',
                'module' => 'applications',
                'description' => 'Permet de modifier les informations d\'un dossier'
            ],
            [
                'name' => 'Supprimer un dossier',
                'slug' => 'applications-delete',
                'module' => 'applications',
                'description' => 'Permet de supprimer des dossiers étudiants'
            ],
            [
                'name' => 'Approuver les documents',
                'slug' => 'applications-approve-docs',
                'module' => 'applications',
                'description' => 'Permet d\'approuver les documents uploadés'
            ],
            [
                'name' => 'Rejeter les documents',
                'slug' => 'applications-reject-docs',
                'module' => 'applications',
                'description' => 'Permet de rejeter les documents uploadés'
            ],
            [
                'name' => 'Générer les liens d\'accès',
                'slug' => 'applications-generate-links',
                'module' => 'applications',
                'description' => 'Permet de générer des liens d\'accès pour les étudiants'
            ],
            [
                'name' => 'Régénérer les tokens',
                'slug' => 'applications-regenerate-tokens',
                'module' => 'applications',
                'description' => 'Permet de régénérer les tokens d\'accès'
            ],
            [
                'name' => 'Télécharger les documents',
                'slug' => 'applications-download',
                'module' => 'applications',
                'description' => 'Permet de télécharger les documents des dossiers'
            ],
            [
                'name' => 'Gérer le dossier complémentaire',
                'slug' => 'applications-manage-complementary',
                'module' => 'applications',
                'description' => 'Permet de gérer les dossiers complémentaires'
            ],
            [
                'name' => 'Avancer les étapes',
                'slug' => 'applications-advance-step',
                'module' => 'applications',
                'description' => 'Permet de faire avancer les dossiers à l\'étape suivante'
            ],
            [
                'name' => 'Mise à jour en masse',
                'slug' => 'applications-bulk-update',
                'module' => 'applications',
                'description' => 'Permet de mettre à jour plusieurs dossiers à la fois'
            ],

            // ==========================================
            // PARAMÈTRES (Settings)
            // ==========================================
            [
                'name' => 'Voir les paramètres',
                'slug' => 'settings-view',
                'module' => 'settings',
                'description' => 'Permet d\'accéder à la page des paramètres'
            ],
            [
                'name' => 'Modifier les paramètres généraux',
                'slug' => 'settings-edit-general',
                'module' => 'settings',
                'description' => 'Permet de modifier les paramètres généraux'
            ],
            [
                'name' => 'Modifier les paramètres email',
                'slug' => 'settings-edit-email',
                'module' => 'settings',
                'description' => 'Permet de modifier les paramètres d\'email'
            ],
            [
                'name' => 'Voir les logs système',
                'slug' => 'settings-view-logs',
                'module' => 'settings',
                'description' => 'Permet de consulter les logs du système'
            ],
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
                'description' => 'Accès complet à toutes les fonctionnalités sans restriction',
                'color' => '#DC2626',
                'is_system' => true,
            ],
            [
                'name' => 'Administrateur',
                'slug' => Role::ADMIN,
                'description' => 'Gestion quotidienne de la plateforme avec accès étendu',
                'color' => '#2563EB',
                'is_system' => true,
            ],
            [
                'name' => 'Gestionnaire Dossiers',
                'slug' => 'gestionnaire-dossiers',
                'description' => 'Gestion des dossiers étudiants et documents',
                'color' => '#059669',
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
                'description' => 'Utilisateur standard avec accès limité',
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
        // ==========================================
        // ADMIN - Presque toutes les permissions (sauf paramètres critiques)
        // ==========================================
        $adminExcluded = [
            'settings-edit-general',
            'settings-edit-email',
            'settings-view-logs',
            'permissions-create',
            'permissions-delete',
        ];
        $adminPermissions = array_filter($permissions, function ($perm) use ($adminExcluded) {
            return !in_array($perm->slug, $adminExcluded);
        });
        $roles[Role::ADMIN]->permissions()->sync(
            collect($adminPermissions)->pluck('id')->toArray()
        );

        // ==========================================
        // GESTIONNAIRE DOSSIERS - Focus sur les dossiers étudiants
        // ==========================================
        $gestionnairePermissions = [
            // Dashboard
            'dashboard-view',
            'dashboard-stats',
            // Dossiers étudiants (toutes les permissions)
            'applications-view',
            'applications-stats',
            'applications-show',
            'applications-create',
            'applications-edit',
            'applications-approve-docs',
            'applications-reject-docs',
            'applications-generate-links',
            'applications-regenerate-tokens',
            'applications-download',
            'applications-manage-complementary',
            'applications-advance-step',
            'applications-bulk-update',
            // Évaluations (consultation)
            'evaluations-view',
            'evaluations-stats',
            'evaluations-export-pdf',
        ];
        if (isset($roles['gestionnaire-dossiers'])) {
            $roles['gestionnaire-dossiers']->permissions()->sync(
                Permission::whereIn('slug', $gestionnairePermissions)->pluck('id')->toArray()
            );
        }

        // ==========================================
        // MODERATEUR - Modération contenu et demandes
        // ==========================================
        $moderatorPermissions = [
            // Dashboard
            'dashboard-view',
            'dashboard-stats',
            // Utilisateurs (consultation uniquement)
            'users-view',
            // Témoignages
            'testimonials-view',
            'testimonials-approve',
            'testimonials-reject',
            'testimonials-unapprove',
            // Demandes de contact
            'contacts-view',
            'contacts-show',
            'contacts-update-status',
            'contacts-add-notes',
            'contacts-mark-contacted',
            'contacts-stats',
            // Évaluations (consultation et vérification)
            'evaluations-view',
            'evaluations-stats',
            'evaluations-verify',
            // Dossiers (consultation uniquement)
            'applications-view',
            'applications-show',
            'applications-approve-docs',
        ];
        $roles[Role::MODERATOR]->permissions()->sync(
            Permission::whereIn('slug', $moderatorPermissions)->pluck('id')->toArray()
        );

        // ==========================================
        // USER - Permissions minimales
        // ==========================================
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
