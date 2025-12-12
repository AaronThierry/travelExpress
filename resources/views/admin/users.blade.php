@extends('admin.layout')

@section('title', 'Gestion des utilisateurs')
@section('page-title', 'Utilisateurs')
@section('page-description', 'Gérez les comptes utilisateurs et les droits administrateur')

@section('content')
<!-- Search and Filter -->
<div class="mb-4 sm:mb-6">
    <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200 p-3 sm:p-4">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
            <div class="flex-1">
                <input type="text" id="search" placeholder="Rechercher..."
                    class="w-full px-3 sm:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
            </div>
            <select id="filter-admin" class="px-3 sm:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                <option value="all">Tous</option>
                <option value="admin">Admins</option>
                <option value="user">Utilisateurs</option>
            </select>
        </div>
    </div>
</div>

<!-- Loading State -->
<div id="loading" class="text-center py-8 sm:py-12 bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200">
    <div class="inline-block animate-spin rounded-full h-6 w-6 sm:h-8 sm:w-8 border-b-2 border-primary-600"></div>
    <p class="mt-2 text-gray-600 text-sm">Chargement...</p>
</div>

<!-- Error State -->
<div id="error" class="hidden bg-red-50 border border-red-200 text-red-800 px-3 sm:px-4 py-2 sm:py-3 rounded-lg text-sm mb-4 sm:mb-6">
    <p id="error-message"></p>
</div>

<!-- Users Table -->
<div id="users-table" class="hidden bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-[10px] sm:text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-[10px] sm:text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Email</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-[10px] sm:text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Pays</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-[10px] sm:text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-[10px] sm:text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Inscription</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-right text-[10px] sm:text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="users-list" class="bg-white divide-y divide-gray-200">
                <!-- Will be populated dynamically -->
            </tbody>
        </table>
    </div>
</div>

<!-- Empty State -->
<div id="empty-state" class="hidden text-center py-8 sm:py-12 bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200">
    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun utilisateur trouvé</h3>
    <p class="mt-1 text-xs sm:text-sm text-gray-500">Essayez de modifier vos filtres</p>
</div>
@endsection

@section('scripts')
<script>
    let allUsers = [];
    let filteredUsers = [];

    async function loadUsers() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const tableEl = document.getElementById('users-table');
        const emptyEl = document.getElementById('empty-state');

        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
        tableEl.classList.add('hidden');
        emptyEl.classList.add('hidden');

        try {
            const response = await fetch('/api/admin/users', {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors du chargement des utilisateurs');
            }

            const result = await response.json();
            allUsers = result.data;
            filteredUsers = allUsers;

            loadingEl.classList.add('hidden');

            if (filteredUsers.length === 0) {
                emptyEl.classList.remove('hidden');
            } else {
                tableEl.classList.remove('hidden');
                renderUsers();
            }
        } catch (error) {
            console.error('Error:', error);
            loadingEl.classList.add('hidden');
            showError(error.message);
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
            <tr class="hover:bg-gray-50">
                <td class="px-3 sm:px-6 py-3 sm:py-4">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-xs sm:text-sm">${user.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 truncate">${user.name}</p>
                            <p class="text-[10px] sm:text-xs text-gray-500 truncate md:hidden">${user.email}</p>
                        </div>
                    </div>
                </td>
                <td class="px-3 sm:px-6 py-3 sm:py-4 hidden md:table-cell">
                    <p class="text-xs sm:text-sm text-gray-600 truncate max-w-[200px]">${user.email}</p>
                </td>
                <td class="px-3 sm:px-6 py-3 sm:py-4 hidden sm:table-cell">
                    <span class="text-xs sm:text-sm text-gray-600">${user.country || '-'}</span>
                </td>
                <td class="px-3 sm:px-6 py-3 sm:py-4">
                    <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 text-[10px] sm:text-xs font-medium rounded-full ${user.is_admin ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'}">
                        ${user.is_admin ? 'Admin' : 'User'}
                    </span>
                </td>
                <td class="px-3 sm:px-6 py-3 sm:py-4 hidden lg:table-cell">
                    <span class="text-xs sm:text-sm text-gray-600">${user.created_at}</span>
                </td>
                <td class="px-3 sm:px-6 py-3 sm:py-4 text-right">
                    <div class="flex items-center justify-end gap-1 sm:gap-2">
                        <button onclick="toggleAdmin(${user.id})" class="p-1.5 sm:p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="${user.is_admin ? 'Retirer admin' : 'Promouvoir'}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${user.is_admin ? 'M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6' : 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z'}"></path>
                            </svg>
                        </button>
                        <button onclick="deleteUser(${user.id})" class="p-1.5 sm:p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    async function toggleAdmin(userId) {
        const user = allUsers.find(u => u.id === userId);
        const action = user.is_admin ? 'retirer les droits administrateur de' : 'promouvoir';

        if (!confirm(`Voulez-vous vraiment ${action} cet utilisateur ?`)) return;

        try {
            const response = await fetch(`/api/admin/users/${userId}/toggle-admin`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Erreur lors de la modification');
            }

            loadUsers();
        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    async function deleteUser(userId) {
        if (!confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action est irréversible.')) return;

        try {
            const response = await fetch(`/api/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Erreur lors de la suppression');
            }

            loadUsers();
        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
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

    // Event listeners
    document.getElementById('search').addEventListener('input', filterUsers);
    document.getElementById('filter-admin').addEventListener('change', filterUsers);

    // Initialize
    loadUsers();
</script>
@endsection
