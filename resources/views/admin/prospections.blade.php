@extends('admin.layout')

@section('content')
<div id="prospects-page">

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="elegant-card p-4 text-center">
            <div style="font-size:1.6rem;font-weight:700;font-family:var(--font-serif);background:var(--gold-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;" id="stat-total">—</div>
            <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);margin-top:.25rem;">Total</div>
        </div>
        <div class="elegant-card p-4 text-center">
            <div style="font-size:1.6rem;font-weight:700;font-family:var(--font-serif);color:var(--color-success);" id="stat-today">—</div>
            <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);margin-top:.25rem;">Aujourd'hui</div>
        </div>
        <div class="elegant-card p-4 text-center">
            <div style="font-size:1.6rem;font-weight:700;font-family:var(--font-serif);color:var(--gold-primary);" id="stat-week">—</div>
            <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);margin-top:.25rem;">Cette semaine</div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="elegant-card p-4 mb-6 flex flex-wrap gap-3 items-center">
        <div style="flex:1;min-width:160px;">
            <label style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);display:block;margin-bottom:.3rem;">Destination</label>
            <select id="filter-dest" onchange="loadProspects()" style="width:100%;background:var(--dark-200);border:1px solid rgba(201,168,76,.15);border-radius:.5rem;color:var(--dark-900);padding:.5rem .75rem;font-size:.85rem;outline:none;appearance:none;-webkit-appearance:none;">
                <option value="">Toutes</option>
                <option>Chine</option>
                <option>Espagne</option>
                <option>Allemagne</option>
                <option>France</option>
                <option>Canada</option>
                <option>Autre</option>
            </select>
        </div>
        <div style="flex:1;min-width:160px;">
            <label style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);display:block;margin-bottom:.3rem;">Filière</label>
            <select id="filter-fil" onchange="loadProspects()" style="width:100%;background:var(--dark-200);border:1px solid rgba(201,168,76,.15);border-radius:.5rem;color:var(--dark-900);padding:.5rem .75rem;font-size:.85rem;outline:none;appearance:none;-webkit-appearance:none;">
                <option value="">Toutes</option>
                <option>Informatique/Tech</option>
                <option>Commerce/Gestion</option>
                <option>Médecine/Santé</option>
                <option>Droit</option>
                <option>Ingénierie</option>
                <option>Lettres/Sciences humaines</option>
                <option>Autre</option>
            </select>
        </div>
        <div style="padding-top:1.1rem;display:flex;gap:.5rem;">
            <button onclick="loadProspects()" style="padding:.5rem 1rem;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.25);border-radius:.5rem;color:var(--gold-primary);font-size:.8rem;font-weight:600;cursor:pointer;">
                Actualiser
            </button>
            <button onclick="exportPdf()" id="btn-export" style="padding:.5rem 1rem;background:linear-gradient(135deg,#8B6914,#C9A84C,#F0D07A,#C9A84C,#8B6914);border:none;border-radius:.5rem;color:#0a0a0a;font-size:.8rem;font-weight:700;cursor:pointer;letter-spacing:.05em;box-shadow:0 2px 12px rgba(201,168,76,.25);">
                ⬇ Exporter PDF
            </button>
        </div>
    </div>

    <!-- Tableau -->
    <div class="elegant-card overflow-hidden">
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom:1px solid rgba(201,168,76,.12);">
                        <th style="padding:.75rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">Nom complet</th>
                        <th style="padding:.75rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">WhatsApp</th>
                        <th style="padding:.75rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">Email</th>
                        <th style="padding:.75rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">Destination</th>
                        <th style="padding:.75rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">Filière</th>
                        <th style="padding:.75rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">Date</th>
                        <th style="padding:.75rem 1rem;text-align:center;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--dark-600);">Action</th>
                    </tr>
                </thead>
                <tbody id="prospects-tbody">
                    <tr>
                        <td colspan="7" style="padding:3rem;text-align:center;color:var(--dark-600);">Chargement…</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div id="pagination" class="flex items-center justify-between px-4 py-3" style="border-top:1px solid rgba(201,168,76,.1);display:none!important;">
            <span id="pag-info" style="font-size:.8rem;color:var(--dark-600);"></span>
            <div style="display:flex;gap:.4rem;">
                <button id="pag-prev" onclick="changePage(-1)" style="padding:.35rem .7rem;background:var(--dark-200);border:1px solid var(--dark-300);border-radius:.4rem;color:var(--dark-700);font-size:.8rem;cursor:pointer;">&laquo; Préc.</button>
                <button id="pag-next" onclick="changePage(1)"  style="padding:.35rem .7rem;background:var(--dark-200);border:1px solid var(--dark-300);border-radius:.4rem;color:var(--dark-700);font-size:.8rem;cursor:pointer;">Suiv. &raquo;</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    #prospects-tbody tr { border-bottom: 1px solid rgba(201,168,76,.06); transition: background .15s; }
    #prospects-tbody tr:hover { background: rgba(201,168,76,.03); }
    #prospects-tbody td { padding: .85rem 1rem; font-size: .85rem; color: var(--dark-900); vertical-align: middle; }
    .wa-link { color: #25D366; text-decoration: none; font-weight: 600; }
    .wa-link:hover { text-decoration: underline; }
    .dest-badge { display:inline-block; background:rgba(201,168,76,.1); border:1px solid rgba(201,168,76,.2); color:var(--gold-primary); font-size:.75rem; padding:.15rem .55rem; border-radius:9999px; }
    .fil-badge  { display:inline-block; background:rgba(46,202,187,.08); border:1px solid rgba(46,202,187,.2); color:#2ECABB; font-size:.75rem; padding:.15rem .55rem; border-radius:9999px; }
    .btn-del    { padding:.3rem .6rem; background:rgba(231,76,60,.08); border:1px solid rgba(231,76,60,.25); border-radius:.4rem; color:#E74C3C; font-size:.75rem; cursor:pointer; transition:all .2s; }
    .btn-del:hover { background:rgba(231,76,60,.18); }
    .empty-state { padding:3rem; text-align:center; color:var(--dark-600); }
</style>
@endpush

<script>
    let currentPage = 1;
    let lastPage    = 1;

    async function loadProspects() {
        const dest = document.getElementById('filter-dest').value;
        const fil  = document.getElementById('filter-fil').value;
        const params = new URLSearchParams({ page: currentPage });
        if (dest) params.append('destination', dest);
        if (fil)  params.append('filiere', fil);

        try {
            const data = await apiCall(`/admin/api/prospects?${params}`, { noCache: true });
            if (!data.success) return;

            // Stats
            document.getElementById('stat-total').textContent = data.stats.total;
            document.getElementById('stat-today').textContent = data.stats.today;
            document.getElementById('stat-week').textContent  = data.stats.this_week;

            // Tableau
            const tbody = document.getElementById('prospects-tbody');
            const items = data.data.data;

            if (!items.length) {
                tbody.innerHTML = `<tr><td colspan="7" class="empty-state">Aucun prospect trouvé.</td></tr>`;
                document.getElementById('pagination').style.display = 'none';
                return;
            }

            tbody.innerHTML = items.map(p => `
                <tr>
                    <td style="font-weight:600;color:#fff;">${esc(p.nom_complet)}</td>
                    <td><a class="wa-link" href="${esc(p.whatsapp_link)}" target="_blank">📱 ${esc(p.whatsapp)}</a></td>
                    <td style="color:var(--dark-700);">${p.email ? esc(p.email) : '<span style="color:var(--dark-500)">—</span>'}</td>
                    <td><span class="dest-badge">${esc(p.destination)}</span></td>
                    <td><span class="fil-badge">${esc(p.filiere)}</span></td>
                    <td style="color:var(--dark-600);font-size:.8rem;">${esc(p.created_at)}</td>
                    <td style="text-align:center;">
                        <button class="btn-del" onclick="deleteProspect(${p.id}, this)">Supprimer</button>
                    </td>
                </tr>
            `).join('');

            // Pagination
            lastPage = data.data.last_page;
            const pag = document.getElementById('pagination');
            if (lastPage > 1) {
                pag.style.removeProperty('display');
                document.getElementById('pag-info').textContent = `Page ${currentPage} / ${lastPage} — ${data.data.total} prospects`;
                document.getElementById('pag-prev').disabled = currentPage <= 1;
                document.getElementById('pag-next').disabled = currentPage >= lastPage;
            } else {
                pag.style.display = 'none';
            }

        } catch (err) {
            showToast('Erreur de chargement des prospects.', 'error');
        }
    }

    function changePage(dir) {
        currentPage = Math.max(1, Math.min(lastPage, currentPage + dir));
        loadProspects();
    }

    async function deleteProspect(id, btn) {
        if (!confirm('Supprimer ce prospect définitivement ?')) return;
        btn.disabled = true;
        try {
            const data = await apiCall(`/admin/api/prospects/${id}`, { method: 'DELETE', noCache: true });
            if (data.success) {
                showToast('Prospect supprimé.');
                loadProspects();
            } else {
                showToast(data.message || 'Erreur.', 'error');
                btn.disabled = false;
            }
        } catch (e) {
            showToast('Erreur réseau.', 'error');
            btn.disabled = false;
        }
    }

    function exportPdf() {
        const dest = document.getElementById('filter-dest').value;
        const fil  = document.getElementById('filter-fil').value;
        const params = new URLSearchParams();
        if (dest) params.append('destination', dest);
        if (fil)  params.append('filiere', fil);

        const btn = document.getElementById('btn-export');
        btn.textContent = '⏳ Génération…';
        btn.disabled = true;

        const url = `/admin/api/prospects/export-pdf${params.toString() ? '?' + params : ''}`;
        const link = document.createElement('a');
        link.href = url;
        link.download = '';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        setTimeout(() => {
            btn.textContent = '⬇ Exporter PDF';
            btn.disabled = false;
        }, 2500);
    }

    function esc(str) {
        if (str === null || str === undefined) return '';
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    loadProspects();
</script>
@endsection
