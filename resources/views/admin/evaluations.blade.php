@extends('admin.layout')

@section('title', 'Gestion des évaluations')
@section('page-title', 'Évaluations')
@section('page-description', 'Gérez les évaluations des collaborateurs accompagnés')

@section('content')

<style>
    /* ── Gold & Black Theme ── */
    :root {
        --gold: #D4AF37;
        --gold-bright: #F0D060;
        --gold-dark: #B8960C;
        --ink: #080808;
        --card: #111109;
        --card2: #17160f;
        --border: rgba(212,175,55,0.18);
    }
    #eval-page .eval-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        transition: border-color .2s, box-shadow .2s;
    }
    #eval-page .eval-card:hover {
        border-color: rgba(212,175,55,0.4);
        box-shadow: 0 8px 32px rgba(0,0,0,.5);
    }
    #eval-page .stat-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px 22px;
    }
    #eval-page .gold-avatar {
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        box-shadow: 0 4px 16px rgba(212,175,55,.3);
    }
    #eval-page .pill {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    #eval-page .pill-country  { background: rgba(99,179,237,.12); color:#7ec8e3; }
    #eval-page .pill-level    { background: rgba(167,139,250,.12); color:#c4b5fd; }
    #eval-page .pill-field    { background: rgba(255,255,255,.07); color:rgba(255,255,255,.65); }
    #eval-page .pill-yes      { background: rgba(212,175,55,.12);  color:var(--gold-bright); }
    #eval-page .pill-no       { background: rgba(239,68,68,.1);    color:#fca5a5; }
    #eval-page .badge-verified{ background: rgba(212,175,55,.15);  color:var(--gold-bright); border:1px solid rgba(212,175,55,.3);}
    #eval-page .badge-pending { background: rgba(251,191,36,.1);   color:#fbbf24; border:1px solid rgba(251,191,36,.25);}
    #eval-page .badge-signed  { background: rgba(212,175,55,.08);  color:rgba(212,175,55,.75); font-size:10px;}
    #eval-page .btn-detail {
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        color: var(--ink);
        font-weight: 700;
        border-radius: 10px;
        padding: 8px 16px;
        font-size: 13px;
        transition: opacity .15s;
    }
    #eval-page .btn-detail:hover { opacity:.88; }
    #eval-page .btn-delete {
        background: rgba(239,68,68,.12);
        color:#f87171;
        border: 1px solid rgba(239,68,68,.25);
        font-weight: 600;
        border-radius: 10px;
        padding: 8px 16px;
        font-size: 13px;
        transition: background .15s;
    }
    #eval-page .btn-delete:hover { background: rgba(239,68,68,.22); }
    #eval-page .source-tiktok {
        display:inline-flex; align-items:center; gap:5px;
        background: rgba(212,175,55,.1);
        border: 1px solid rgba(212,175,55,.25);
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 11px;
        font-weight: 700;
        color: var(--gold-bright);
    }

    /* ── Detail Modal Dark ── */
    #detail-modal .dm-card {
        background: #0e0d0b;
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 20px;
    }
    #detail-modal .dm-header {
        background: linear-gradient(135deg, #0a0a08, #1a1708);
        border-bottom: 1px solid rgba(212,175,55,.2);
        border-radius: 20px 20px 0 0;
        padding: 24px;
    }
    #detail-modal .dm-section-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(212,175,55,.7);
        margin-bottom: 10px;
    }
    #detail-modal .dm-row {
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 10px;
        padding: 12px 14px;
    }
    #detail-modal .dm-label { font-size:10px; color:rgba(255,255,255,.4); margin-bottom:2px; }
    #detail-modal .dm-value { font-size:13px; color:rgba(255,255,255,.85); font-weight:500; }
    #detail-modal .dm-story {
        background: rgba(212,175,55,.04);
        border: 1px solid rgba(212,175,55,.15);
        border-left: 3px solid var(--gold);
        border-radius: 0 10px 10px 0;
        padding: 14px 16px;
        font-size: 13px;
        color: rgba(255,255,255,.75);
        line-height: 1.6;
    }
    #detail-modal .dm-rating-box {
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(212,175,55,.12);
        border-radius: 10px;
        padding: 10px;
        text-align: center;
    }
    #detail-modal .dm-score {
        font-size:22px;
        font-weight:800;
        color: var(--gold-bright);
    }
    #detail-modal .btn-pdf {
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        color: var(--ink);
        font-weight: 700;
        border-radius: 10px;
        padding: 12px;
        width: 100%;
        font-size: 14px;
        transition: opacity .15s;
    }
    #detail-modal .btn-del-full {
        background: rgba(239,68,68,.12);
        color: #f87171;
        border: 1px solid rgba(239,68,68,.3);
        font-weight: 600;
        border-radius: 10px;
        padding: 12px;
        width: 100%;
        font-size: 14px;
    }

    /* ── Confirm Modal Dark ── */
    #confirm-modal .cm-card {
        background: #0e0d0b;
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 20px;
    }

    /* ── Toast Dark ── */
    #toast .toast-inner {
        background: #111109;
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 14px;
        box-shadow: 0 20px 60px rgba(0,0,0,.7);
    }

    /* ── Loading/Empty ── */
    #eval-page .state-box {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
    }
</style>

<!-- Detail Modal -->
<div id="detail-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeDetailModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 overflow-y-auto">
        <div class="dm-card w-full max-w-2xl my-8 max-h-[90vh] overflow-y-auto">
            <div id="detail-content"></div>
        </div>
    </div>
</div>

<!-- Confirm Modal -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeConfirmModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="cm-card w-full max-w-md">
            <div class="pt-8 pb-5 text-center px-6">
                <div id="confirm-icon" class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4"></div>
                <h3 id="confirm-title" class="text-xl font-bold mb-2" style="color:#F0D060;"></h3>
                <p id="confirm-message" class="text-sm" style="color:rgba(255,255,255,.55);"></p>
            </div>
            <div class="flex gap-3 p-5" style="border-top:1px solid rgba(212,175,55,.15);">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-3 font-semibold rounded-xl text-sm transition-colors" style="background:rgba(255,255,255,.05);color:rgba(255,255,255,.6);border:1px solid rgba(255,255,255,.1);">
                    Annuler
                </button>
                <button id="confirm-button" onclick="executeConfirmAction()" class="flex-1 px-4 py-3 text-white font-semibold rounded-xl transition-colors text-sm">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300">
    <div class="toast-inner p-4 flex items-center gap-3 min-w-[300px]">
        <div id="toast-icon" class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"></div>
        <div class="flex-1">
            <p id="toast-title" class="font-semibold text-sm" style="color:rgba(255,255,255,.9);"></p>
            <p id="toast-message" class="text-xs mt-0.5" style="color:rgba(255,255,255,.5);"></p>
        </div>
        <button onclick="hideToast()" style="color:rgba(255,255,255,.35);" class="hover:text-white/70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<div id="eval-page">
    <!-- Stats -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="stat-card flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(212,175,55,.12);border:1px solid rgba(212,175,55,.25);">
                <svg class="w-6 h-6" style="color:#D4AF37;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-black" id="stat-total" style="color:#F0D060;">0</p>
                <p class="text-xs font-medium" style="color:rgba(255,255,255,.4);">Total</p>
            </div>
        </div>
        <div class="stat-card flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(212,175,55,.12);border:1px solid rgba(212,175,55,.25);">
                <svg class="w-6 h-6" style="color:#D4AF37;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-black" id="stat-rating" style="color:#F0D060;">0</p>
                <p class="text-xs font-medium" style="color:rgba(255,255,255,.4);">Note moyenne</p>
            </div>
        </div>
    </div>

    <!-- Loading -->
    <div id="loading" class="state-box text-center py-12">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2" style="border-color:#D4AF37;"></div>
        <p class="mt-3 text-sm" style="color:rgba(255,255,255,.4);">Chargement…</p>
    </div>

    <!-- Error -->
    <div id="error" class="hidden px-4 py-3 rounded-xl text-sm mb-4" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#fca5a5;">
        <p id="error-message"></p>
    </div>

    <!-- List -->
    <div id="evaluations-list" class="hidden space-y-4"></div>

    <!-- Empty -->
    <div id="empty-state" class="hidden state-box text-center py-14">
        <div class="w-14 h-14 rounded-2xl mx-auto flex items-center justify-center mb-4" style="background:rgba(212,175,55,.08);border:1px solid rgba(212,175,55,.15);">
            <svg class="w-7 h-7" style="color:rgba(212,175,55,.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="font-semibold mb-1" style="color:rgba(255,255,255,.6);">Aucune évaluation</p>
        <p class="text-xs" id="empty-message" style="color:rgba(255,255,255,.3);"></p>
    </div>
</div>

<script>
    const authToken = window.authToken || localStorage.getItem('auth_token');
    let pendingAction = null;
    let pendingId = null;
    let currentEvaluationData = null;

    async function loadStats() {
        try {
            const r = await fetch('/api/admin/evaluations/stats', {
                headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
            });
            if (r.ok) {
                const { data } = await r.json();
                document.getElementById('stat-total').textContent = data.total || 0;
                document.getElementById('stat-rating').textContent = data.average_rating || '0';
            }
        } catch(e) {}
    }

    async function loadEvaluations() {
        const loading = document.getElementById('loading');
        const error   = document.getElementById('error');
        const list    = document.getElementById('evaluations-list');
        const empty   = document.getElementById('empty-state');
        loading.classList.remove('hidden');
        [error, list, empty].forEach(el => el.classList.add('hidden'));
        try {
            const r = await fetch('/api/admin/evaluations', {
                headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
            });
            if (!r.ok) throw new Error('Erreur ' + r.status);
            const result = await r.json();
            const evaluations = result.data?.data || result.data || [];
            loading.classList.add('hidden');
            if (!evaluations.length) {
                empty.classList.remove('hidden');
                document.getElementById('empty-message').textContent = 'Aucune évaluation trouvée';
            } else {
                list.classList.remove('hidden');
                renderEvaluations(evaluations);
            }
        } catch(err) {
            loading.classList.add('hidden');
            error.classList.remove('hidden');
            document.getElementById('error-message').textContent = err.message;
        }
    }

    function renderEvaluations(evaluations) {
        const list = document.getElementById('evaluations-list');
        list.innerHTML = evaluations.map(e => {
            const fn = e.first_name || '', ln = e.last_name || '';
            const initials = (fn.charAt(0)||'?') + (ln.charAt(0)||'?');
            const stars = [1,2,3,4,5].map(i =>
                `<svg class="w-3.5 h-3.5" style="color:${i<=e.rating?'#D4AF37':'rgba(255,255,255,0.15)'}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>`
            ).join('');

            const tiktokBadge = (e.discovery_source === 'tiktok' && e.tiktok_channel)
                ? `<span class="source-tiktok">${getTiktokChannelLabel(e.tiktok_channel)}</span>`
                : '';

            return `
            <div class="eval-card p-5">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <!-- Header -->
                        <div class="flex items-start gap-3 mb-4">
                            <div class="gold-avatar w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="font-black text-lg" style="color:#080808;">${initials.toUpperCase()}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-base" style="color:rgba(255,255,255,.9);">${fn} ${ln}</h3>
                                <p class="text-sm" style="color:rgba(255,255,255,.5);">${e.university || '-'}</p>
                                <p class="text-xs" style="color:rgba(255,255,255,.3);">${e.email || '-'}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1.5">
                                <div class="flex gap-0.5">${stars}</div>
                                ${e.signature ? `<span class="badge-signed pill flex items-center gap-1"><svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>Signé</span>` : ''}
                            </div>
                        </div>

                        <!-- Pills -->
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            <span class="pill pill-country">${e.country_of_study}</span>
                            <span class="pill pill-level">${getStudyLevelLabel(e.study_level)}</span>
                            <span class="pill pill-field">${e.field_of_study}</span>
                            <span class="pill ${e.would_recommend ? 'pill-yes' : 'pill-no'}">${e.would_recommend ? '👍 Recommande' : '👎 Ne recommande pas'}</span>
                        </div>

                        <!-- Source -->
                        <div class="flex items-center flex-wrap gap-2 mb-3">
                            <span class="text-xs" style="color:rgba(255,255,255,.35);">Source :</span>
                            <span class="text-xs font-medium" style="color:rgba(255,255,255,.6);">${getDiscoverySourceLabel(e.discovery_source)}</span>
                            ${tiktokBadge}
                            ${e.discovery_source_detail ? `<span class="text-xs" style="color:rgba(255,255,255,.35);">(${e.discovery_source_detail})</span>` : ''}
                        </div>

                        <!-- Excerpt -->
                        <p class="text-sm mb-3 line-clamp-2" style="color:rgba(255,255,255,.45);">${e.project_story}</p>

                        <!-- Status -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="pill ${e.is_verified ? 'badge-verified' : 'badge-pending'}">
                                ${e.is_verified ? '✓ Vérifié' : '⏳ En attente'}
                            </span>
                            ${e.is_featured ? '<span class="pill" style="background:rgba(251,191,36,.12);color:#fbbf24;border:1px solid rgba(251,191,36,.25);">⭐ Mis en avant</span>' : ''}
                            <span class="text-xs" style="color:rgba(255,255,255,.25);">${formatDate(e.created_at)}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex lg:flex-col gap-2 pt-3 lg:pt-0 border-t lg:border-t-0" style="border-color:rgba(212,175,55,.1);">
                        <button onclick="viewDetail(${e.id})" class="btn-detail flex-1 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Détails
                        </button>
                        <button onclick="showConfirmModal('delete', ${e.id})" class="btn-delete flex-1 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    async function viewDetail(id) {
        try {
            const r = await fetch(`/api/admin/evaluations/${id}`, {
                headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
            });
            if (!r.ok) throw new Error('Erreur');
            const { data: e } = await r.json();
            currentEvaluationData = e;

            const stars = n => [1,2,3,4,5].map(i =>
                `<svg class="w-4 h-4" style="color:${i<=n?'#D4AF37':'rgba(255,255,255,0.12)'}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>`
            ).join('');

            const tiktokRow = (e.discovery_source === 'tiktok' && e.tiktok_channel)
                ? `<div class="dm-row mt-2 flex items-center gap-2">
                    <span class="dm-label mb-0">Chaîne TikTok</span>
                    <span class="source-tiktok ml-auto">${getTiktokChannelLabel(e.tiktok_channel)}</span>
                   </div>`
                : '';

            document.getElementById('detail-content').innerHTML = `
                <div class="dm-header">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="gold-avatar w-16 h-16 rounded-2xl flex items-center justify-center">
                                <span class="text-2xl font-black" style="color:#080808;">${e.first_name.charAt(0)}${e.last_name.charAt(0)}</span>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold" style="color:#F0D060;">${e.first_name} ${e.last_name}</h2>
                                <p class="text-sm" style="color:rgba(255,255,255,.5);">${e.email}</p>
                                ${e.phone ? `<p class="text-xs" style="color:rgba(255,255,255,.4);">${e.phone}</p>` : ''}
                            </div>
                        </div>
                        <button onclick="closeDetailModal()" style="color:rgba(255,255,255,.4);" class="hover:text-white/80 p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <!-- Académique -->
                    <div>
                        <p class="dm-section-title">Parcours académique</p>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="dm-row"><div class="dm-label">Université</div><div class="dm-value">${e.university}</div></div>
                            <div class="dm-row"><div class="dm-label">Pays</div><div class="dm-value">${e.country_of_study}</div></div>
                            <div class="dm-row"><div class="dm-label">Niveau</div><div class="dm-value">${getStudyLevelLabel(e.study_level)}</div></div>
                            <div class="dm-row"><div class="dm-label">Filière</div><div class="dm-value">${e.field_of_study}</div></div>
                            ${e.start_year ? `<div class="dm-row"><div class="dm-label">Début</div><div class="dm-value">${e.start_year}</div></div>` : ''}
                            <div class="dm-row"><div class="dm-label">Service</div><div class="dm-value">${getServiceLabel(e.service_used)}</div></div>
                        </div>
                    </div>

                    <!-- Histoire -->
                    <div>
                        <p class="dm-section-title">Comment a-t-il réalisé son projet ?</p>
                        <div class="dm-story">${e.project_story}</div>
                    </div>

                    <!-- Source -->
                    <div>
                        <p class="dm-section-title">Source de découverte</p>
                        <div class="dm-row flex items-center justify-between">
                            <div>
                                <div class="dm-label">Canal</div>
                                <div class="dm-value">${getDiscoverySourceLabel(e.discovery_source)}${e.discovery_source_detail ? ` (${e.discovery_source_detail})` : ''}</div>
                            </div>
                        </div>
                        ${tiktokRow}
                        ${(e.discovery_source === 'ambassadeur_la_bobolaise' || e.discovery_source === 'ambassadeur_ley_ley' || e.discovery_source === 'ambassadeur_autre') && e.ambassador_direct_contact !== null ? `
                            <div class="dm-row mt-2">
                                <div class="dm-label">Mise en relation directe</div>
                                <div class="dm-value">${e.ambassador_direct_contact ? '✅ Oui' : '❌ Non'}</div>
                            </div>` : ''}
                        ${e.conversation_screenshots && e.conversation_screenshots.length > 0 ? `
                            <div class="mt-3">
                                <p class="text-xs font-semibold mb-2" style="color:rgba(212,175,55,.6);">Captures d'écran (${e.conversation_screenshots.length})</p>
                                <div class="grid grid-cols-3 gap-2">
                                    ${e.conversation_screenshots.map(s => `
                                        <a href="/storage/${s}" target="_blank" class="aspect-square rounded-lg overflow-hidden border" style="border-color:rgba(212,175,55,.2);">
                                            <img src="/storage/${s}" class="w-full h-full object-cover" alt="">
                                        </a>`).join('')}
                                </div>
                            </div>` : ''}
                    </div>

                    <!-- Notes -->
                    <div>
                        <p class="dm-section-title">Évaluations détaillées</p>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2">
                            <div class="dm-rating-box col-span-1">
                                <div class="text-xs mb-1" style="color:rgba(255,255,255,.4);">Globale</div>
                                <div class="flex justify-center gap-0.5 mb-1">${stars(e.rating)}</div>
                                <div class="dm-score">${e.rating}/5</div>
                            </div>
                            ${e.rating_accompagnement ? `<div class="dm-rating-box"><div class="text-xs mb-1" style="color:rgba(255,255,255,.4);">Accompagt.</div><div class="dm-score">${e.rating_accompagnement}/5</div></div>` : ''}
                            ${e.rating_communication ? `<div class="dm-rating-box"><div class="text-xs mb-1" style="color:rgba(255,255,255,.4);">Commun.</div><div class="dm-score">${e.rating_communication}/5</div></div>` : ''}
                            ${e.rating_delais ? `<div class="dm-rating-box"><div class="text-xs mb-1" style="color:rgba(255,255,255,.4);">Délais</div><div class="dm-score">${e.rating_delais}/5</div></div>` : ''}
                            ${e.rating_rapport_qualite_prix ? `<div class="dm-rating-box"><div class="text-xs mb-1" style="color:rgba(255,255,255,.4);">Qualité/Prix</div><div class="dm-score">${e.rating_rapport_qualite_prix}/5</div></div>` : ''}
                        </div>
                    </div>

                    <!-- Signature -->
                    ${e.signature ? `
                    <div>
                        <p class="dm-section-title">Signature</p>
                        <div class="rounded-xl p-4" style="background:rgba(255,255,255,.03);border:1px solid rgba(212,175,55,.15);">
                            <div class="rounded-lg p-4 min-h-[100px] flex items-center justify-center" style="background:#fff;">
                                <img src="${e.signature}" alt="Signature" class="max-h-24 w-auto">
                            </div>
                            <p class="text-center text-xs mt-2" style="color:rgba(255,255,255,.4);">${e.first_name} ${e.last_name}${e.signed_at ? ' · ' + formatDate(e.signed_at) : ''}</p>
                        </div>
                    </div>` : ''}

                    <!-- Status row -->
                    <div class="flex flex-wrap gap-2 py-3" style="border-top:1px solid rgba(212,175,55,.1);border-bottom:1px solid rgba(212,175,55,.1);">
                        <span class="pill ${e.is_verified ? 'badge-verified' : 'badge-pending'}">${e.is_verified ? '✓ Vérifié' : '⏳ En attente'}</span>
                        <span class="pill ${e.would_recommend ? 'pill-yes' : 'pill-no'}">${e.would_recommend ? '👍 Recommande' : '👎 Ne recommande pas'}</span>
                        ${e.is_featured ? '<span class="pill" style="background:rgba(251,191,36,.12);color:#fbbf24;">⭐ Mis en avant</span>' : ''}
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        <button onclick="exportPDF(${e.id})" class="btn-pdf flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Exporter en PDF
                        </button>
                        <button onclick="showConfirmModal('delete', ${e.id}); closeDetailModal();" class="btn-del-full flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer cette évaluation
                        </button>
                    </div>
                </div>`;

            document.getElementById('detail-modal').classList.remove('hidden');
        } catch(err) {
            showToast('error', 'Erreur', 'Impossible de charger les détails');
        }
    }

    function closeDetailModal() { document.getElementById('detail-modal').classList.add('hidden'); }

    function showConfirmModal(type, id) {
        pendingAction = type; pendingId = id;
        const modal   = document.getElementById('confirm-modal');
        const iconEl  = document.getElementById('confirm-icon');
        const titleEl = document.getElementById('confirm-title');
        const msgEl   = document.getElementById('confirm-message');
        const btnEl   = document.getElementById('confirm-button');

        if (type === 'delete') {
            iconEl.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4';
            iconEl.style.cssText = 'background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.3);';
            iconEl.innerHTML = '<svg class="w-8 h-8" style="color:#f87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>';
            titleEl.textContent = 'Supprimer cette évaluation ?';
            msgEl.textContent = 'Cette action est irréversible.';
            btnEl.className = 'flex-1 px-4 py-3 font-semibold rounded-xl text-sm';
            btnEl.style.cssText = 'background:rgba(239,68,68,.2);color:#f87171;border:1px solid rgba(239,68,68,.3);';
            btnEl.textContent = 'Supprimer';
        }
        modal.classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
        pendingAction = null; pendingId = null;
    }

    async function executeConfirmAction() {
        const action = pendingAction, id = pendingId;
        closeConfirmModal();
        try {
            let endpoint = '', method = 'POST';
            if (action === 'delete') { endpoint = `/api/admin/evaluations/${id}`; method = 'DELETE'; }
            const headers = { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json', 'Content-Type': 'application/json' };
            let fetchMethod = method;
            if (method === 'DELETE') { fetchMethod = 'POST'; headers['X-HTTP-Method-Override'] = 'DELETE'; }
            const r = await fetch(endpoint, { method: fetchMethod, headers });
            if (!r.ok) throw new Error('Erreur');
            showToast('success', 'Évaluation supprimée', 'L\'évaluation a été supprimée.');
            loadEvaluations(); loadStats();
        } catch(e) {
            showToast('error', 'Erreur', e.message);
        }
    }

    function showToast(type, title, message) {
        const toast = document.getElementById('toast');
        const iconEl = document.getElementById('toast-icon');
        document.getElementById('toast-title').textContent = title;
        document.getElementById('toast-message').textContent = message;
        if (type === 'success') {
            iconEl.className = 'w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0';
            iconEl.style.cssText = 'background:rgba(212,175,55,.15);border:1px solid rgba(212,175,55,.3);';
            iconEl.innerHTML = '<svg class="w-5 h-5" style="color:#D4AF37;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        } else {
            iconEl.className = 'w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0';
            iconEl.style.cssText = 'background:rgba(239,68,68,.15);';
            iconEl.innerHTML = '<svg class="w-5 h-5" style="color:#f87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
        }
        toast.classList.remove('translate-x-full');
        setTimeout(() => hideToast(), 4000);
    }

    function hideToast() { document.getElementById('toast').classList.add('translate-x-full'); }

    // Helpers
    function getStudyLevelLabel(l) {
        return {'licence_1':'Licence 1','licence_2':'Licence 2','licence_3':'Licence 3','master_1':'Master 1','master_2':'Master 2','doctorat':'Doctorat','formation_professionnelle':'Formation pro','autre':'Autre'}[l] || l;
    }
    function getDiscoverySourceLabel(s) {
        return {'siao':'🏢 SIAO','ambassadeur_la_bobolaise':'👩‍💼 La Bobolaise','ambassadeur_ley_ley':'👨‍💼 Ley Ley','ambassadeur_autre':'🤝 Autre ambassadeur','facebook':'📘 Facebook','tiktok':'🎵 TikTok','instagram':'📸 Instagram','youtube':'▶️ YouTube','bouche_a_oreille':'🗣️ Bouche à oreille','site_web':'🌐 Site web','evenement':'📅 Événement','autre':'❓ Autre'}[s] || s;
    }
    function getTiktokChannelLabel(c) {
        return {'travel_express':'✈️ Travel Express','leyley':'👨‍💼 Leyley','la_bobolaise':'👩‍💼 La Bobolaise'}[c] || c;
    }
    function getServiceLabel(s) {
        return {'etudes':'Études','business':'Business','tourisme':'Tourisme','visa_seul':'Visa seul','autre':'Autre'}[s] || s;
    }
    function formatDate(d) {
        if (!d) return '';
        return new Date(d).toLocaleDateString('fr-FR', {day:'numeric',month:'short',year:'numeric'});
    }

    async function exportPDF(id) {
        showToast('success', 'Génération PDF', 'Création du document en cours…');
        try {
            const r = await fetch(`/api/admin/evaluations/${id}/pdf`, {
                headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
            });
            if (!r.ok) { const err = await r.json(); throw new Error(err.message || 'Erreur'); }
            const result = await r.json();
            if (result.success && result.data.pdf) {
                const bytes = atob(result.data.pdf);
                const arr = new Uint8Array(bytes.length);
                for (let i = 0; i < bytes.length; i++) arr[i] = bytes.charCodeAt(i);
                const url = URL.createObjectURL(new Blob([arr], {type:'application/pdf'}));
                const a = Object.assign(document.createElement('a'), {href:url, download: result.data.filename || `evaluation_${id}.pdf`});
                document.body.appendChild(a); a.click();
                URL.revokeObjectURL(url); document.body.removeChild(a);
                showToast('success', 'PDF téléchargé', result.data.filename);
            } else throw new Error('Données PDF invalides');
        } catch(e) {
            showToast('error', 'Erreur', e.message);
        }
    }

    loadStats();
    loadEvaluations();
</script>
@endsection
