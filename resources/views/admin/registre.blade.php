<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Registre des voyageurs — Admin Travel Express</title>
<link rel="icon" type="image/png" href="/images/logo/logo_travel.png"/>
<link rel="shortcut icon" type="image/png" href="/images/logo/logo_travel.png"/>
<link rel="apple-touch-icon" href="/images/logo/logo_travel.png"/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=DM+Mono:wght@0,400;0,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
:root{
  --bg:#f4efe5;--bg-1:#ede6d8;--card:#ffffff;
  --ink:#1a1535;--ink-2:#2e2650;--ink-3:#6b6280;--ink-4:#a89ec0;
  --amber:#c8922a;--amber-l:#e8b84a;--amber-bg:rgba(200,146,42,.08);
  --green:#2d7a4f;--green-bg:rgba(45,122,79,.08);
  --red:#c0392b;--red-bg:rgba(192,57,43,.08);
  --line:rgba(26,21,53,.07);--line-2:rgba(26,21,53,.13);
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Jost',system-ui,sans-serif;color:var(--ink);background:var(--bg);min-height:100vh}

/* NAV */
.topnav{
  background:var(--ink);
  padding:0 28px;height:52px;
  display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:50;
}
.topnav-brand{display:flex;align-items:center;gap:12px}
.topnav-logo{width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.08);border:1px solid rgba(200,146,42,.3);display:grid;place-items:center;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:16px;color:var(--amber-l)}
.topnav-title{font-size:14px;font-weight:600;color:#fff;letter-spacing:.01em}
.topnav-title em{font-style:italic;font-weight:400;color:var(--amber-l)}
.topnav-back{font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.4);text-decoration:none;padding:6px 12px;border:1px solid rgba(255,255,255,.1);border-radius:6px;transition:all .2s}
.topnav-back:hover{color:#fff;border-color:rgba(255,255,255,.3)}

/* LAYOUT */
.wrap{max-width:1140px;margin:0 auto;padding:32px 28px 64px}

/* STATS */
.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px}
.stat-card{background:var(--card);border:1px solid var(--line-2);border-radius:12px;padding:18px 22px;display:flex;flex-direction:column;gap:4px}
.stat-label{font-family:'DM Mono',monospace;font-size:8.5px;letter-spacing:.26em;text-transform:uppercase;color:var(--ink-3)}
.stat-val{font-family:'Cormorant Garamond',serif;font-size:40px;font-weight:700;line-height:1;color:var(--ink)}
.stat-val.amber{color:var(--amber)}
.stat-val.green{color:var(--green)}

/* FORM */
.form-card{background:var(--card);border:1px solid var(--line-2);border-radius:14px;padding:24px 28px;margin-bottom:28px}
.form-title{font-family:'Cormorant Garamond',serif;font-size:22px;font-style:italic;font-weight:600;color:var(--ink);margin-bottom:18px}
.form-title em{color:var(--amber);font-style:normal}
.form-row{display:grid;grid-template-columns:1fr 1fr 1fr 1.4fr auto;gap:12px;align-items:end}
.field{display:flex;flex-direction:column;gap:5px}
.field label{font-family:'DM Mono',monospace;font-size:8.5px;letter-spacing:.26em;text-transform:uppercase;color:var(--ink-3)}
.field input{
  background:#fff;border:1.5px solid var(--line-2);border-radius:8px;
  padding:10px 14px;font-family:'Jost',sans-serif;font-size:14px;color:var(--ink);
  outline:none;transition:border-color .2s;
}
.field input:focus{border-color:var(--amber)}
.field input::placeholder{color:var(--ink-4)}
.btn-add{
  appearance:none;cursor:pointer;border:none;
  background:var(--ink);color:#fff;
  font-family:'Jost',sans-serif;font-size:13.5px;font-weight:600;
  padding:11px 22px;border-radius:8px;white-space:nowrap;
  box-shadow:0 6px 20px -6px rgba(26,21,53,.35);
  transition:background .2s;
}
.btn-add:hover{background:#241e45}
.btn-add:disabled{opacity:.5;cursor:not-allowed}
.form-msg{margin-top:10px;font-size:13px;font-style:italic;color:var(--green);min-height:18px}
.form-msg.error{color:var(--red)}

/* TABLE */
.table-card{background:var(--card);border:1px solid var(--line-2);border-radius:14px;overflow:hidden}
.table-header{padding:16px 24px;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between}
.table-header-title{font-family:'Cormorant Garamond',serif;font-size:20px;font-style:italic;font-weight:600;color:var(--ink)}
.table-header-sub{font-family:'DM Mono',monospace;font-size:8.5px;letter-spacing:.22em;text-transform:uppercase;color:var(--ink-3)}
.tbl{width:100%;border-collapse:collapse}
.tbl th{padding:10px 18px;text-align:left;font-family:'DM Mono',monospace;font-size:8px;letter-spacing:.24em;text-transform:uppercase;color:var(--ink-3);border-bottom:1px solid var(--line);background:var(--bg)}
.tbl td{padding:13px 18px;border-bottom:1px solid var(--line);font-size:13.5px;vertical-align:middle}
.tbl tr:last-child td{border-bottom:none}
.tbl tr:hover td{background:rgba(26,21,53,.015)}
.ref-badge{font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.12em;color:var(--ink-3);background:var(--bg);padding:2px 8px;border-radius:4px;border:1px solid var(--line-2)}
.dest-tag{display:inline-flex;align-items:center;gap:6px;font-size:13px}
.dest-tag .iata{font-family:'DM Mono',monospace;font-size:9px;letter-spacing:.1em;color:var(--amber);background:var(--amber-bg);padding:2px 6px;border-radius:4px}
.badge-signed{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:99px;font-family:'DM Mono',monospace;font-size:8px;letter-spacing:.18em;text-transform:uppercase;font-weight:500}
.badge-signed.yes{background:var(--green-bg);color:var(--green)}
.badge-signed.yes::before{content:"";width:5px;height:5px;border-radius:50%;background:var(--green)}
.badge-signed.no{background:var(--amber-bg);color:var(--amber)}
.badge-signed.no::before{content:"";width:5px;height:5px;border-radius:50%;background:var(--amber)}
.btn-del{appearance:none;cursor:pointer;border:1px solid var(--line-2);background:transparent;color:var(--ink-3);padding:5px 12px;border-radius:6px;font-size:12px;font-family:'Jost',sans-serif;transition:all .2s}
.btn-del:hover{background:var(--red-bg);color:var(--red);border-color:var(--red)}
.empty-row td{text-align:center;padding:40px;color:var(--ink-4);font-style:italic;font-family:'Cormorant Garamond',serif;font-size:18px}
.name-cell{font-weight:500}
.date-cell{font-family:'DM Mono',monospace;font-size:11px;color:var(--ink-3)}

/* LINK KIOSQUE */
.kiosk-link{display:inline-flex;align-items:center;gap:8px;margin-top:20px;font-family:'DM Mono',monospace;font-size:9.5px;letter-spacing:.2em;text-transform:uppercase;color:var(--ink-3);text-decoration:none;border:1px solid var(--line-2);padding:8px 16px;border-radius:99px;transition:all .2s}
.kiosk-link:hover{color:var(--amber);border-color:rgba(200,146,42,.3)}

@media(max-width:720px){
  .wrap{padding:20px 16px 40px}
  .stats{grid-template-columns:1fr 1fr}
  .form-row{grid-template-columns:1fr 1fr;grid-template-rows:auto auto auto}
  .btn-add{grid-column:1/-1}
}
</style>
</head>
<body>

<nav class="topnav">
  <div class="topnav-brand">
    <div class="topnav-logo">T</div>
    <span class="topnav-title">Travel <em>Express</em> — Registre</span>
  </div>
  <a href="/admin/dashboard" class="topnav-back">← Admin</a>
</nav>

<div class="wrap">

  <!-- Stats -->
  <div class="stats" id="stats">
    <div class="stat-card"><span class="stat-label">Total enregistrés</span><span class="stat-val" id="sTotal">—</span></div>
    <div class="stat-card"><span class="stat-label">Signatures obtenues</span><span class="stat-val green" id="sSigned">—</span></div>
    <div class="stat-card"><span class="stat-label">En attente</span><span class="stat-val amber" id="sPending">—</span></div>
  </div>

  <!-- Formulaire ajout -->
  <div class="form-card">
    <div class="form-title">Enregistrer un <em>voyageur</em></div>
    <div class="form-row">
      <div class="field">
        <label>Nom</label>
        <input type="text" id="f_nom" placeholder="Dupont" autocomplete="off"/>
      </div>
      <div class="field">
        <label>Prénom</label>
        <input type="text" id="f_prenom" placeholder="Jean" autocomplete="off"/>
      </div>
      <div class="field">
        <label>Départ</label>
        <input type="text" id="f_dep" placeholder="Bobo-Dioulasso, Paris…" autocomplete="off"/>
      </div>
      <div class="field">
        <label>Destination</label>
        <input type="text" id="f_dest" placeholder="Paris, Chine, Canada…" autocomplete="off"/>
      </div>
      <button class="btn-add" id="btnAdd" onclick="addVoyageur()">Enregistrer</button>
    </div>
    <div class="form-msg" id="formMsg"></div>
  </div>

  <!-- Tableau -->
  <div class="table-card">
    <div class="table-header">
      <div>
        <div class="table-header-title">Liste des voyageurs</div>
        <div class="table-header-sub">Mis à jour automatiquement</div>
      </div>
      <a href="/registre" target="_blank" class="kiosk-link">✦ Voir le kiosque →</a>
    </div>
    <table class="tbl">
      <thead>
        <tr>
          <th>Réf.</th>
          <th>Nom & Prénom</th>
          <th>Départ</th>
          <th>Destination</th>
          <th>Statut</th>
          <th>Date signature</th>
          <th>Enregistré le</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr class="empty-row"><td colspan="7">Chargement…</td></tr>
      </tbody>
    </table>
  </div>

</div>

<script>
const CSRF = document.querySelector('meta[name=csrf-token]').getAttribute('content');

function iata(dest) {
  return dest.replace(/[^a-zA-ZÀ-ÿ]/g,'').substring(0,3).toUpperCase();
}

async function load() {
  try {
    const res = await fetch('/admin/api/registre');
    const json = await res.json();
    if (!json.success) return;

    document.getElementById('sTotal').textContent   = String(json.stats.total).padStart(2,'0');
    document.getElementById('sSigned').textContent  = String(json.stats.signed).padStart(2,'0');
    document.getElementById('sPending').textContent = String(json.stats.pending).padStart(2,'0');

    const tbody = document.getElementById('tbody');
    if (!json.data.length) {
      tbody.innerHTML = '<tr class="empty-row"><td colspan="8">Aucun voyageur enregistré pour le moment.</td></tr>';
      return;
    }

    tbody.innerHTML = json.data.map(v => `
      <tr data-id="${v.id}">
        <td><span class="ref-badge">${v.ref}</span></td>
        <td class="name-cell">${esc(v.prenom)} ${esc(v.nom)}</td>
        <td>
          <span class="dest-tag">
            <span class="iata">${iata(v.depart||'')}</span>
            ${esc(v.depart||'—')}
          </span>
        </td>
        <td>
          <span class="dest-tag">
            <span class="iata">${iata(v.destination)}</span>
            ${esc(v.destination)}
          </span>
        </td>
        <td>
          <span class="badge-signed ${v.signed ? 'yes' : 'no'}">
            ${v.signed ? 'Signé' : 'En attente'}
          </span>
        </td>
        <td class="date-cell">${v.signed_at || '—'}</td>
        <td class="date-cell">${v.created_at}</td>
        <td><button class="btn-del" onclick="del(${v.id})">Supprimer</button></td>
      </tr>
    `).join('');
  } catch(e) { console.error(e); }
}

async function addVoyageur() {
  const nom    = document.getElementById('f_nom').value.trim();
  const prenom = document.getElementById('f_prenom').value.trim();
  const dep    = document.getElementById('f_dep').value.trim();
  const dest   = document.getElementById('f_dest').value.trim();
  const msg    = document.getElementById('formMsg');
  const btn    = document.getElementById('btnAdd');

  if (!nom || !prenom || !dest) { msg.textContent = 'Nom, prénom et destination sont requis.'; msg.className = 'form-msg error'; return; }

  btn.disabled = true;
  try {
    const res = await fetch('/admin/api/registre', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({ nom, prenom, depart: dep || null, destination: dest }),
    });
    const json = await res.json();
    if (json.success) {
      msg.textContent = `✓ ${prenom} ${nom} enregistré — ${json.data.ref}`;
      msg.className = 'form-msg';
      document.getElementById('f_nom').value = '';
      document.getElementById('f_prenom').value = '';
      document.getElementById('f_dep').value = '';
      document.getElementById('f_dest').value = '';
      load();
      setTimeout(() => { msg.textContent = ''; }, 4000);
    } else {
      const errs = json.errors ? Object.values(json.errors).flat().join(' ') : 'Erreur.';
      msg.textContent = errs; msg.className = 'form-msg error';
    }
  } catch(e) { msg.textContent = 'Erreur réseau.'; msg.className = 'form-msg error'; }
  btn.disabled = false;
}

async function del(id) {
  if (!confirm('Supprimer ce voyageur ?')) return;
  try {
    await fetch(`/admin/api/registre/${id}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF },
    });
    load();
  } catch(e) { alert('Erreur réseau.'); }
}

function esc(s) {
  return (s||'').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

// Entrer avec la touche Entrée dans les champs
document.addEventListener('keydown', e => {
  if (e.key === 'Enter' && ['f_nom','f_prenom','f_dep','f_dest'].includes(document.activeElement?.id)) addVoyageur();
});

load();
setInterval(load, 30000);
</script>
</body>
</html>
