@extends('admin.layout')

@section('title', 'Gestion des utilisateurs')
@section('page-title', 'Utilisateurs')
@section('page-description', 'Gérez les comptes utilisateurs et les droits administrateur')

@section('content')
<!-- Search and Filter -->
<div class="mb-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-4">
            <div class="flex-1">
                <input type="text" id="search" placeholder="Rechercher par nom ou email..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
            </div>
            <select id="filter-admin" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                <option value="all">Tous les utilisateurs</option>
                <option value="admin">Administrateurs</option>
                <option value="user">Utilisateurs</option>
            </select>
        </div>
    </div>
</div>

<!-- Loading State -->
<div id="loading" class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
    <p class="mt-2 text-gray-600">Chargement...</p>
</div>

<!-- Error State -->
<div id="error" class="hidden bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
    <p id="error-message"></p>
</div>

<!-- Users Table -->
<div id="users-table" class="hidden bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pays</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscription</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="users-list" class="bg-white divide-y divide-gray-200">
                <!-- Will be populated dynamically -->
            </tbody>
        </table>
    </div>
</div>

<!-- Empty State -->
<div id="empty-state" class="hidden text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200">
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun utilisateur trouvé</h3>
    <p class="mt-1 text-sm text-gray-500">Essayez de modifier vos filtres de recherche</p>
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
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                            <span class="text-primary-600 font-bold text-lg">${user.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">${user.name}</p>
                            <p class="text-xs text-gray-500">${user.position || 'Non spécifié'}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.email}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.country || '-'}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-medium rounded-full ${user.is_admin ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'}">
                        ${user.is_admin ? 'Administrateur' : 'Utilisateur'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.created_at}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button onclick="toggleAdmin(${user.id})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                        ${user.is_admin ? 'Retirer admin' : 'Promouvoir'}
                    </button>
                    <button onclick="deleteUser(${user.id})" class="text-red-600 hover:text-red-900">
                        Supprimer
                    </button>
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
