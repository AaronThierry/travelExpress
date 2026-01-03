@extends('admin.layout')

@section('title', 'Gestion des dossiers étudiants')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Gestion des dossiers étudiants</h1>
        <button onclick="showCreateModal()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau dossier
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6" id="stats-container">
        <!-- Stats will be loaded here -->
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                <select id="filter-status" onchange="loadApplications()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="all">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="incomplete">Incomplet</option>
                    <option value="complete">Complet</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Programme</label>
                <select id="filter-program" onchange="loadApplications()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="all">Tous les programmes</option>
                    <option value="license">License</option>
                    <option value="master">Master</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Recherche</label>
                <input type="text" id="search" placeholder="Nom, email, passeport..." onkeyup="debounceSearch()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tri</label>
                <select id="sort-by" onchange="loadApplications()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="created_at">Date de création</option>
                    <option value="submitted_at">Date de soumission</option>
                    <option value="student_name">Nom</option>
                    <option value="status">Statut</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    <div class="bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Programme</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progression</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="applications-tbody">
                    <!-- Applications will be loaded here -->
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200" id="pagination-container">
            <!-- Pagination will be loaded here -->
        </div>
    </div>
</div>

<!-- Create Application Modal -->
<div id="create-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Créer un nouveau dossier</h2>

        <form id="create-form" onsubmit="createApplication(event)">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Programme</label>
                    <select name="program_type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionnez un programme</option>
                        <option value="license">License</option>
                        <option value="master">Master</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                    <input type="text" name="student_name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="student_email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone (optionnel)</label>
                    <input type="text" name="student_phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Créer et générer le lien
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Link Modal -->
<div id="link-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-2xl w-full mx-4 p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Lien d'upload généré</h2>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <p class="text-sm text-gray-700 mb-2">Envoyez ce lien à l'étudiant pour qu'il puisse uploader ses documents:</p>
            <div class="flex items-center gap-2">
                <input type="text" id="upload-link" readonly class="flex-1 px-3 py-2 bg-white border border-gray-300 rounded-lg font-mono text-sm">
                <button onclick="copyLink()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap">
                    Copier
                </button>
            </div>
        </div>

        <div class="flex gap-3">
            <button onclick="closeLinkModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Fermer
            </button>
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div id="details-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto">
    <div class="bg-white rounded-lg max-w-4xl w-full mx-4 my-8 p-6">
        <div class="flex justify-between items-start mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Détails du dossier</h2>
            <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div id="details-content">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div id="preview-modal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4">
    <div class="relative w-full h-full max-w-6xl max-h-[90vh] bg-white rounded-lg overflow-hidden">
        <div class="absolute top-4 right-4 z-10">
            <button onclick="closePreview()" class="bg-white rounded-full p-2 shadow-lg hover:bg-gray-100">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="preview-content" class="w-full h-full flex items-center justify-center">
            <!-- Preview content will be loaded here -->
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let searchTimeout;
    const authToken = window.authToken || localStorage.getItem('auth_token');

    // Load initial data
    document.addEventListener('DOMContentLoaded', () => {
        loadStats();
        loadApplications();
    });

    function debounceSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentPage = 1;
            loadApplications();
        }, 500);
    }

    async function loadStats() {
        try {
            const response = await fetch('/api/admin/student-applications/stats', {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            const stats = await response.json();

            document.getElementById('stats-container').innerHTML = `
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">${stats.total}</div>
                    <div class="text-blue-100">Total dossiers</div>
                </div>
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">${stats.incomplete}</div>
                    <div class="text-yellow-100">Incomplets</div>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">${stats.complete}</div>
                    <div class="text-green-100">Complets</div>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">${stats.approved}</div>
                    <div class="text-purple-100">Approuvés</div>
                </div>
            `;
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }

    async function loadApplications() {
        const status = document.getElementById('filter-status').value;
        const program = document.getElementById('filter-program').value;
        const search = document.getElementById('search').value;
        const sortBy = document.getElementById('sort-by').value;

        const params = new URLSearchParams({
            page: currentPage,
            status: status,
            program_type: program,
            search: search,
            sort_by: sortBy,
            sort_order: 'desc'
        });

        try {
            const response = await fetch(`/api/admin/student-applications?${params}`, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            // Render applications
            const tbody = document.getElementById('applications-tbody');
            if (data.data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Aucun dossier trouvé
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.data.map(app => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">${app.student_name}</div>
                        <div class="text-sm text-gray-500">${app.student_email}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded ${app.program_type === 'master' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'}">
                            ${app.program_type === 'master' ? 'Master' : 'License'}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: ${app.completion_percentage || 0}%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-700">${app.completion_percentage || 0}%</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded ${getStatusClass(app.status)}">
                            ${getStatusLabel(app.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        ${new Date(app.created_at).toLocaleDateString('fr-FR')}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button onclick="viewDetails(${app.id})" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Voir
                            </button>
                            <button onclick="copyUploadLink('${app.upload_link}')" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                Lien
                            </button>
                            <button onclick="deleteApplication(${app.id})" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Supprimer
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');

        } catch (error) {
            console.error('Error loading applications:', error);
        }
    }

    function getStatusClass(status) {
        const classes = {
            'pending': 'bg-gray-100 text-gray-800',
            'incomplete': 'bg-yellow-100 text-yellow-800',
            'complete': 'bg-blue-100 text-blue-800',
            'approved': 'bg-green-100 text-green-800',
            'rejected': 'bg-red-100 text-red-800'
        };
        return classes[status] || classes.pending;
    }

    function getStatusLabel(status) {
        const labels = {
            'pending': 'En attente',
            'incomplete': 'Incomplet',
            'complete': 'Complet',
            'approved': 'Approuvé',
            'rejected': 'Rejeté'
        };
        return labels[status] || status;
    }

    function showCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
        document.getElementById('create-form').reset();
    }

    async function createApplication(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('/api/admin/student-applications', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                closeCreateModal();
                document.getElementById('upload-link').value = result.upload_link;
                document.getElementById('link-modal').classList.remove('hidden');
                loadStats();
                loadApplications();
            } else {
                alert('Erreur lors de la création du dossier');
            }
        } catch (error) {
            console.error('Error creating application:', error);
            alert('Une erreur est survenue');
        }
    }

    function closeLinkModal() {
        document.getElementById('link-modal').classList.add('hidden');
    }

    function copyLink() {
        const link = document.getElementById('upload-link');
        link.select();
        document.execCommand('copy');
        alert('Lien copié dans le presse-papiers!');
    }

    function copyUploadLink(link) {
        navigator.clipboard.writeText(link).then(() => {
            alert('Lien copié dans le presse-papiers!');
        });
    }

    async function viewDetails(id) {
        try {
            const response = await fetch(`/api/admin/student-applications/${id}`, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            const app = data.application;
            const docs = data.required_documents;

            const content = `
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <div class="text-gray-900">${app.student_name}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="text-gray-900">${app.student_email}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Programme</label>
                            <div class="text-gray-900">${app.program_type === 'master' ? 'Master' : 'License'}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                            <span class="px-2 py-1 text-xs font-medium rounded ${getStatusClass(app.status)}">
                                ${getStatusLabel(app.status)}
                            </span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Documents (${app.documents.length})</h3>
                        <div class="space-y-2">
                            ${app.documents.map(doc => `
                                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">${docs[doc.document_type] || doc.document_type}</div>
                                        <div class="text-sm text-gray-500">${doc.original_filename} (${doc.file_size_human})</div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded ${getStatusClass(doc.status)}">
                                            ${getStatusLabel(doc.status)}
                                        </span>
                                        ${['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'].includes(doc.mime_type) ?
                                            `<button onclick="previewDocument(${doc.id})" class="text-purple-600 hover:text-purple-800 text-sm underline">Prévisualiser</button>` :
                                            ''
                                        }
                                        <a href="/document/${doc.id}/download" class="text-blue-600 hover:text-blue-800 text-sm underline">Télécharger</a>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="/student-applications/${app.id}/download-all" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            📦 Télécharger tout (ZIP)
                        </a>
                        <button onclick="closeDetailsModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                            Fermer
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('details-content').innerHTML = content;
            document.getElementById('details-modal').classList.remove('hidden');
        } catch (error) {
            console.error('Error loading details:', error);
        }
    }

    function closeDetailsModal() {
        document.getElementById('details-modal').classList.add('hidden');
    }

    function previewDocument(documentId) {
        const previewContent = document.getElementById('preview-content');
        const previewUrl = `/document/${documentId}/preview`;

        // Check if it's a PDF or image
        fetch(previewUrl)
            .then(response => response.blob())
            .then(blob => {
                const url = URL.createObjectURL(blob);
                const mimeType = blob.type;

                if (mimeType === 'application/pdf') {
                    previewContent.innerHTML = `<iframe src="${url}" class="w-full h-full" frameborder="0"></iframe>`;
                } else if (mimeType.startsWith('image/')) {
                    previewContent.innerHTML = `<img src="${url}" class="max-w-full max-h-full object-contain" alt="Preview">`;
                }

                document.getElementById('preview-modal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error loading preview:', error);
                alert('Impossible de prévisualiser ce document');
            });
    }

    function closePreview() {
        document.getElementById('preview-modal').classList.add('hidden');
        document.getElementById('preview-content').innerHTML = '';
    }

    async function deleteApplication(id) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer ce dossier?')) return;

        try {
            const response = await fetch(`/api/admin/student-applications/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                loadStats();
                loadApplications();
            } else {
                alert('Erreur lors de la suppression');
            }
        } catch (error) {
            console.error('Error deleting application:', error);
        }
    }
</script>
@endsection
