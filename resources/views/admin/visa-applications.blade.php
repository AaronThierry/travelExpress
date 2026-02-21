@extends('admin.layout')

@section('title', 'Dossiers Visa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900 p-6">

    <!-- ── Header ──────────────────────────────────────────────────── -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold" style="background:linear-gradient(to right,#93c5fd,#60a5fa,#93c5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                Dossiers Visa
            </h1>
            <p class="text-gray-400 mt-1">Gestion des dossiers de demande de visa</p>
        </div>
        <button onclick="showCreateModal()"
                class="px-6 py-3 font-bold rounded-xl flex items-center gap-2 transition-all"
                style="background:linear-gradient(to right,#3b82f6,#2563eb);color:white;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau Dossier Visa
        </button>
    </div>

    <!-- ── Stats ────────────────────────────────────────────────────── -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8" id="stats-container">
        @foreach(['total'=>['Tous','gray'],'pending'=>['En attente','yellow'],'in_progress'=>['En cours','blue'],'complete'=>['Complet','indigo'],'approved'=>['Approuvé','green'],'rejected'=>['Rejeté','red']] as $k=>[$label,$color])
        <div class="rounded-2xl p-6 border"
             style="background:rgba(30,41,59,0.5);border-color:rgba(59,130,246,0.15);">
            <div class="text-2xl font-bold text-white" id="stat-{{ $k }}">—</div>
            <div class="text-xs text-gray-400 mt-1">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    <!-- ── Filters ───────────────────────────────────────────────────── -->
    <div class="rounded-2xl p-5 mb-6 border" style="background:rgba(30,41,59,0.4);border-color:rgba(59,130,246,0.2);">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2" style="color:#60a5fa;">Statut</label>
                <select id="filter-status" onchange="loadVisas()"
                        class="w-full px-4 py-3 rounded-xl text-white transition-all"
                        style="background:rgba(15,23,42,0.8);border:1px solid rgba(59,130,246,0.3);">
                    <option value="all">Tous</option>
                    <option value="pending">En attente</option>
                    <option value="in_progress">En cours</option>
                    <option value="complete">Complet</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2" style="color:#60a5fa;">Recherche</label>
                <input type="text" id="filter-search" oninput="debounceLoad()"
                       placeholder="Nom ou email..."
                       class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-500 transition-all"
                       style="background:rgba(15,23,42,0.8);border:1px solid rgba(59,130,246,0.3);">
            </div>
            <div class="flex items-end">
                <button onclick="loadVisas()"
                        class="w-full px-4 py-3 rounded-xl font-medium transition-all"
                        style="background:rgba(59,130,246,0.2);color:#60a5fa;border:1px solid rgba(59,130,246,0.3);">
                    Rechercher
                </button>
            </div>
        </div>
    </div>

    <!-- ── Table ─────────────────────────────────────────────────────── -->
    <div class="rounded-2xl overflow-hidden border" style="background:rgba(15,23,42,0.7);border-color:rgba(59,130,246,0.2);">
        <table class="w-full">
            <thead>
                <tr style="background:rgba(59,130,246,0.1);border-bottom:1px solid rgba(59,130,246,0.2);">
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-blue-300">Candidat</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-blue-300 hidden md:table-cell">Contact</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-blue-300 hidden lg:table-cell">Progression</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-blue-300">Statut</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-blue-300 hidden lg:table-cell">Soumis le</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-blue-300">Actions</th>
                </tr>
            </thead>
            <tbody id="visa-table-body">
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="animate-spin w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full mx-auto mb-3"></div>
                        Chargement...
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t flex items-center justify-between" style="border-color:rgba(59,130,246,0.2);">
            <span class="text-sm text-gray-400" id="pagination-info">—</span>
            <div class="flex gap-2" id="pagination-buttons"></div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════════════ -->
<!-- Modal: Créer un dossier visa                                       -->
<!-- ══════════════════════════════════════════════════════════════════ -->
<div id="create-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    <div class="rounded-2xl p-8 w-full max-w-lg border" style="background:#0f172a;border-color:rgba(59,130,246,0.3);">
        <h2 class="text-xl font-bold mb-6" style="color:#60a5fa;">Nouveau Dossier Visa</h2>
        <form onsubmit="createVisa(event)" class="space-y-4">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Nom complet</label>
                    <input type="text" name="student_name" class="w-full px-4 py-3 rounded-xl text-white" placeholder="Nom du candidat"
                           style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Email</label>
                    <input type="email" name="student_email" class="w-full px-4 py-3 rounded-xl text-white" placeholder="email@example.com"
                           style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Téléphone</label>
                    <input type="text" name="student_phone" class="w-full px-4 py-3 rounded-xl text-white" placeholder="+226 XX XX XX XX"
                           style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">N° Passeport</label>
                    <input type="text" name="passport_number" class="w-full px-4 py-3 rounded-xl text-white" placeholder="Numéro passeport"
                           style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);">
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Notes admin</label>
                <textarea name="admin_notes" rows="2" placeholder="Notes internes..."
                          class="w-full px-4 py-3 rounded-xl text-white"
                          style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 py-3 rounded-xl font-bold text-white transition-all"
                        style="background:linear-gradient(to right,#3b82f6,#2563eb);">
                    Créer le dossier
                </button>
                <button type="button" onclick="closeCreateModal()"
                        class="px-6 py-3 rounded-xl text-gray-300 transition-all"
                        style="background:rgba(75,85,99,0.5);">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════════════ -->
<!-- Modal: Détails dossier visa                                        -->
<!-- ══════════════════════════════════════════════════════════════════ -->
<div id="details-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-start justify-center z-50 p-4 overflow-y-auto">
    <div class="rounded-2xl w-full max-w-3xl my-8 border overflow-hidden" style="background:#0f172a;border-color:rgba(59,130,246,0.3);">
        <div class="flex items-center justify-between p-6 border-b" style="border-color:rgba(59,130,246,0.2);background:rgba(59,130,246,0.07);">
            <h2 class="text-xl font-bold" style="color:#60a5fa;">Détails du Dossier Visa</h2>
            <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="details-content" class="p-6">
            <div class="text-center text-gray-400 py-8">Chargement...</div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════════════ -->
<!-- Modal: Éditer statut / notes                                       -->
<!-- ══════════════════════════════════════════════════════════════════ -->
<div id="edit-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    <div class="rounded-2xl p-8 w-full max-w-md border" style="background:#0f172a;border-color:rgba(59,130,246,0.3);">
        <h2 class="text-xl font-bold mb-6" style="color:#60a5fa;">Modifier le dossier</h2>
        <form onsubmit="saveEdit(event)" class="space-y-4">
            <input type="hidden" id="edit-id">
            <div>
                <label class="block text-sm text-gray-400 mb-1">Statut</label>
                <select id="edit-status" class="w-full px-4 py-3 rounded-xl text-white"
                        style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);">
                    <option value="pending">En attente</option>
                    <option value="in_progress">En cours</option>
                    <option value="complete">Complet</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Notes admin</label>
                <textarea id="edit-notes" rows="3" placeholder="Notes internes..."
                          class="w-full px-4 py-3 rounded-xl text-white"
                          style="background:rgba(255,255,255,0.05);border:1px solid rgba(59,130,246,0.25);"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 py-3 rounded-xl font-bold text-white"
                        style="background:linear-gradient(to right,#3b82f6,#2563eb);">Enregistrer</button>
                <button type="button" onclick="closeEditModal()"
                        class="px-6 py-3 rounded-xl text-gray-300"
                        style="background:rgba(75,85,99,0.5);">Annuler</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="hidden fixed bottom-6 right-6 px-6 py-4 rounded-xl text-white font-medium z-50 transition-all"
     style="background:rgba(15,23,42,0.95);border:1px solid rgba(59,130,246,0.4);">
    <span id="toast-msg"></span>
</div>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    const VISA_DOCS = @json(\App\Models\VisaApplication::DOCUMENTS);
    const OPTIONAL  = @json(\App\Models\VisaApplication::OPTIONAL_DOCUMENTS);

    let currentPage = 1;
    let debounceTimer;

    // ── Toast ─────────────────────────────────────────────────────────
    function showToast(msg, ok = true) {
        const t = document.getElementById('toast');
        t.style.borderColor = ok ? 'rgba(34,197,94,0.4)' : 'rgba(239,68,68,0.4)';
        document.getElementById('toast-msg').textContent = msg;
        t.classList.remove('hidden');
        setTimeout(() => t.classList.add('hidden'), 4000);
    }

    function debounceLoad() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => loadVisas(), 400);
    }

    // ── Load stats + list ─────────────────────────────────────────────
    async function loadStats() {
        try {
            const res  = await fetch('/admin/api/visa-applications/stats');
            const data = await res.json();
            if (data.success) {
                Object.entries(data.data).forEach(([k,v]) => {
                    const el = document.getElementById('stat-' + k);
                    if (el) el.textContent = v;
                });
            }
        } catch {}
    }

    async function loadVisas(page = 1) {
        currentPage = page;
        const status = document.getElementById('filter-status').value;
        const search = document.getElementById('filter-search').value;
        const params = new URLSearchParams({ page, per_page: 15 });
        if (status !== 'all') params.append('status', status);
        if (search)           params.append('search', search);

        const tbody = document.getElementById('visa-table-body');
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-gray-500 py-8">Chargement...</td></tr>';

        try {
            const res  = await fetch('/admin/api/visa-applications?' + params);
            const data = await res.json();
            if (!data.success) { tbody.innerHTML = '<tr><td colspan="6" class="text-center text-red-400 py-8">Erreur de chargement</td></tr>'; return; }

            const visas = data.data;
            if (!visas.length) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-gray-500 py-12">Aucun dossier visa trouvé</td></tr>';
                return;
            }

            tbody.innerHTML = visas.map(v => {
                const statusColors = {
                    pending:     'bg-yellow-500/20 text-yellow-300 border-yellow-700/50',
                    in_progress: 'bg-blue-500/20 text-blue-300 border-blue-700/50',
                    complete:    'bg-indigo-500/20 text-indigo-300 border-indigo-700/50',
                    approved:    'bg-green-500/20 text-green-300 border-green-700/50',
                    rejected:    'bg-red-500/20 text-red-300 border-red-700/50',
                };
                const statusLabels = {
                    pending: 'En attente', in_progress: 'En cours',
                    complete: 'Complet', approved: 'Approuvé', rejected: 'Rejeté',
                };
                const docsCount    = v.documents ? v.documents.length : 0;
                const totalDocs    = Object.keys(VISA_DOCS).length;
                const pct          = Math.round((docsCount / (totalDocs - OPTIONAL.length)) * 100);
                const initials     = v.student_name ? v.student_name.split(' ').map(w => w[0]).join('').substring(0,2).toUpperCase() : '?';
                const submittedAt  = v.student_submitted_at ? new Date(v.student_submitted_at).toLocaleDateString('fr-FR') : '—';

                return `
                <tr class="border-b hover:bg-blue-500/5 transition-all cursor-pointer" style="border-color:rgba(59,130,246,0.1);" onclick="viewDetails(${v.id})">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-xs font-bold text-black flex-shrink-0"
                                 style="background:linear-gradient(135deg,#3b82f6,#60a5fa);">${initials}</div>
                            <div>
                                <div class="font-medium text-white">${v.student_name || '<span class="text-gray-500 italic">Non renseigné</span>'}</div>
                                <div class="text-xs text-gray-500">#${v.id}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        <div class="text-sm text-gray-300">${v.student_email || '—'}</div>
                        <div class="text-xs text-gray-500">${v.student_phone || ''}</div>
                    </td>
                    <td class="px-6 py-4 hidden lg:table-cell">
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-2 rounded-full" style="background:rgba(59,130,246,0.15);">
                                <div class="h-2 rounded-full" style="background:linear-gradient(to right,#3b82f6,#60a5fa);width:${Math.min(pct,100)}%;"></div>
                            </div>
                            <span class="text-xs text-blue-300">${docsCount}/${totalDocs}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-medium rounded-full border ${statusColors[v.status] || 'bg-gray-500/20 text-gray-300 border-gray-700/50'}">
                            ${statusLabels[v.status] || v.status}
                        </span>
                    </td>
                    <td class="px-6 py-4 hidden lg:table-cell text-sm text-gray-400">${submittedAt}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2" onclick="event.stopPropagation()">
                            <button onclick="viewDetails(${v.id})" class="p-2 rounded-lg hover:bg-blue-500/20 transition-colors" style="color:#60a5fa;" title="Voir">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button onclick="editVisa(${v.id})" class="p-2 rounded-lg hover:bg-yellow-500/20 transition-colors" style="color:#f59e0b;" title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button onclick="generateToken(${v.id})" class="p-2 rounded-lg hover:bg-green-500/20 transition-colors" style="color:#4ade80;" title="Générer lien">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </button>
                            <button onclick="deleteVisa(${v.id})" class="p-2 rounded-lg hover:bg-red-500/20 transition-colors" style="color:#f87171;" title="Supprimer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>`;
            }).join('');

            // Pagination
            document.getElementById('pagination-info').textContent =
                `${data.meta.total} dossier(s) — page ${data.meta.current_page}/${data.meta.last_page}`;
            const btns = document.getElementById('pagination-buttons');
            btns.innerHTML = '';
            if (data.meta.current_page > 1)
                btns.innerHTML += `<button onclick="loadVisas(${data.meta.current_page-1})" class="px-4 py-2 rounded-lg text-sm text-blue-300 hover:bg-blue-500/20">← Préc.</button>`;
            if (data.meta.current_page < data.meta.last_page)
                btns.innerHTML += `<button onclick="loadVisas(${data.meta.current_page+1})" class="px-4 py-2 rounded-lg text-sm text-blue-300 hover:bg-blue-500/20">Suiv. →</button>`;

        } catch (e) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center text-red-400 py-8">Erreur de connexion</td></tr>';
        }
    }

    // ── Create ─────────────────────────────────────────────────────────
    function showCreateModal() { document.getElementById('create-modal').classList.remove('hidden'); }
    function closeCreateModal() { document.getElementById('create-modal').classList.add('hidden'); }

    async function createVisa(e) {
        e.preventDefault();
        const fd   = new FormData(e.target);
        const body = Object.fromEntries(fd.entries());
        try {
            const res  = await fetch('/admin/api/visa-applications', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify(body),
            });
            const data = await res.json();
            if (data.success) {
                closeCreateModal();
                e.target.reset();
                loadVisas();
                loadStats();
                showToast('Dossier créé ! Lien copié dans le presse-papier.');
                if (data.access_url) navigator.clipboard.writeText(data.access_url).catch(() => {});
            } else {
                showToast(data.message || 'Erreur', false);
            }
        } catch { showToast('Erreur de connexion', false); }
    }

    // ── View Details ───────────────────────────────────────────────────
    async function viewDetails(id) {
        document.getElementById('details-content').innerHTML = '<div class="text-center text-gray-400 py-8">Chargement...</div>';
        document.getElementById('details-modal').classList.remove('hidden');
        try {
            const res  = await fetch(`/admin/api/visa-applications/${id}`);
            const data = await res.json();
            const v    = data.application;
            const docs = data.docs || [];
            const uploadedMap = {};
            docs.forEach(d => uploadedMap[d.document_type] = d);

            const statusBadge = {
                pending:'bg-yellow-500/20 text-yellow-300',in_progress:'bg-blue-500/20 text-blue-300',
                complete:'bg-indigo-500/20 text-indigo-300',approved:'bg-green-500/20 text-green-300',
                rejected:'bg-red-500/20 text-red-300',
            };
            const statusLabel = {pending:'En attente',in_progress:'En cours',complete:'Complet',approved:'Approuvé',rejected:'Rejeté'};

            document.getElementById('details-content').innerHTML = `
            <div class="space-y-6">
                <!-- Info candidat -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    ${[['Nom',v.student_name||'—'],['Email',v.student_email||'—'],['Téléphone',v.student_phone||'—'],['Passeport',v.passport_number||'—']].map(([l,val])=>`
                    <div class="rounded-xl p-4" style="background:rgba(59,130,246,0.07);border:1px solid rgba(59,130,246,0.15);">
                        <div class="text-xs text-blue-400 uppercase tracking-wide">${l}</div>
                        <div class="text-white font-medium mt-1 text-sm">${val}</div>
                    </div>`).join('')}
                </div>

                <!-- Statut + lien -->
                <div class="flex flex-wrap items-center gap-4">
                    <span class="px-3 py-1 rounded-full text-sm font-medium ${statusBadge[v.status]||'bg-gray-500/20 text-gray-300'}">
                        ${statusLabel[v.status]||v.status}
                    </span>
                    ${data.access_url ? `
                    <button onclick="navigator.clipboard.writeText('${data.access_url}').then(()=>showToast('Lien copié !'))"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm transition-all"
                            style="background:rgba(59,130,246,0.15);color:#60a5fa;border:1px solid rgba(59,130,246,0.3);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        Copier le lien étudiant
                    </button>` : ''}
                    <button onclick="generateToken(${v.id})"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm transition-all"
                            style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                        Regénérer le lien
                    </button>
                </div>

                ${v.admin_notes ? `
                <div class="p-4 rounded-xl" style="background:rgba(245,158,11,0.07);border:1px solid rgba(245,158,11,0.2);">
                    <div class="text-xs text-yellow-400 uppercase tracking-wide mb-1">Notes admin</div>
                    <p class="text-gray-300 text-sm">${v.admin_notes}</p>
                </div>` : ''}

                <!-- Documents -->
                <div class="rounded-2xl p-6" style="background:rgba(30,40,70,0.5);border:1px solid rgba(59,130,246,0.3);">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold flex items-center gap-2" style="color:#60a5fa;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#60a5fa;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Documents Visa
                        </h3>
                        <span class="text-sm" style="color:#93c5fd;">${docs.length} / ${Object.keys(VISA_DOCS).length}</span>
                    </div>
                    <div class="space-y-2">
                        ${Object.entries(VISA_DOCS).map(([docType, docLabel]) => {
                            const isOpt = OPTIONAL.includes(docType);
                            const doc   = uploadedMap[docType];
                            const clean = docLabel.replace(' (optionnel)', '');
                            const sc    = { pending:'bg-gray-500/20 text-gray-300', approved:'bg-green-500/20 text-green-300', rejected:'bg-red-500/20 text-red-300' };
                            return `
                            <div class="flex items-center justify-between p-4 rounded-xl transition-all"
                                 style="${doc ? 'background:rgba(34,197,94,0.07);border:1px solid rgba(34,197,94,0.2)' : 'background:rgba(59,130,246,0.05);border:1px solid rgba(59,130,246,0.15)'}">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    ${doc
                                        ? `<svg class="w-5 h-5 flex-shrink-0 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>`
                                        : `<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:rgba(59,130,246,0.4)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`
                                    }
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="font-medium text-white text-sm">${clean}</span>
                                            <span class="text-xs px-2 py-0.5 rounded" style="${isOpt ? 'background:rgba(107,114,128,0.3);color:#9ca3af' : 'background:rgba(59,130,246,0.15);color:#93c5fd'}">${isOpt ? 'Optionnel' : 'Requis'}</span>
                                        </div>
                                        ${doc ? `<div class="text-xs text-gray-500 mt-0.5 truncate">${doc.original_filename} (${doc.file_size_human})</div>` : '<div class="text-xs mt-0.5" style="color:rgba(59,130,246,0.5)">Non uploadé</div>'}
                                    </div>
                                </div>
                                ${doc ? `
                                <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                    <span class="px-2 py-1 text-xs rounded-full ${sc[doc.status]||sc.pending}">${doc.status}</span>
                                    ${doc.status !== 'approved' ? `<button onclick="approveDoc(${doc.id})" class="px-3 py-1 text-xs rounded-lg font-medium" style="background:rgba(34,197,94,0.2);color:#4ade80;" title="Approuver">✓</button>` : ''}
                                    ${doc.status !== 'rejected' ? `<button onclick="rejectDoc(${doc.id})" class="px-3 py-1 text-xs rounded-lg font-medium" style="background:rgba(239,68,68,0.2);color:#f87171;" title="Rejeter">✗</button>` : ''}
                                    <a href="/visa-document/${doc.id}/download" class="p-1.5 rounded-lg hover:bg-amber-500/20" style="color:#f59e0b;" title="Télécharger">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    </a>
                                </div>` : ''}
                            </div>`;
                        }).join('')}
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-2">
                    <button onclick="editVisa(${v.id})" class="px-5 py-2.5 rounded-xl font-medium text-sm flex items-center gap-2"
                            style="background:rgba(245,158,11,0.15);color:#f59e0b;border:1px solid rgba(245,158,11,0.3);">
                        Modifier statut / notes
                    </button>
                    <button onclick="closeDetailsModal()" class="px-5 py-2.5 rounded-xl font-medium text-sm"
                            style="background:rgba(75,85,99,0.4);color:#d1d5db;">
                        Fermer
                    </button>
                </div>
            </div>`;
        } catch { document.getElementById('details-content').innerHTML = '<div class="text-center text-red-400 py-8">Erreur de chargement</div>'; }
    }
    function closeDetailsModal() { document.getElementById('details-modal').classList.add('hidden'); }

    // ── Edit ───────────────────────────────────────────────────────────
    async function editVisa(id) {
        try {
            const res  = await fetch(`/admin/api/visa-applications/${id}`);
            const data = await res.json();
            const v    = data.application;
            document.getElementById('edit-id').value       = v.id;
            document.getElementById('edit-status').value   = v.status;
            document.getElementById('edit-notes').value    = v.admin_notes || '';
            document.getElementById('edit-modal').classList.remove('hidden');
        } catch { showToast('Erreur de chargement', false); }
    }
    function closeEditModal() { document.getElementById('edit-modal').classList.add('hidden'); }

    async function saveEdit(e) {
        e.preventDefault();
        const id = document.getElementById('edit-id').value;
        try {
            const res = await fetch(`/admin/api/visa-applications/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({
                    status:      document.getElementById('edit-status').value,
                    admin_notes: document.getElementById('edit-notes').value,
                }),
            });
            const data = await res.json();
            if (data.success) { closeEditModal(); loadVisas(); loadStats(); showToast('Dossier mis à jour.'); }
            else showToast(data.message || 'Erreur', false);
        } catch { showToast('Erreur de connexion', false); }
    }

    // ── Generate Token ─────────────────────────────────────────────────
    async function generateToken(id) {
        try {
            const res  = await fetch(`/admin/api/visa-applications/${id}/generate-token`, {
                method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            });
            const data = await res.json();
            if (data.success) {
                showToast('Lien généré ! Copié dans le presse-papier.');
                if (data.access_url) navigator.clipboard.writeText(data.access_url).catch(() => {});
            } else showToast(data.message || 'Erreur', false);
        } catch { showToast('Erreur de connexion', false); }
    }

    // ── Approve / Reject doc ───────────────────────────────────────────
    async function approveDoc(docId) {
        try {
            const res  = await fetch(`/admin/api/visa-applications/documents/${docId}/approve`, {
                method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            });
            const data = await res.json();
            if (data.success) showToast('Document approuvé.');
            else showToast(data.message || 'Erreur', false);
        } catch { showToast('Erreur', false); }
    }

    async function rejectDoc(docId) {
        const reason = prompt('Raison du rejet (optionnel) :');
        if (reason === null) return;
        try {
            const res  = await fetch(`/admin/api/visa-applications/documents/${docId}/reject`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({ reason }),
            });
            const data = await res.json();
            if (data.success) showToast('Document rejeté.');
            else showToast(data.message || 'Erreur', false);
        } catch { showToast('Erreur', false); }
    }

    // ── Delete ─────────────────────────────────────────────────────────
    async function deleteVisa(id) {
        if (!confirm('Supprimer ce dossier visa et tous ses documents ?')) return;
        try {
            const res  = await fetch(`/admin/api/visa-applications/${id}`, {
                method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            });
            const data = await res.json();
            if (data.success) { loadVisas(); loadStats(); showToast('Dossier supprimé.'); }
            else showToast(data.message || 'Erreur', false);
        } catch { showToast('Erreur de connexion', false); }
    }

    // ── Init ───────────────────────────────────────────────────────────
    loadStats();
    loadVisas();
</script>
@endsection
