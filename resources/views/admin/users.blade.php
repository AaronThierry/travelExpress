@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white" style="font-family: 'Playfair Display', serif;">
                Utilisateurs
            </h1>
            <p class="text-gray-400 mt-1">Gérez les comptes et les droits administrateur</p>
        </div>
        <div class="flex items-center gap-3">
            <span id="user-count" class="px-4 py-2 bg-[#d4af37]/10 border border-[#d4af37]/20 rounded-xl text-[#d4af37] text-sm font-medium">
                0 utilisateurs
            </span>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="elegant-card p-4 sm:p-5">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" id="search" placeholder="Rechercher par nom ou email..."
                    class="w-full pl-12 pr-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all">
            </div>
            <select id="filter-admin" class="px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37]/50 outline-none transition-all cursor-pointer">
                <option value="all">Tous les rôles</option>
                <option value="admin">Administrateurs</option>
                <option value="user">Utilisateurs</option>
            </select>
        </div>
    </div>

    <!-- Loading State -->
    <div id="loading" class="elegant-card p-12 text-center">
        <div class="inline-block w-10 h-10 border-3 border-[#d4af37]/20 border-t-[#d4af37] rounded-full animate-spin"></div>
        <p class="mt-4 text-gray-400">Chargement des utilisateurs...</p>
    </div>

    <!-- Error State -->
    <div id="error" class="hidden elegant-card border-red-500/30 p-4">
        <div class="flex items-center gap-3 text-red-400">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p id="error-message" class="text-sm"></p>
        </div>
    </div>

    <!-- Users Grid -->
    <div id="users-grid" class="hidden grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <!-- Cards will be populated dynamically -->
    </div>

    <!-- Users Table (Desktop) -->
    <div id="users-table" class="hidden elegant-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#d4af37]/10">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Utilisateur</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider hidden md:table-cell">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider hidden lg:table-cell">Pays</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Rôle</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider hidden xl:table-cell">Inscription</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="users-list" class="divide-y divide-[#d4af37]/10">
                    <!-- Will be populated dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="hidden elegant-card p-12 text-center">
        <div class="w-16 h-16 mx-auto bg-[#d4af37]/10 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-white mb-2">Aucun utilisateur trouvé</h3>
        <p class="text-gray-400 text-sm">Essayez de modifier vos critères de recherche</p>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="elegant-card w-full max-w-md p-6">
        <div class="text-center">
            <div id="modal-icon" class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-4"></div>
            <h3 id="modal-title" class="text-xl font-bold text-white mb-2"></h3>
            <p id="modal-message" class="text-gray-400 text-sm mb-6"></p>
            <div class="flex gap-3">
                <button onclick="closeModal()" class="flex-1 px-4 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-colors">
                    Annuler
                </button>
                <button id="modal-confirm" class="flex-1 px-4 py-3 rounded-xl font-medium transition-all"></button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let allUsers = [];
    let filteredUsers = [];
    let pendingAction = null;

    async function loadUsers() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const tableEl = document.getElementById('users-table');
        const emptyEl = document.getElementById('empty-state');
        const countEl = document.getElementById('user-count');

        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
        tableEl.classList.add('hidden');
        emptyEl.classList.add('hidden');

        try {
            const result = await apiCall('/admin/api/users');
            allUsers = result.data || [];
            filteredUsers = allUsers;

            loadingEl.classList.add('hidden');
            countEl.textContent = `${allUsers.length} utilisateur${allUsers.length > 1 ? 's' : ''}`;

            if (filteredUsers.length === 0) {
                emptyEl.classList.remove('hidden');
            } else {
                tableEl.classList.remove('hidden');
                renderUsers();
            }
        } catch (error) {
            console.error('Error:', error);
            loadingEl.classList.add('hidden');
            showError(error.message || 'Erreur lors du chargement des utilisateurs');
        }
    }

    function filterUsers() {
        const search = document.getElementById('search').value.toLowerCase();
        const adminFilter = document.getElementById('filter-admin').value;

        filteredUsers = allUsers.filter(user => {
            const matchSearch = user.name.toLowerCase().includes(search) ||
                              user.email.toLowerCase().includes(search);

            let matchAdmin = true;
            if (adminFilter === 'admin') {
                matchAdmin = user.is_admin === 1 || user.is_admin === true;
            } else if (adminFilter === 'user') {
                matchAdmin = user.is_admin === 0 || user.is_admin === false;
            }

            return matchSearch && matchAdmin;
        });

        const tableEl = document.getElementById('users-table');
        const emptyEl = document.getElementById('empty-state');
        const countEl = document.getElementById('user-count');

        countEl.textContent = `${filteredUsers.length} utilisateur${filteredUsers.length > 1 ? 's' : ''}`;

        if (filteredUsers.length === 0) {
            tableEl.classList.add('hidden');
            emptyEl.classList.remove('hidden');
        } else {
            emptyEl.classList.add('hidden');
            tableEl.classList.remove('hidden');
            renderUsers();
        }
    }

    function renderUsers() {
        const listEl = document.getElementById('users-list');
        listEl.innerHTML = filteredUsers.map(user => `
            <tr class="hover:bg-[#d4af37]/5 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#d4af37] to-[#b8960c] flex items-center justify-center flex-shrink-0 shadow-lg shadow-[#d4af37]/20">
                            <span class="text-[#0a0a0a] font-bold text-sm">${user.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-white truncate">${escapeHtml(user.name)}</p>
                            <p class="text-xs text-gray-500 truncate md:hidden">${escapeHtml(user.email)}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <p class="text-sm text-gray-400 truncate max-w-[200px]">${escapeHtml(user.email)}</p>
                </td>
                <td class="px-6 py-4 hidden lg:table-cell">
                    <span class="text-sm text-gray-400">${escapeHtml(user.country || '-')}</span>
                </td>
                <td class="px-6 py-4">
                    ${user.is_admin
                        ? '<span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-[#d4af37]/20 text-[#d4af37] border border-[#d4af37]/30"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>Admin</span>'
                        : '<span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-gray-800 text-gray-400 border border-gray-700">Utilisateur</span>'
                    }
                </td>
                <td class="px-6 py-4 hidden xl:table-cell">
                    <span class="text-sm text-gray-500">${formatDate(user.created_at)}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <button onclick="confirmToggleAdmin(${user.id})"
                            class="p-2 rounded-lg transition-all ${user.is_admin
                                ? 'text-amber-400 hover:bg-amber-500/10 hover:text-amber-300'
                                : 'text-[#d4af37] hover:bg-[#d4af37]/10'}"
                            title="${user.is_admin ? 'Retirer les droits admin' : 'Promouvoir admin'}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                ${user.is_admin
                                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"/>'
                                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>'
                                }
                            </svg>
                        </button>
                        <button onclick="confirmDelete(${user.id})"
                            class="p-2 text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-lg transition-all"
                            title="Supprimer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    function confirmToggleAdmin(userId) {
        const user = allUsers.find(u => u.id === userId);
        const isAdmin = user.is_admin === 1 || user.is_admin === true;

        pendingAction = { type: 'toggle', userId };

        const modal = document.getElementById('confirm-modal');
        const icon = document.getElementById('modal-icon');
        const title = document.getElementById('modal-title');
        const message = document.getElementById('modal-message');
        const confirmBtn = document.getElementById('modal-confirm');

        if (isAdmin) {
            icon.className = 'w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-4 bg-amber-500/20';
            icon.innerHTML = '<svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"/></svg>';
            title.textContent = 'Retirer les droits admin';
            message.textContent = `Voulez-vous retirer les droits administrateur de ${user.name} ?`;
            confirmBtn.className = 'flex-1 px-4 py-3 rounded-xl font-medium transition-all bg-amber-500 hover:bg-amber-600 text-black';
            confirmBtn.textContent = 'Retirer';
        } else {
            icon.className = 'w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-4 bg-[#d4af37]/20';
            icon.innerHTML = '<svg class="w-7 h-7 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>';
            title.textContent = 'Promouvoir administrateur';
            message.textContent = `Voulez-vous promouvoir ${user.name} en tant qu'administrateur ?`;
            confirmBtn.className = 'flex-1 px-4 py-3 rounded-xl font-medium transition-all bg-gradient-to-r from-[#d4af37] to-[#b8960c] hover:shadow-lg hover:shadow-[#d4af37]/30 text-black';
            confirmBtn.textContent = 'Promouvoir';
        }

        confirmBtn.onclick = executeAction;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function confirmDelete(userId) {
        const user = allUsers.find(u => u.id === userId);
        pendingAction = { type: 'delete', userId };

        const modal = document.getElementById('confirm-modal');
        const icon = document.getElementById('modal-icon');
        const title = document.getElementById('modal-title');
        const message = document.getElementById('modal-message');
        const confirmBtn = document.getElementById('modal-confirm');

        icon.className = 'w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-4 bg-red-500/20';
        icon.innerHTML = '<svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>';
        title.textContent = 'Supprimer l\'utilisateur';
        message.textContent = `Voulez-vous vraiment supprimer ${user.name} ? Cette action est irréversible.`;
        confirmBtn.className = 'flex-1 px-4 py-3 rounded-xl font-medium transition-all bg-red-500 hover:bg-red-600 text-white';
        confirmBtn.textContent = 'Supprimer';

        confirmBtn.onclick = executeAction;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('confirm-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        pendingAction = null;
    }

    async function executeAction() {
        if (!pendingAction) return;

        const { type, userId } = pendingAction;
        closeModal();

        try {
            if (type === 'toggle') {
                await apiCall(`/admin/api/users/${userId}/toggle-admin`, { method: 'POST' });
                showToast('Droits modifiés avec succès', 'success');
            } else if (type === 'delete') {
                await apiCall(`/admin/api/users/${userId}`, { method: 'DELETE' });
                showToast('Utilisateur supprimé', 'success');
            }
            clearApiCache('/admin/api/users');
            loadUsers();
        } catch (error) {
            console.error('Error:', error);
            showError(error.message || 'Une erreur est survenue');
        }
    }

    function showError(message) {
        const errorEl = document.getElementById('error');
        const errorMessageEl = document.getElementById('error-message');
        errorMessageEl.textContent = message;
        errorEl.classList.remove('hidden');

        setTimeout(() => {
            errorEl.classList.add('hidden');
        }, 5000);
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    // Event listeners
    document.getElementById('search').addEventListener('input', filterUsers);
    document.getElementById('filter-admin').addEventListener('change', filterUsers);

    // Close modal on escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });

    // Initialize
    loadUsers();
</script>
@endpush
