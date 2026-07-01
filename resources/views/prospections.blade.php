<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prospection Terrain — Travel Express</title>
    <link rel="icon" type="image/png" href="/images/logo/logo_travel.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold:       #C9A84C;
            --gold-light: #F0D07A;
            --gold-deep:  #8B6914;
            --gold-grad:  linear-gradient(135deg,#8B6914 0%,#C9A84C 40%,#F0D07A 60%,#C9A84C 80%,#8B6914 100%);
            --bg:         #080808;
            --bg-card:    #141414;
            --bg-input:   #1C1C1C;
            --border:     rgba(201,168,76,.18);
            --text:       #D4D4D4;
            --text-muted: #6B6B6B;
            --danger:     #E74C3C;
            --success:    #2ECABB;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Lato', sans-serif;
            min-height: 100vh;
            padding-bottom: 2rem;
        }
        h1,h2,h3 { font-family: 'Cormorant Garamond', serif; }

        /* ── Header ── */
        .header {
            background: #0D0D0D;
            border-bottom: 1px solid var(--border);
            padding: 0.9rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .header-logo {
            width: 2.5rem; height: 2.5rem;
            background: var(--gold-grad);
            border-radius: 0.6rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .header-logo svg { width:1.3rem; height:1.3rem; color:#0a0a0a; }
        .header-title { font-size: 1.1rem; font-weight: 700; color: #fff; line-height:1.1; }
        .header-sub { font-size: 0.7rem; color: var(--gold); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700; }

        /* ── Container ── */
        .container { max-width: 520px; margin: 0 auto; padding: 1.25rem; }

        /* ── Carte Dernier Ajout ── */
        .last-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 0.875rem;
            padding: 1.1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: none;
        }
        .last-card.visible { display: block; }
        .last-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.9rem;
        }
        .last-card-title {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--gold);
        }
        .badge-new {
            background: rgba(201,168,76,.12);
            color: var(--gold);
            font-size: 0.6rem;
            font-weight: 700;
            padding: 0.2rem 0.55rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .last-card-name {
            font-size: 1.2rem;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .last-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.9rem;
        }
        .meta-pill {
            background: rgba(201,168,76,.08);
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
        }
        .meta-pill span { color: var(--text); font-weight: 600; }
        .last-card-actions { display: flex; gap: 0.6rem; }
        .btn-edit {
            flex: 1;
            padding: 0.55rem;
            background: rgba(201,168,76,.08);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            color: var(--gold);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            text-align: center;
        }
        .btn-edit:hover { background: rgba(201,168,76,.16); }
        .btn-wa {
            flex: 1;
            padding: 0.55rem;
            background: rgba(37,211,102,.08);
            border: 1px solid rgba(37,211,102,.25);
            border-radius: 0.5rem;
            color: #25D366;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        .btn-wa:hover { background: rgba(37,211,102,.16); }

        /* ── Séparateur ── */
        .section-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.1rem;
        }
        .section-label::before, .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── Formulaire ── */
        .form-group { margin-bottom: 1rem; }
        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 0.4rem;
        }
        label .req { color: var(--gold); }
        input[type=text], input[type=tel], input[type=email], select {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: 0.5rem;
            color: var(--text);
            font-size: 0.95rem;
            font-family: 'Lato', sans-serif;
            padding: 0.7rem 0.9rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            -webkit-appearance: none;
        }
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B6B6B'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
        input:focus, select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,.1);
        }
        input::placeholder { color: var(--text-muted); }
        .input-free {
            margin-top: 0.4rem;
            display: none;
        }
        .input-free.show { display: block; }
        .field-error {
            font-size: 0.72rem;
            color: var(--danger);
            margin-top: 0.25rem;
            display: none;
        }

        /* ── Bouton Valider ── */
        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background: var(--gold-grad);
            border: none;
            border-radius: 0.625rem;
            color: #0a0a0a;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.12em;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
            margin-top: 0.5rem;
            box-shadow: 0 4px 20px rgba(201,168,76,.25);
        }
        .btn-submit:hover { opacity: .92; transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: .5; cursor: not-allowed; }

        /* ── Toast ── */
        .toast {
            position: fixed;
            top: 1rem; right: 1rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-left: 3px solid var(--success);
            border-radius: 0.6rem;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text);
            z-index: 9999;
            box-shadow: 0 8px 32px rgba(0,0,0,.6);
            transform: translateX(120%);
            transition: transform .35s cubic-bezier(.34,1.56,.64,1);
            max-width: 280px;
        }
        .toast.show { transform: translateX(0); }
        .toast.error { border-left-color: var(--danger); }

        /* ── Modal Edit ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.75);
            backdrop-filter: blur(4px);
            z-index: 100;
            align-items: flex-end;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: #141414;
            border: 1px solid var(--border);
            border-radius: 1rem 1rem 0 0;
            width: 100%;
            max-width: 520px;
            padding: 1.5rem 1.25rem 2rem;
            animation: slideUp .3s ease;
        }
        @keyframes slideUp { from { transform: translateY(100%); } to { transform: translateY(0); } }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.25rem;
        }
        .modal-title { font-size: 1.1rem; font-weight: 600; color: #fff; font-family: 'Cormorant Garamond', serif; }
        .btn-close {
            background: rgba(201,168,76,.08);
            border: 1px solid var(--border);
            border-radius: 0.4rem;
            color: var(--text-muted);
            padding: 0.3rem 0.6rem;
            cursor: pointer;
            font-size: 1.1rem;
            line-height: 1;
        }
        .btn-close:hover { color: var(--gold); }
    </style>
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="header-logo">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <div>
        <div class="header-title">Travel Express</div>
        <div class="header-sub">Prospection Terrain</div>
    </div>
</header>

<div class="container">

    <!-- Carte dernier ajout -->
    <div id="lastCard" class="last-card">
        <div class="last-card-header">
            <span class="last-card-title">Dernier prospect ajouté</span>
            <span class="badge-new">Nouveau</span>
        </div>
        <div id="lastName" class="last-card-name"></div>
        <div class="last-card-meta">
            <div class="meta-pill">📱 <span id="lastWa"></span></div>
            <div class="meta-pill" id="lastEmailPill" style="display:none">✉️ <span id="lastEmail"></span></div>
            <div class="meta-pill">✈️ <span id="lastDest"></span></div>
            <div class="meta-pill">📚 <span id="lastFil"></span></div>
        </div>
        <div class="last-card-actions">
            <button class="btn-edit" onclick="openEditModal()">✏️ Modifier</button>
            <a id="lastWaLink" href="#" class="btn-wa" target="_blank">💬 WhatsApp</a>
        </div>
    </div>

    <!-- Formulaire nouveau prospect -->
    <div class="section-label">Nouveau prospect</div>

    <form id="prospectForm" novalidate>
        <div class="form-group">
            <label>Nom complet <span class="req">*</span></label>
            <input type="text" id="nom_complet" placeholder="Jean Dupont" autocomplete="off">
            <div class="field-error" id="err_nom">Le nom complet est requis.</div>
        </div>

        <div class="form-group">
            <label>Numéro WhatsApp <span class="req">*</span></label>
            <input type="tel" id="whatsapp" value="+226 " placeholder="+226 XX XX XX XX" autocomplete="off">
            <div class="field-error" id="err_wa">Le numéro WhatsApp est requis.</div>
        </div>

        <div class="form-group">
            <label>Adresse email <span style="color:var(--text-muted);font-weight:400;">(optionnel)</span></label>
            <input type="email" id="email" placeholder="exemple@mail.com" autocomplete="off">
            <div class="field-error" id="err_email">L'adresse email n'est pas valide.</div>
        </div>

        <div class="form-group">
            <label>Destination désirée <span class="req">*</span></label>
            <select id="destination" onchange="toggleFree('destination')">
                <option value="">— Choisir —</option>
                <option value="Chine">🇨🇳 Chine</option>
                <option value="Espagne">🇪🇸 Espagne</option>
                <option value="Allemagne">🇩🇪 Allemagne</option>
                <option value="France">🇫🇷 France</option>
                <option value="Canada">🇨🇦 Canada</option>
                <option value="Autre">🌍 Autre</option>
            </select>
            <input type="text" id="destination_free" class="input-free" placeholder="Précisez la destination…">
            <div class="field-error" id="err_dest">La destination est requise.</div>
        </div>

        <div class="form-group">
            <label>Filière <span class="req">*</span></label>
            <select id="filiere" onchange="toggleFree('filiere')">
                <option value="">— Choisir —</option>
                <option value="Informatique/Tech">💻 Informatique / Tech</option>
                <option value="Commerce/Gestion">📊 Commerce / Gestion</option>
                <option value="Médecine/Santé">🏥 Médecine / Santé</option>
                <option value="Droit">⚖️ Droit</option>
                <option value="Ingénierie">⚙️ Ingénierie</option>
                <option value="Lettres/Sciences humaines">📚 Lettres / Sciences humaines</option>
                <option value="Autre">📋 Autre</option>
            </select>
            <input type="text" id="filiere_free" class="input-free" placeholder="Précisez la filière…">
            <div class="field-error" id="err_fil">La filière est requise.</div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">VALIDER LE PROSPECT</button>
    </form>
</div>

<!-- Modal Modification -->
<div class="modal-overlay" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Modifier le prospect</span>
            <button class="btn-close" onclick="closeEditModal()">✕</button>
        </div>
        <form id="editForm" novalidate>
            <div class="form-group">
                <label>Nom complet <span class="req">*</span></label>
                <input type="text" id="e_nom_complet" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Numéro WhatsApp <span class="req">*</span></label>
                <input type="tel" id="e_whatsapp" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Adresse email <span style="color:var(--text-muted);font-weight:400;">(optionnel)</span></label>
                <input type="email" id="e_email" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Destination <span class="req">*</span></label>
                <select id="e_destination" onchange="toggleFree('e_destination')">
                    <option value="">— Choisir —</option>
                    <option value="Chine">🇨🇳 Chine</option>
                    <option value="Espagne">🇪🇸 Espagne</option>
                    <option value="Allemagne">🇩🇪 Allemagne</option>
                    <option value="France">🇫🇷 France</option>
                    <option value="Canada">🇨🇦 Canada</option>
                    <option value="Autre">🌍 Autre</option>
                </select>
                <input type="text" id="e_destination_free" class="input-free" placeholder="Précisez la destination…">
            </div>
            <div class="form-group">
                <label>Filière <span class="req">*</span></label>
                <select id="e_filiere" onchange="toggleFree('e_filiere')">
                    <option value="">— Choisir —</option>
                    <option value="Informatique/Tech">💻 Informatique / Tech</option>
                    <option value="Commerce/Gestion">📊 Commerce / Gestion</option>
                    <option value="Médecine/Santé">🏥 Médecine / Santé</option>
                    <option value="Droit">⚖️ Droit</option>
                    <option value="Ingénierie">⚙️ Ingénierie</option>
                    <option value="Lettres/Sciences humaines">📚 Lettres / Sciences humaines</option>
                    <option value="Autre">📋 Autre</option>
                </select>
                <input type="text" id="e_filiere_free" class="input-free" placeholder="Précisez la filière…">
            </div>
            <button type="submit" class="btn-submit" id="editSubmitBtn">ENREGISTRER LES MODIFICATIONS</button>
        </form>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="toast"></div>

<script>
    const CSRF   = document.querySelector('meta[name="csrf-token"]').content;
    const KNOWN_DEST = ['Chine','Espagne','Allemagne','France','Canada','Autre'];
    const KNOWN_FIL  = ['Informatique/Tech','Commerce/Gestion','Médecine/Santé','Droit','Ingénierie','Lettres/Sciences humaines','Autre'];
    let currentProspect = null;

    /* ── Toast ── */
    function showToast(msg, type = 'success') {
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.className   = 'toast' + (type === 'error' ? ' error' : '');
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 3500);
    }

    /* ── Afficher/cacher champ texte libre ── */
    function toggleFree(field) {
        const sel  = document.getElementById(field);
        const free = document.getElementById(field + '_free');
        if (!free) return;
        if (sel.value === 'Autre') {
            free.classList.add('show');
            free.focus();
        } else {
            free.classList.remove('show');
            free.value = '';
        }
    }

    /* ── Lire la valeur réelle (liste ou texte libre) ── */
    function getValue(field) {
        const sel  = document.getElementById(field);
        const free = document.getElementById(field + '_free');
        if (sel.value === 'Autre' && free) return free.value.trim();
        return sel.value;
    }

    /* ── Mettre à jour la carte ── */
    function renderCard(p) {
        currentProspect = p;
        document.getElementById('lastName').textContent = p.nom_complet;
        document.getElementById('lastWa').textContent   = p.whatsapp;
        document.getElementById('lastDest').textContent = p.destination;
        document.getElementById('lastFil').textContent  = p.filiere;

        const emailPill  = document.getElementById('lastEmailPill');
        const emailSpan  = document.getElementById('lastEmail');
        if (p.email) {
            emailSpan.textContent = p.email;
            emailPill.style.display = '';
        } else {
            emailPill.style.display = 'none';
        }
        document.getElementById('lastWaLink').href = p.whatsapp_link;
        document.getElementById('lastCard').classList.add('visible');
    }

    /* ── Charger le dernier prospect depuis le serveur ── */
    async function loadLast() {
        const id = localStorage.getItem('lastProspectId');
        if (!id) return;
        try {
            const r = await fetch(`/api/prospects/${id}`, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
                credentials: 'same-origin'
            });
            if (!r.ok) { localStorage.removeItem('lastProspectId'); return; }
            const json = await r.json();
            if (json.success) renderCard(json.prospect);
        } catch (e) { /* silently ignore */ }
    }

    /* ── Soumission formulaire principal ── */
    document.getElementById('prospectForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const nom  = document.getElementById('nom_complet').value.trim();
        const wa   = document.getElementById('whatsapp').value.trim();
        const mail = document.getElementById('email').value.trim();
        const dest = getValue('destination');
        const fil  = getValue('filiere');

        // Validation front
        let valid = true;
        const show = (id, show) => { document.getElementById(id).style.display = show ? 'block' : 'none'; };
        if (!nom)  { show('err_nom',  true); valid = false; } else show('err_nom', false);
        if (!wa)   { show('err_wa',   true); valid = false; } else show('err_wa',  false);
        if (mail && !/^[^@]+@[^@]+\.[^@]+$/.test(mail)) { show('err_email', true); valid = false; } else show('err_email', false);
        if (!dest) { show('err_dest', true); valid = false; } else show('err_dest', false);
        if (!fil)  { show('err_fil',  true); valid = false; } else show('err_fil',  false);
        if (!valid) return;

        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.textContent = 'ENREGISTREMENT…';

        try {
            const r = await fetch('/api/prospects', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                credentials: 'same-origin',
                body: JSON.stringify({ nom_complet: nom, whatsapp: wa, email: mail || null, destination: dest, filiere: fil })
            });
            const json = await r.json();
            if (json.success) {
                localStorage.setItem('lastProspectId', json.id);
                renderCard(json.prospect);
                this.reset();
                document.querySelectorAll('.input-free.show').forEach(el => el.classList.remove('show'));
                showToast('✅ Prospect enregistré avec succès !');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                showToast(json.message || 'Erreur lors de l\'enregistrement.', 'error');
            }
        } catch (err) {
            showToast('Erreur réseau. Vérifiez votre connexion.', 'error');
        } finally {
            btn.disabled = false;
            btn.textContent = 'VALIDER LE PROSPECT';
        }
    });

    /* ── Modal Modification ── */
    function openEditModal() {
        if (!currentProspect) return;
        const p = currentProspect;

        // Remplir les champs
        document.getElementById('e_nom_complet').value = p.nom_complet;
        document.getElementById('e_whatsapp').value    = p.whatsapp;
        document.getElementById('e_email').value       = p.email || '';

        // Destination
        const destSel  = document.getElementById('e_destination');
        const destFree = document.getElementById('e_destination_free');
        if (KNOWN_DEST.includes(p.destination)) {
            destSel.value = p.destination;
            destFree.classList.remove('show');
        } else {
            destSel.value = 'Autre';
            destFree.value = p.destination;
            destFree.classList.add('show');
        }

        // Filière
        const filSel  = document.getElementById('e_filiere');
        const filFree = document.getElementById('e_filiere_free');
        if (KNOWN_FIL.includes(p.filiere)) {
            filSel.value = p.filiere;
            filFree.classList.remove('show');
        } else {
            filSel.value = 'Autre';
            filFree.value = p.filiere;
            filFree.classList.add('show');
        }

        document.getElementById('editModal').classList.add('open');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('open');
    }

    document.getElementById('editForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!currentProspect) return;

        const nom  = document.getElementById('e_nom_complet').value.trim();
        const wa   = document.getElementById('e_whatsapp').value.trim();
        const mail = document.getElementById('e_email').value.trim();
        const dest = getValue('e_destination');
        const fil  = getValue('e_filiere');

        if (!nom || !wa || !dest || !fil) {
            showToast('Remplissez tous les champs obligatoires.', 'error');
            return;
        }

        const btn = document.getElementById('editSubmitBtn');
        btn.disabled = true;
        btn.textContent = 'MISE À JOUR…';

        try {
            const r = await fetch(`/api/prospects/${currentProspect.id}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                credentials: 'same-origin',
                body: JSON.stringify({ nom_complet: nom, whatsapp: wa, email: mail || null, destination: dest, filiere: fil })
            });
            const json = await r.json();
            if (json.success) {
                renderCard(json.prospect);
                closeEditModal();
                showToast('✅ Prospect mis à jour !');
            } else {
                showToast(json.message || 'Erreur lors de la mise à jour.', 'error');
            }
        } catch (err) {
            showToast('Erreur réseau.', 'error');
        } finally {
            btn.disabled = false;
            btn.textContent = 'ENREGISTRER LES MODIFICATIONS';
        }
    });

    // Fermer modal si clic sur overlay
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    // Charger le dernier prospect au démarrage
    loadLast();
</script>
</body>
</html>
