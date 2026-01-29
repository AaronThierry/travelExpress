@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white" style="font-family: 'Playfair Display', serif;">
                Demandes de contact
            </h1>
            <p class="text-gray-400 mt-1">Gérez les demandes et contactez vos prospects</p>
        </div>
    </div>

    <!-- Loading State -->
    <div id="loading" class="elegant-card p-12 text-center">
        <div class="inline-block w-10 h-10 border-3 border-[#d4af37]/20 border-t-[#d4af37] rounded-full animate-spin"></div>
        <p class="mt-4 text-gray-400">Chargement des demandes...</p>
    </div>

    <!-- Main Content -->
    <div id="content-area" class="hidden space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
            <div class="elegant-card p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#d4af37]/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white" id="stat-total">0</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                </div>
            </div>
            <div class="elegant-card p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center">
                        <span class="text-lg">🆕</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-emerald-400" id="stat-new">0</p>
                        <p class="text-xs text-gray-500">Nouvelles</p>
                    </div>
                </div>
            </div>
            <div class="elegant-card p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500/20 rounded-xl flex items-center justify-center">
                        <span class="text-lg">📞</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-amber-400" id="stat-contacted">0</p>
                        <p class="text-xs text-gray-500">Contactées</p>
                    </div>
                </div>
            </div>
            <div class="elegant-card p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <span class="text-lg">⏳</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-purple-400" id="stat-in-progress">0</p>
                        <p class="text-xs text-gray-500">En cours</p>
                    </div>
                </div>
            </div>
            <div class="elegant-card p-4 col-span-2 sm:col-span-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <span class="text-lg">✅</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-400" id="stat-completed">0</p>
                        <p class="text-xs text-gray-500">Terminées</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="elegant-card p-4">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <div class="flex-1 relative">
                    <svg class="w-5 h-5 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="search-input" placeholder="Rechercher..."
                        class="w-full pl-12 pr-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] outline-none transition-all">
                </div>
                <div class="flex gap-2 overflow-x-auto pb-1 sm:pb-0">
                    <select id="filter-status" class="px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white focus:border-[#d4af37] outline-none cursor-pointer">
                        <option value="all">Statut</option>
                        <option value="new">🆕 Nouveau</option>
                        <option value="contacted">📞 Contacté</option>
                        <option value="in_progress">⏳ En cours</option>
                        <option value="completed">✅ Terminé</option>
                        <option value="cancelled">❌ Annulé</option>
                    </select>
                    <select id="filter-destination" class="px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white focus:border-[#d4af37] outline-none cursor-pointer">
                        <option value="all">Destination</option>
                        <option value="china">🇨🇳 Chine</option>
                        <option value="spain">🇪🇸 Espagne</option>
                        <option value="germany">🇩🇪 Allemagne</option>
                        <option value="other">🌍 Autre</option>
                    </select>
                    <select id="filter-project-type" class="px-4 py-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white focus:border-[#d4af37] outline-none cursor-pointer">
                        <option value="all">Projet</option>
                        <option value="etudes">📚 Études</option>
                        <option value="travail">💼 Travail</option>
                        <option value="business">🏢 Business</option>
                        <option value="autre">📋 Autre</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Requests Table -->
        <div class="elegant-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#d4af37]/10">
                            <th class="px-4 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Contact</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider hidden sm:table-cell">Projet</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider hidden md:table-cell">Destination</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Statut</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-[#d4af37] uppercase tracking-wider hidden lg:table-cell">Date</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-[#d4af37] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="requests-list" class="divide-y divide-[#d4af37]/10">
                        <!-- Dynamic content -->
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div id="pagination" class="px-4 py-3 border-t border-[#d4af37]/10 flex items-center justify-between">
                <p class="text-sm text-gray-500" id="pagination-info">0 résultats</p>
                <div class="flex gap-2" id="pagination-buttons"></div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detail-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="elegant-card w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-5 border-b border-[#d4af37]/10 flex items-center justify-between sticky top-0 bg-[#1a1a1a] z-10">
            <h3 class="text-lg font-bold text-white">Détails de la demande</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-white p-1 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="modal-content" class="p-5"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentPage = 1;
    let currentFilters = { status: 'all', destination: 'all', project_type: 'all', search: '' };

    const destinations = { 'china': '🇨🇳 Chine', 'spain': '🇪🇸 Espagne', 'germany': '🇩🇪 Allemagne', 'other': '🌍 Autre' };
    const projectTypes = { 'etudes': '📚 Études', 'travail': '💼 Travail', 'business': '🏢 Business', 'autre': '📋 Autre' };
    const statusLabels = {
        'new': { label: 'Nouveau', class: 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30', icon: '🆕' },
        'contacted': { label: 'Contacté', class: 'bg-amber-500/20 text-amber-400 border-amber-500/30', icon: '📞' },
        'in_progress': { label: 'En cours', class: 'bg-purple-500/20 text-purple-400 border-purple-500/30', icon: '⏳' },
        'completed': { label: 'Terminé', class: 'bg-green-500/20 text-green-400 border-green-500/30', icon: '✅' },
        'cancelled': { label: 'Annulé', class: 'bg-red-500/20 text-red-400 border-red-500/30', icon: '❌' }
    };

    async function loadStats(fresh = false) {
        try {
            const result = await apiCall('/admin/api/contact-requests/stats', fresh ? { noCache: true } : {});
            if (result.success) {
                document.getElementById('stat-total').textContent = result.data.total || 0;
                document.getElementById('stat-new').textContent = result.data.by_status?.new || 0;
                document.getElementById('stat-contacted').textContent = result.data.by_status?.contacted || 0;
                document.getElementById('stat-in-progress').textContent = result.data.by_status?.in_progress || 0;
                document.getElementById('stat-completed').textContent = result.data.by_status?.completed || 0;
            }
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }

    async function loadRequests(page = 1, fresh = false) {
        currentPage = page;
        const params = new URLSearchParams({
            page, per_page: 15,
            status: currentFilters.status,
            destination: currentFilters.destination,
            project_type: currentFilters.project_type,
            search: currentFilters.search
        });

        try {
            const result = await apiCall(`/admin/api/contact-requests?${params}`, fresh ? { noCache: true } : {});
            if (result.success) {
                renderRequests(result.data);
                renderPagination(result.meta);
            }
        } catch (error) {
            console.error('Error loading requests:', error);
            renderRequests([]);
        }
    }

    function renderRequests(requests) {
        const container = document.getElementById('requests-list');

        if (!requests || requests.length === 0) {
            container.innerHTML = `
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-[#d4af37]/10 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-400">Aucune demande trouvée</p>
                    </td>
                </tr>`;
            return;
        }

        container.innerHTML = requests.map(req => {
            const status = statusLabels[req.status] || statusLabels['new'];
            return `
            <tr class="hover:bg-[#d4af37]/5 transition-colors">
                <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#d4af37] to-[#b8960c] flex items-center justify-center flex-shrink-0 shadow-lg shadow-[#d4af37]/20">
                            <span class="text-[#0a0a0a] font-bold text-sm">${req.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-white truncate">${escapeHtml(req.name)}</p>
                            <p class="text-xs text-gray-500 truncate">${escapeHtml(req.email)}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-4 hidden sm:table-cell">
                    <span class="text-sm text-gray-400">${projectTypes[req.project_type] || req.project_type}</span>
                </td>
                <td class="px-4 py-4 hidden md:table-cell">
                    <span class="text-sm text-gray-400">${destinations[req.destination] || req.destination}</span>
                </td>
                <td class="px-4 py-4">
                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full border ${status.class}">
                        ${status.icon}
                    </span>
                </td>
                <td class="px-4 py-4 hidden lg:table-cell">
                    <p class="text-sm text-gray-400">${formatDate(req.created_at)}</p>
                </td>
                <td class="px-4 py-4">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="openWhatsApp(${req.id})" class="p-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" title="WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </button>
                        <button onclick="viewDetails(${req.id})" class="p-2 bg-[#d4af37]/20 text-[#d4af37] rounded-lg hover:bg-[#d4af37]/30 transition-colors" title="Détails">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }

    function renderPagination(meta) {
        if (!meta) return;
        document.getElementById('pagination-info').textContent = `${meta.total} - Page ${meta.current_page}/${meta.last_page}`;
        const buttons = document.getElementById('pagination-buttons');
        let html = '';
        if (meta.current_page > 1) {
            html += `<button onclick="loadRequests(${meta.current_page - 1})" class="px-3 py-1.5 text-sm border border-[#d4af37]/20 text-gray-400 rounded-lg hover:bg-[#d4af37]/10 hover:text-[#d4af37] transition-colors">←</button>`;
        }
        if (meta.current_page < meta.last_page) {
            html += `<button onclick="loadRequests(${meta.current_page + 1})" class="px-3 py-1.5 text-sm border border-[#d4af37]/20 text-gray-400 rounded-lg hover:bg-[#d4af37]/10 hover:text-[#d4af37] transition-colors">→</button>`;
        }
        buttons.innerHTML = html;
    }

    async function openWhatsApp(id) {
        try {
            const result = await apiCall(`/admin/api/contact-requests/${id}/contacted`, { method: 'POST' });
            if (result.success) {
                window.open(result.whatsapp_link, '_blank');
                clearApiCache('/admin/api/contact-requests');
                loadRequests(currentPage);
                loadStats();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function viewDetails(id) {
        try {
            const result = await apiCall(`/admin/api/contact-requests/${id}`);
            if (result.success) {
                showDetailModal(result.data, result.whatsapp_link);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function showDetailModal(req, whatsappLink) {
        const status = statusLabels[req.status] || statusLabels['new'];
        document.getElementById('modal-content').innerHTML = `
            <div class="space-y-5">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#d4af37] to-[#b8960c] flex items-center justify-center flex-shrink-0 shadow-lg shadow-[#d4af37]/20">
                        <span class="text-[#0a0a0a] font-bold text-xl">${req.name.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xl font-bold text-white">${escapeHtml(req.name)}</h4>
                        <p class="text-gray-400 text-sm">${escapeHtml(req.email)}</p>
                        <p class="text-gray-400 text-sm">${escapeHtml(req.phone)}</p>
                    </div>
                    <span class="px-3 py-1.5 text-xs font-medium rounded-full border ${status.class}">
                        ${status.icon} ${status.label}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 p-4 bg-[#0a0a0a] rounded-xl border border-[#d4af37]/10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Destination</p>
                        <p class="text-white">${destinations[req.destination] || req.destination}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Projet</p>
                        <p class="text-white">${projectTypes[req.project_type] || req.project_type}</p>
                    </div>
                </div>

                ${req.project_details ? `
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Détails du projet</p>
                    <p class="text-gray-300 bg-[#0a0a0a] p-3 rounded-xl border border-[#d4af37]/10 text-sm">${escapeHtml(req.project_details)}</p>
                </div>` : ''}

                ${req.message ? `
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Message</p>
                    <p class="text-gray-300 bg-[#0a0a0a] p-3 rounded-xl border border-[#d4af37]/10 text-sm">${escapeHtml(req.message)}</p>
                </div>` : ''}

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Reçu le</p>
                        <p class="text-white font-medium">${formatDate(req.created_at)}</p>
                    </div>
                    ${req.contacted_at ? `
                    <div>
                        <p class="text-gray-500">1er contact</p>
                        <p class="text-white font-medium">${formatDate(req.contacted_at)}</p>
                    </div>` : ''}
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Notes admin</p>
                    <textarea id="admin-notes" class="w-full p-3 bg-[#0a0a0a] border border-[#d4af37]/20 rounded-xl text-white placeholder-gray-500 focus:border-[#d4af37] outline-none text-sm" rows="2" placeholder="Ajouter des notes...">${req.admin_notes || ''}</textarea>
                    <button onclick="saveNotes(${req.id})" class="mt-2 px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors">
                        Enregistrer
                    </button>
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Changer le statut</p>
                    <div class="flex flex-wrap gap-2">
                        ${Object.entries(statusLabels).map(([key, val]) => `
                            <button onclick="updateStatus(${req.id}, '${key}')" class="px-3 py-2 text-sm rounded-lg border transition-all ${req.status === key ? 'bg-[#d4af37] text-black border-[#d4af37]' : 'border-[#d4af37]/20 text-gray-400 hover:border-[#d4af37] hover:text-[#d4af37]'}">
                                ${val.icon}
                            </button>
                        `).join('')}
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t border-[#d4af37]/10">
                    <a href="${whatsappLink}" target="_blank" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp
                    </a>
                    <button onclick="deleteRequest(${req.id})" class="px-4 py-3 bg-red-500/20 text-red-400 rounded-xl font-semibold hover:bg-red-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>`;

        document.getElementById('detail-modal').classList.remove('hidden');
        document.getElementById('detail-modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('detail-modal').classList.add('hidden');
        document.getElementById('detail-modal').classList.remove('flex');
    }

    async function updateStatus(id, status) {
        try {
            const result = await apiCall(`/admin/api/contact-requests/${id}/status`, {
                method: 'POST',
                body: JSON.stringify({ status })
            });
            if (result.success) {
                clearApiCache('/admin/api/contact-requests');
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
            const result = await apiCall(`/admin/api/contact-requests/${id}/notes`, {
                method: 'POST',
                body: JSON.stringify({ admin_notes: notes })
            });
            if (result.success) {
                showToast('Notes enregistrées', 'success');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function deleteRequest(id) {
        if (!confirm('Supprimer cette demande ?')) return;
        try {
            const result = await apiCall(`/admin/api/contact-requests/${id}`, { method: 'DELETE' });
            if (result.success) {
                closeModal();
                clearApiCache('/admin/api/contact-requests');
                loadRequests(currentPage);
                loadStats();
                showToast('Demande supprimée', 'success');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        return new Date(dateString).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Event listeners
    document.getElementById('search-input').addEventListener('input', debounce(function() {
        currentFilters.search = this.value;
        clearApiCache('/admin/api/contact-requests');
        loadRequests(1);
    }, 300));

    document.getElementById('filter-status').addEventListener('change', function() {
        currentFilters.status = this.value;
        clearApiCache('/admin/api/contact-requests');
        loadRequests(1);
    });

    document.getElementById('filter-destination').addEventListener('change', function() {
        currentFilters.destination = this.value;
        clearApiCache('/admin/api/contact-requests');
        loadRequests(1);
    });

    document.getElementById('filter-project-type').addEventListener('change', function() {
        currentFilters.project_type = this.value;
        clearApiCache('/admin/api/contact-requests');
        loadRequests(1);
    });

    document.getElementById('detail-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });

    // Initialize with fresh data (bypass cache)
    async function init() {
        try {
            await Promise.all([loadStats(true), loadRequests(1, true)]);
        } catch (error) {
            console.error('Init error:', error);
            document.getElementById('requests-list').innerHTML = `
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center">
                        <div class="text-red-400">Erreur de chargement: ${error.message}</div>
                        <button onclick="init()" class="mt-4 px-4 py-2 bg-[#d4af37] text-black rounded-lg">Réessayer</button>
                    </td>
                </tr>`;
        } finally {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('content-area').classList.remove('hidden');
        }
    }
    init();
</script>
@endpush
