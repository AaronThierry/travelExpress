@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white" style="font-family: 'Playfair Display', serif;">
                Rôles & Permissions
            </h1>
            <p class="text-gray-400 mt-1">Gérez les rôles et les droits d'accès</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openRoleModal()" class="px-4 py-2.5 bg-gradient-to-r from-[#d4af37] to-[#b8960c] text-black font-medium rounded-xl hover:shadow-lg hover:shadow-[#d4af37]/30 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouveau rôle
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex gap-2 border-b border-[#d4af37]/20">
        <button onclick="switchTab('roles')" id="tab-roles" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 transition-all border-[#d4af37] text-[#d4af37]">
            Rôles
        </button>
        <button onclick="switchTab('permissions')" id="tab-permissions" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 transition-all border-transparent text-gray-400 hover:text-white">
            Permissions
        </button>
        <button onclick="switchTab('users')" id="tab-users" class="tab-btn px-4 py-3 text-sm font-medium border-b-2 transition-all border-transparent text-gray-400 hover:text-white">
            Attribution utilisateurs
        </button>
    </div>

    <!-- Roles Tab Content -->
    <div id="content-roles" class="tab-content space-y-4">
        <!-- Loading State -->
        <div id="roles-loading" class="elegant-card p-12 text-center">
            <div class="inline-block w-10 h-10 border-3 border-[#d4af37]/20 border-t-[#d4af37] rounded-full animate-spin"></div>
            <p class="mt-4 text-gray-400">Chargement des rôles...</p>
        </div>

        <!-- Roles Grid -->
        <div id="roles-grid" class="hidden grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <!-- Cards will be populated dynamically -->
        </div>
    </div>

    <!-- Permissions Tab Content -->
    <div id="content-permissions" class="tab-content hidden space-y-4">
        <!-- Search -->
        <div class="elegant-card p-4">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="permission-search" placeholder="Rechercher une permission..."
                        class="w-full pl-12 pr-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all">
                </div>
                <select id="module-filter" class="px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all cursor-pointer">
                    <option value="all">Tous les modules</option>
                </select>
            </div>
        </div>

        <!-- Loading State -->
        <div id="permissions-loading" class="elegant-card p-12 text-center">
            <div class="inline-block w-10 h-10 border-3 border-[#d4af37]/20 border-t-[#d4af37] rounded-full animate-spin"></div>
            <p class="mt-4 text-gray-400">Chargement des permissions...</p>
        </div>

        <!-- Permissions List -->
        <div id="permissions-list" class="hidden space-y-4">
            <!-- Grouped by module -->
        </div>
    </div>

    <!-- Users Tab Content -->
    <div id="content-users" class="tab-content hidden space-y-4">
        <!-- Search -->
        <div class="elegant-card p-4">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" id="user-search" placeholder="Rechercher un utilisateur..."
                    class="w-full pl-12 pr-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all">
            </div>
        </div>

        <!-- Loading State -->
        <div id="users-loading" class="elegant-card p-12 text-center">
            <div class="inline-block w-10 h-10 border-3 border-[#d4af37]/20 border-t-[#d4af37] rounded-full animate-spin"></div>
            <p class="mt-4 text-gray-400">Chargement des utilisateurs...</p>
        </div>

        <!-- Users Table -->
        <div id="users-table" class="hidden elegant-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#d4af37]/10">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Rôles</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="users-roles-list" class="divide-y divide-[#d4af37]/10">
                        <!-- Will be populated dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Role Modal -->
<div id="role-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="elegant-card w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-[#d4af37]/20">
            <div class="flex items-center justify-between">
                <h3 id="role-modal-title" class="text-xl font-bold text-white">Nouveau rôle</h3>
                <button onclick="closeRoleModal()" class="p-2 text-gray-400 hover:text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <form id="role-form" onsubmit="saveRole(event)" class="p-6 space-y-6">
            <input type="hidden" id="role-id" value="">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nom du rôle *</label>
                    <input type="text" id="role-name" required
                        class="w-full px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all"
                        placeholder="Ex: Gestionnaire">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Slug</label>
                    <input type="text" id="role-slug"
                        class="w-full px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all"
                        placeholder="gestionnaire (auto-généré)">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea id="role-description" rows="2"
                    class="w-full px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all resize-none"
                    placeholder="Description du rôle..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">Permissions</label>
                <div id="role-permissions" class="space-y-4 max-h-64 overflow-y-auto pr-2">
                    <!-- Permissions grouped by module -->
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-[#d4af37]/20">
                <button type="button" onclick="closeRoleModal()" class="flex-1 px-4 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-colors">
                    Annuler
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-[#d4af37] to-[#b8960c] text-black font-medium rounded-xl hover:shadow-lg hover:shadow-[#d4af37]/30 transition-all">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- User Roles Modal -->
<div id="user-roles-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="elegant-card w-full max-w-md">
        <div class="p-6 border-b border-[#d4af37]/20">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-white">Gérer les rôles</h3>
                    <p id="user-roles-name" class="text-sm text-gray-400 mt-1"></p>
                </div>
                <button onclick="closeUserRolesModal()" class="p-2 text-gray-400 hover:text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <input type="hidden" id="user-roles-id">
            <div id="user-roles-list" class="space-y-3 max-h-64 overflow-y-auto">
                <!-- Role checkboxes -->
            </div>
            <div class="flex gap-3 pt-6">
                <button type="button" onclick="closeUserRolesModal()" class="flex-1 px-4 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-colors">
                    Annuler
                </button>
                <button type="button" onclick="saveUserRoles()" class="flex-1 px-4 py-3 bg-gradient-to-r from-[#d4af37] to-[#b8960c] text-black font-medium rounded-xl hover:shadow-lg hover:shadow-[#d4af37]/30 transition-all">
                    Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="elegant-card w-full max-w-md p-6">
        <div class="text-center">
            <div class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-4 bg-red-500/20">
                <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 id="confirm-title" class="text-xl font-bold text-white mb-2">Supprimer le rôle</h3>
            <p id="confirm-message" class="text-gray-400 text-sm mb-6"></p>
            <div class="flex gap-3">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-colors">
                    Annuler
                </button>
                <button id="confirm-btn" onclick="executeConfirmAction()" class="flex-1 px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition-all">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let allRoles = [];
    let allPermissions = [];
    let groupedPermissions = {};
    let allUsers = [];
    let currentTab = 'roles';
    let pendingConfirmAction = null;

    // Tab switching
    function switchTab(tab) {
        currentTab = tab;
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-[#d4af37]', 'text-[#d4af37]');
            btn.classList.add('border-transparent', 'text-gray-400');
        });
        document.getElementById(`tab-${tab}`).classList.remove('border-transparent', 'text-gray-400');
        document.getElementById(`tab-${tab}`).classList.add('border-[#d4af37]', 'text-[#d4af37]');

        document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
        document.getElementById(`content-${tab}`).classList.remove('hidden');

        if (tab === 'roles' && allRoles.length === 0) loadRoles();
        if (tab === 'permissions' && allPermissions.length === 0) loadPermissions();
        if (tab === 'users' && allUsers.length === 0) loadUsersForRoles();
    }

    // Load roles
    async function loadRoles() {
        const loadingEl = document.getElementById('roles-loading');
        const gridEl = document.getElementById('roles-grid');

        loadingEl.classList.remove('hidden');
        gridEl.classList.add('hidden');

        try {
            const result = await apiCall('/admin/api/roles');
            allRoles = result.data || [];

            loadingEl.classList.add('hidden');
            gridEl.classList.remove('hidden');
            renderRoles();
        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `<p class="text-red-400">Erreur: ${error.message}</p>`;
        }
    }

    function renderRoles() {
        const gridEl = document.getElementById('roles-grid');
        gridEl.innerHTML = allRoles.map(role => `
            <div class="elegant-card p-5 hover:border-[#d4af37]/40 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-[#d4af37]/10 border border-[#d4af37]/30">
                            <svg class="w-5 h-5 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">${escapeHtml(role.name)}</h3>
                            <p class="text-xs text-gray-500">${escapeHtml(role.slug)}</p>
                        </div>
                    </div>
                    ${role.is_system ? '<span class="px-2 py-1 text-xs bg-gray-800 text-gray-400 rounded-lg">Système</span>' : ''}
                </div>
                <p class="text-sm text-gray-400 mb-4 line-clamp-2">${escapeHtml(role.description || 'Aucune description')}</p>
                <div class="flex items-center justify-between pt-4 border-t border-[#d4af37]/10">
                    <div class="flex items-center gap-4 text-xs text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            ${role.users_count} utilisateur${role.users_count > 1 ? 's' : ''}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            ${role.permissions_count} permission${role.permissions_count > 1 ? 's' : ''}
                        </span>
                    </div>
                    <div class="flex items-center gap-1">
                        <button onclick="editRole(${role.id})" class="p-2 text-[#d4af37] hover:bg-[#d4af37]/10 rounded-lg transition-all" title="Modifier">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        ${!role.is_system ? `
                        <button onclick="confirmDeleteRole(${role.id}, '${escapeHtml(role.name)}')" class="p-2 text-red-400 hover:bg-red-500/10 rounded-lg transition-all" title="Supprimer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                        ` : ''}
                    </div>
                </div>
            </div>
        `).join('');
    }

    // Load permissions
    async function loadPermissions() {
        const loadingEl = document.getElementById('permissions-loading');
        const listEl = document.getElementById('permissions-list');

        loadingEl.classList.remove('hidden');
        listEl.classList.add('hidden');

        try {
            const result = await apiCall('/admin/api/permissions/grouped');
            groupedPermissions = result.data || {};
            allPermissions = Object.values(groupedPermissions).flat();

            // Populate module filter
            const moduleFilter = document.getElementById('module-filter');
            moduleFilter.innerHTML = '<option value="all">Tous les modules</option>' +
                Object.keys(groupedPermissions).map(module =>
                    `<option value="${module}">${formatModuleName(module)}</option>`
                ).join('');

            loadingEl.classList.add('hidden');
            listEl.classList.remove('hidden');
            renderPermissions();
        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `<p class="text-red-400">Erreur: ${error.message}</p>`;
        }
    }

    function renderPermissions(filter = 'all', search = '') {
        const listEl = document.getElementById('permissions-list');
        let html = '';

        for (const [module, permissions] of Object.entries(groupedPermissions)) {
            if (filter !== 'all' && module !== filter) continue;

            const filteredPerms = permissions.filter(p =>
                p.name.toLowerCase().includes(search.toLowerCase()) ||
                p.slug.toLowerCase().includes(search.toLowerCase())
            );

            if (filteredPerms.length === 0) continue;

            html += `
                <div class="elegant-card overflow-hidden">
                    <div class="px-5 py-4 bg-[#d4af37]/5 border-b border-[#d4af37]/10">
                        <h3 class="font-semibold text-[#d4af37]">${formatModuleName(module)}</h3>
                    </div>
                    <div class="divide-y divide-[#d4af37]/10">
                        ${filteredPerms.map(perm => `
                            <div class="px-5 py-3 flex items-center justify-between hover:bg-[#d4af37]/5 transition-colors">
                                <div>
                                    <p class="text-sm font-medium text-white">${escapeHtml(perm.name)}</p>
                                    <p class="text-xs text-gray-500">${escapeHtml(perm.slug)}</p>
                                </div>
                                <span class="text-xs text-gray-500">${escapeHtml(perm.description || '')}</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        listEl.innerHTML = html || '<div class="elegant-card p-8 text-center text-gray-400">Aucune permission trouvée</div>';
    }

    // Load users for role assignment
    async function loadUsersForRoles() {
        const loadingEl = document.getElementById('users-loading');
        const tableEl = document.getElementById('users-table');

        loadingEl.classList.remove('hidden');
        tableEl.classList.add('hidden');

        try {
            const [usersResult, rolesResult] = await Promise.all([
                apiCall('/admin/api/users'),
                allRoles.length ? Promise.resolve({ data: allRoles }) : apiCall('/admin/api/roles')
            ]);

            allUsers = usersResult.data || [];
            if (!allRoles.length) allRoles = rolesResult.data || [];

            loadingEl.classList.add('hidden');
            tableEl.classList.remove('hidden');
            renderUsersRoles();
        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `<p class="text-red-400">Erreur: ${error.message}</p>`;
        }
    }

    function renderUsersRoles(search = '') {
        const listEl = document.getElementById('users-roles-list');
        const filteredUsers = allUsers.filter(u =>
            u.name.toLowerCase().includes(search.toLowerCase()) ||
            u.email.toLowerCase().includes(search.toLowerCase())
        );

        listEl.innerHTML = filteredUsers.map(user => `
            <tr class="hover:bg-[#d4af37]/5 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#d4af37] to-[#b8960c] flex items-center justify-center flex-shrink-0">
                            <span class="text-[#0a0a0a] font-bold text-sm">${user.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">${escapeHtml(user.name)}</p>
                            <p class="text-xs text-gray-500">${escapeHtml(user.email)}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1">
                        ${user.is_admin
                            ? '<span class="px-2 py-1 text-xs font-medium rounded-full bg-[#d4af37]/20 text-[#d4af37] border border-[#d4af37]/30">Admin</span>'
                            : '<span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-800 text-gray-400 border border-gray-700">Utilisateur</span>'
                        }
                    </div>
                </td>
                <td class="px-6 py-4 text-right">
                    <button onclick="openUserRolesModal(${user.id}, '${escapeHtml(user.name)}')"
                        class="px-3 py-1.5 text-sm text-[#d4af37] hover:bg-[#d4af37]/10 rounded-lg transition-all">
                        Gérer les rôles
                    </button>
                </td>
            </tr>
        `).join('');
    }

    // Role modal functions
    function openRoleModal(roleId = null) {
        document.getElementById('role-id').value = roleId || '';
        document.getElementById('role-modal-title').textContent = roleId ? 'Modifier le rôle' : 'Nouveau rôle';
        document.getElementById('role-name').value = '';
        document.getElementById('role-slug').value = '';
        document.getElementById('role-description').value = '';

        loadPermissionsForModal(roleId);

        document.getElementById('role-modal').classList.remove('hidden');
        document.getElementById('role-modal').classList.add('flex');
    }

    async function loadPermissionsForModal(roleId = null) {
        const container = document.getElementById('role-permissions');

        try {
            if (Object.keys(groupedPermissions).length === 0) {
                const result = await apiCall('/admin/api/permissions/grouped');
                groupedPermissions = result.data || {};
            }

            let rolePermissions = [];
            if (roleId) {
                const roleResult = await apiCall(`/admin/api/roles/${roleId}`);
                const role = roleResult.data;
                document.getElementById('role-name').value = role.name;
                document.getElementById('role-slug').value = role.slug;
                document.getElementById('role-description').value = role.description || '';
                rolePermissions = role.permissions || [];
            }

            container.innerHTML = Object.entries(groupedPermissions).map(([module, permissions]) => `
                <div class="border border-[#d4af37]/10 rounded-xl overflow-hidden">
                    <div class="px-4 py-2 bg-[#d4af37]/5 border-b border-[#d4af37]/10">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="module-checkbox w-4 h-4 rounded border-[#d4af37]/30 text-[#d4af37] focus:ring-[#d4af37]/50"
                                data-module="${module}" onchange="toggleModulePermissions('${module}', this.checked)">
                            <span class="text-sm font-medium text-[#d4af37]">${formatModuleName(module)}</span>
                        </label>
                    </div>
                    <div class="p-3 space-y-2">
                        ${permissions.map(perm => `
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="perm-checkbox perm-${module} w-4 h-4 rounded border-[#d4af37]/30 text-[#d4af37] focus:ring-[#d4af37]/50"
                                    value="${perm.slug}" ${rolePermissions.includes(perm.slug) ? 'checked' : ''}
                                    onchange="updateModuleCheckbox('${module}')">
                                <span class="text-sm text-gray-300">${escapeHtml(perm.name)}</span>
                            </label>
                        `).join('')}
                    </div>
                </div>
            `).join('');

            // Update module checkboxes state
            Object.keys(groupedPermissions).forEach(module => updateModuleCheckbox(module));

        } catch (error) {
            console.error('Error:', error);
            container.innerHTML = `<p class="text-red-400">Erreur de chargement</p>`;
        }
    }

    function toggleModulePermissions(module, checked) {
        document.querySelectorAll(`.perm-${module}`).forEach(cb => cb.checked = checked);
    }

    function updateModuleCheckbox(module) {
        const checkboxes = document.querySelectorAll(`.perm-${module}`);
        const checkedCount = document.querySelectorAll(`.perm-${module}:checked`).length;
        const moduleCheckbox = document.querySelector(`input[data-module="${module}"]`);

        if (moduleCheckbox) {
            moduleCheckbox.checked = checkedCount === checkboxes.length;
            moduleCheckbox.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
        }
    }

    function closeRoleModal() {
        document.getElementById('role-modal').classList.add('hidden');
        document.getElementById('role-modal').classList.remove('flex');
    }

    async function saveRole(event) {
        event.preventDefault();

        const roleId = document.getElementById('role-id').value;
        const name = document.getElementById('role-name').value;
        const slug = document.getElementById('role-slug').value;
        const description = document.getElementById('role-description').value;

        const selectedPermissions = Array.from(document.querySelectorAll('.perm-checkbox:checked')).map(cb => cb.value);

        const data = {
            name,
            slug: slug || undefined,
            description,
            permissions: selectedPermissions
        };

        try {
            if (roleId) {
                await apiCall(`/admin/api/roles/${roleId}`, { method: 'PUT', body: JSON.stringify(data) });
                showToast('Rôle mis à jour avec succès', 'success');
            } else {
                await apiCall('/admin/api/roles', { method: 'POST', body: JSON.stringify(data) });
                showToast('Rôle créé avec succès', 'success');
            }

            closeRoleModal();
            clearApiCache('/admin/api/roles');
            allRoles = [];
            loadRoles();
        } catch (error) {
            console.error('Error:', error);
            showToast(error.message || 'Erreur lors de l\'enregistrement', 'error');
        }
    }

    async function editRole(roleId) {
        openRoleModal(roleId);
    }

    function confirmDeleteRole(roleId, roleName) {
        pendingConfirmAction = { type: 'deleteRole', id: roleId };
        document.getElementById('confirm-title').textContent = 'Supprimer le rôle';
        document.getElementById('confirm-message').textContent = `Voulez-vous vraiment supprimer le rôle "${roleName}" ? Cette action est irréversible.`;

        document.getElementById('confirm-modal').classList.remove('hidden');
        document.getElementById('confirm-modal').classList.add('flex');
    }

    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
        document.getElementById('confirm-modal').classList.remove('flex');
        pendingConfirmAction = null;
    }

    async function executeConfirmAction() {
        if (!pendingConfirmAction) return;

        const { type, id } = pendingConfirmAction;
        closeConfirmModal();

        try {
            if (type === 'deleteRole') {
                await apiCall(`/admin/api/roles/${id}`, { method: 'DELETE' });
                showToast('Rôle supprimé avec succès', 'success');
                clearApiCache('/admin/api/roles');
                allRoles = [];
                loadRoles();
            }
        } catch (error) {
            console.error('Error:', error);
            showToast(error.message || 'Une erreur est survenue', 'error');
        }
    }

    // User roles modal
    function openUserRolesModal(userId, userName) {
        document.getElementById('user-roles-id').value = userId;
        document.getElementById('user-roles-name').textContent = userName;

        const listEl = document.getElementById('user-roles-list');
        listEl.innerHTML = allRoles.map(role => `
            <label class="flex items-center gap-3 p-3 rounded-xl border border-[#d4af37]/20 hover:bg-[#d4af37]/5 cursor-pointer transition-colors">
                <input type="checkbox" class="user-role-checkbox w-4 h-4 rounded border-[#d4af37]/30 text-[#d4af37] focus:ring-[#d4af37]/50"
                    value="${role.slug}">
                <div class="flex-1">
                    <p class="text-sm font-medium text-white">${escapeHtml(role.name)}</p>
                    <p class="text-xs text-gray-500">${escapeHtml(role.description || '')}</p>
                </div>
            </label>
        `).join('');

        document.getElementById('user-roles-modal').classList.remove('hidden');
        document.getElementById('user-roles-modal').classList.add('flex');
    }

    function closeUserRolesModal() {
        document.getElementById('user-roles-modal').classList.add('hidden');
        document.getElementById('user-roles-modal').classList.remove('flex');
    }

    async function saveUserRoles() {
        const userId = document.getElementById('user-roles-id').value;
        const selectedRoles = Array.from(document.querySelectorAll('.user-role-checkbox:checked')).map(cb => cb.value);

        try {
            await apiCall(`/admin/api/users/${userId}/roles`, {
                method: 'PUT',
                body: JSON.stringify({ roles: selectedRoles })
            });
            showToast('Rôles mis à jour avec succès', 'success');
            closeUserRolesModal();
        } catch (error) {
            console.error('Error:', error);
            showToast(error.message || 'Erreur lors de la mise à jour', 'error');
        }
    }

    // Utility functions
    function formatModuleName(module) {
        const names = {
            'dashboard': 'Tableau de bord',
            'users': 'Utilisateurs',
            'roles': 'Rôles & Permissions',
            'testimonials': 'Témoignages',
            'contacts': 'Demandes de contact',
            'evaluations': 'Évaluations',
            'applications': 'Dossiers étudiants',
            'settings': 'Paramètres',
            'general': 'Général'
        };
        return names[module] || module.charAt(0).toUpperCase() + module.slice(1);
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Search and filter listeners
    document.getElementById('permission-search').addEventListener('input', function() {
        renderPermissions(document.getElementById('module-filter').value, this.value);
    });
    document.getElementById('module-filter').addEventListener('change', function() {
        renderPermissions(this.value, document.getElementById('permission-search').value);
    });
    document.getElementById('user-search').addEventListener('input', function() {
        renderUsersRoles(this.value);
    });

    // Close modals on escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeRoleModal();
            closeUserRolesModal();
            closeConfirmModal();
        }
    });

    // Initialize
    loadRoles();
</script>
@endpush
