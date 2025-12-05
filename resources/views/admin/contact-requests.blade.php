@extends('admin.layout')

@section('title', 'Gestion des demandes')
@section('page-title', 'Demandes de contact')
@section('page-description', 'Gérez les demandes de vos prospects et contactez-les via WhatsApp')

@section('content')
<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-20">
    <div class="relative">
        <div class="w-16 h-16 border-4 border-indigo-200 rounded-full"></div>
        <div class="absolute top-0 left-0 w-16 h-16 border-4 border-indigo-600 rounded-full animate-spin border-t-transparent"></div>
    </div>
    <p class="mt-4 text-slate-600 font-medium">Chargement des demandes...</p>
</div>

<!-- Main Content -->
<div id="main-content" class="hidden space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900" id="stat-total">0</p>
                    <p class="text-xs text-slate-500">Total</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-lg">🆕</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-green-600" id="stat-new">0</p>
                    <p class="text-xs text-slate-500">Nouvelles</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <span class="text-lg">📞</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-yellow-600" id="stat-contacted">0</p>
                    <p class="text-xs text-slate-500">Contactées</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-lg">⏳</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-purple-600" id="stat-in-progress">0</p>
                    <p class="text-xs text-slate-500">En cours</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <span class="text-lg">✅</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-600" id="stat-completed">0</p>
                    <p class="text-xs text-slate-500">Terminées</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Search -->
            <div class="flex-1 min-w-[200px]">
                <div class="relative">
                    <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" id="search-input" placeholder="Rechercher par nom, email, téléphone..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <!-- Status Filter -->
            <select id="filter-status" class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="all">Tous les statuts</option>
                <option value="new">🆕 Nouveau</option>
                <option value="contacted">📞 Contacté</option>
                <option value="in_progress">⏳ En cours</option>
                <option value="completed">✅ Terminé</option>
                <option value="cancelled">❌ Annulé</option>
            </select>
            <!-- Destination Filter -->
            <select id="filter-destination" class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="all">Toutes destinations</option>
                <option value="china">🇨🇳 Chine</option>
                <option value="spain">🇪🇸 Espagne</option>
                <option value="germany">🇩🇪 Allemagne</option>
                <option value="other">🌍 Autre</option>
            </select>
            <!-- Project Type Filter -->
            <select id="filter-project-type" class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="all">Tous les projets</option>
                <option value="etudes">📚 Études</option>
                <option value="travail">💼 Travail</option>
                <option value="business">🏢 Business</option>
                <option value="autre">📋 Autre</option>
            </select>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Projet</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Destination</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Statut</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody id="requests-list" class="divide-y divide-slate-100">
                    <!-- Dynamic content -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div id="pagination" class="px-4 py-3 border-t border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">
                <span id="pagination-info">0 résultats</span>
            </p>
            <div class="flex gap-2" id="pagination-buttons">
                <!-- Dynamic pagination -->
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detail-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-slate-200 flex items-center justify-between sticky top-0 bg-white">
            <h3 class="text-lg font-bold text-slate-900">Détails de la demande</h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modal-content" class="p-6">
            <!-- Dynamic content -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentPage = 1;
    let currentFilters = {
        status: 'all',
        destination: 'all',
        project_type: 'all',
        search: ''
    };

    const destinations = {
        'china': '🇨🇳 Chine',
        'spain': '🇪🇸 Espagne',
        'germany': '🇩🇪 Allemagne',
        'other': '🌍 Autre'
    };

    const projectTypes = {
        'etudes': '📚 Études',
        'travail': '💼 Travail',
        'business': '🏢 Business',
        'autre': '📋 Autre'
    };

    const statusLabels = {
        'new': { label: 'Nouveau', class: 'bg-blue-100 text-blue-800', icon: '🆕' },
        'contacted': { label: 'Contacté', class: 'bg-yellow-100 text-yellow-800', icon: '📞' },
        'in_progress': { label: 'En cours', class: 'bg-purple-100 text-purple-800', icon: '⏳' },
        'completed': { label: 'Terminé', class: 'bg-green-100 text-green-800', icon: '✅' },
        'cancelled': { label: 'Annulé', class: 'bg-red-100 text-red-800', icon: '❌' }
    };

    async function loadStats() {
        try {
            const response = await fetch('/api/admin/contact-requests/stats', {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();
            if (result.success) {
                document.getElementById('stat-total').textContent = result.data.total;
                document.getElementById('stat-new').textContent = result.data.by_status.new;
                document.getElementById('stat-contacted').textContent = result.data.by_status.contacted;
                document.getElementById('stat-in-progress').textContent = result.data.by_status.in_progress;
                document.getElementById('stat-completed').textContent = result.data.by_status.completed;
            }
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }

    async function loadRequests(page = 1) {
        currentPage = page;
        const params = new URLSearchParams({
            page: page,
            per_page: 10,
            status: currentFilters.status,
            destination: currentFilters.destination,
            project_type: currentFilters.project_type,
            search: currentFilters.search
        });

        try {
            const response = await fetch(`/api/admin/contact-requests?${params}`, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();

            if (result.success) {
                renderRequests(result.data);
                renderPagination(result.meta);
            }
        } catch (error) {
            console.error('Error loading requests:', error);
        }
    }

    function renderRequests(requests) {
        const container = document.getElementById('requests-list');

        if (requests.length === 0) {
            container.innerHTML = `
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-slate-500">Aucune demande trouvée</p>
                    </td>
                </tr>
            `;
            return;
        }

        container.innerHTML = requests.map(req => `
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white font-bold text-sm">${req.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">${req.name}</p>
                            <p class="text-xs text-slate-500">${req.email}</p>
                            <p class="text-xs text-slate-500">${req.phone}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <span class="text-sm">${projectTypes[req.project_type] || req.project_type}</span>
                </td>
                <td class="px-4 py-3">
                    <span class="text-sm">${destinations[req.destination] || req.destination}</span>
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs font-medium rounded-full ${statusLabels[req.status]?.class || 'bg-slate-100 text-slate-800'}">
                        ${statusLabels[req.status]?.icon || ''} ${statusLabels[req.status]?.label || req.status}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <p class="text-sm text-slate-600">${new Date(req.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' })}</p>
                    <p class="text-xs text-slate-400">${new Date(req.created_at).toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</p>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="openWhatsApp(${req.id})" class="p-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" title="Contacter via WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </button>
                        <button onclick="viewDetails(${req.id})" class="p-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors" title="Voir détails">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    function renderPagination(meta) {
        document.getElementById('pagination-info').textContent =
            `${meta.total} résultat${meta.total > 1 ? 's' : ''} - Page ${meta.current_page}/${meta.last_page}`;

        const buttons = document.getElementById('pagination-buttons');
        let html = '';

        if (meta.current_page > 1) {
            html += `<button onclick="loadRequests(${meta.current_page - 1})" class="px-3 py-1 text-sm border border-slate-200 rounded-lg hover:bg-slate-50">Précédent</button>`;
        }
        if (meta.current_page < meta.last_page) {
            html += `<button onclick="loadRequests(${meta.current_page + 1})" class="px-3 py-1 text-sm border border-slate-200 rounded-lg hover:bg-slate-50">Suivant</button>`;
        }

        buttons.innerHTML = html;
    }

    async function openWhatsApp(id) {
        try {
            const response = await fetch(`/api/admin/contact-requests/${id}/contacted`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();

            if (result.success) {
                window.open(result.whatsapp_link, '_blank');
                loadRequests(currentPage);
                loadStats();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function viewDetails(id) {
        try {
            const response = await fetch(`/api/admin/contact-requests/${id}`, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();

            if (result.success) {
                showDetailModal(result.data, result.whatsapp_link);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function showDetailModal(req, whatsappLink) {
        const status = statusLabels[req.status] || { label: req.status, class: 'bg-slate-100 text-slate-800' };

        document.getElementById('modal-content').innerHTML = `
            <div class="space-y-6">
                <!-- Contact Info -->
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">${req.name.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-slate-900">${req.name}</h4>
                        <p class="text-slate-500">${req.email}</p>
                        <p class="text-slate-500">${req.phone}</p>
                        ${req.country ? `<p class="text-slate-500">📍 ${req.country}</p>` : ''}
                    </div>
                    <span class="px-3 py-1 text-sm font-medium rounded-full ${status.class}">
                        ${status.icon || ''} ${status.label}
                    </span>
                </div>

                <!-- Project Info -->
                <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 rounded-xl">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Destination</p>
                        <p class="text-lg">${destinations[req.destination] || req.destination}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Type de projet</p>
                        <p class="text-lg">${projectTypes[req.project_type] || req.project_type}</p>
                    </div>
                </div>

                ${req.project_details ? `
                <div>
                    <p class="text-xs text-slate-500 uppercase font-semibold mb-2">Détails du projet</p>
                    <p class="text-slate-700 bg-slate-50 p-3 rounded-lg">${req.project_details}</p>
                </div>
                ` : ''}

                ${req.message ? `
                <div>
                    <p class="text-xs text-slate-500 uppercase font-semibold mb-2">Message</p>
                    <p class="text-slate-700 bg-slate-50 p-3 rounded-lg">${req.message}</p>
                </div>
                ` : ''}

                <!-- Timestamps -->
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500">Reçu le</p>
                        <p class="font-medium">${new Date(req.created_at).toLocaleString('fr-FR')}</p>
                    </div>
                    ${req.contacted_at ? `
                    <div>
                        <p class="text-slate-500">Premier contact</p>
                        <p class="font-medium">${new Date(req.contacted_at).toLocaleString('fr-FR')}</p>
                    </div>
                    ` : ''}
                    ${req.last_contact_at ? `
                    <div>
                        <p class="text-slate-500">Dernier contact</p>
                        <p class="font-medium">${new Date(req.last_contact_at).toLocaleString('fr-FR')}</p>
                    </div>
                    ` : ''}
                </div>

                <!-- Admin Notes -->
                <div>
                    <p class="text-xs text-slate-500 uppercase font-semibold mb-2">Notes admin</p>
                    <textarea id="admin-notes" class="w-full p-3 border border-slate-200 rounded-lg text-sm" rows="3" placeholder="Ajouter des notes...">${req.admin_notes || ''}</textarea>
                    <button onclick="saveNotes(${req.id})" class="mt-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-200 transition-colors">
                        Enregistrer les notes
                    </button>
                </div>

                <!-- Status Change -->
                <div>
                    <p class="text-xs text-slate-500 uppercase font-semibold mb-2">Changer le statut</p>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="updateStatus(${req.id}, 'new')" class="px-3 py-1.5 text-sm rounded-lg ${req.status === 'new' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200'}">🆕 Nouveau</button>
                        <button onclick="updateStatus(${req.id}, 'contacted')" class="px-3 py-1.5 text-sm rounded-lg ${req.status === 'contacted' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200'}">📞 Contacté</button>
                        <button onclick="updateStatus(${req.id}, 'in_progress')" class="px-3 py-1.5 text-sm rounded-lg ${req.status === 'in_progress' ? 'bg-purple-500 text-white' : 'bg-purple-100 text-purple-800 hover:bg-purple-200'}">⏳ En cours</button>
                        <button onclick="updateStatus(${req.id}, 'completed')" class="px-3 py-1.5 text-sm rounded-lg ${req.status === 'completed' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200'}">✅ Terminé</button>
                        <button onclick="updateStatus(${req.id}, 'cancelled')" class="px-3 py-1.5 text-sm rounded-lg ${req.status === 'cancelled' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-800 hover:bg-red-200'}">❌ Annulé</button>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4 border-t border-slate-200">
                    <a href="${whatsappLink}" target="_blank" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Contacter sur WhatsApp
                    </a>
                    <button onclick="deleteRequest(${req.id})" class="px-4 py-3 bg-red-100 text-red-600 rounded-xl font-semibold hover:bg-red-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;

        document.getElementById('detail-modal').classList.remove('hidden');
        document.getElementById('detail-modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('detail-modal').classList.add('hidden');
        document.getElementById('detail-modal').classList.remove('flex');
    }

    async function updateStatus(id, status) {
        try {
            const response = await fetch(`/api/admin/contact-requests/${id}/status`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status })
            });
            const result = await response.json();

            if (result.success) {
                viewDetails(id);
                loadRequests(currentPage);
                loadStats();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function saveNotes(id) {
        const notes = document.getElementById('admin-notes').value;
        try {
            const response = await fetch(`/api/admin/contact-requests/${id}/notes`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ admin_notes: notes })
            });
            const result = await response.json();

            if (result.success) {
                alert('Notes enregistrées!');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function deleteRequest(id) {
        if (!confirm('Supprimer cette demande?')) return;

        try {
            const response = await fetch(`/api/admin/contact-requests/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();

            if (result.success) {
                closeModal();
                loadRequests(currentPage);
                loadStats();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Event listeners for filters
    document.getElementById('search-input').addEventListener('input', debounce(function() {
        currentFilters.search = this.value;
        loadRequests(1);
    }, 300));

    document.getElementById('filter-status').addEventListener('change', function() {
        currentFilters.status = this.value;
        loadRequests(1);
    });

    document.getElementById('filter-destination').addEventListener('change', function() {
        currentFilters.destination = this.value;
        loadRequests(1);
    });

    document.getElementById('filter-project-type').addEventListener('change', function() {
        currentFilters.project_type = this.value;
        loadRequests(1);
    });

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Close modal on outside click
    document.getElementById('detail-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Initialize
    async function init() {
        await Promise.all([loadStats(), loadRequests()]);
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('main-content').classList.remove('hidden');
    }

    init();
</script>
@endsection
