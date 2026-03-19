<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/images/logo/logo_travel.png">
    <link rel="shortcut icon" type="image/png" href="/images/logo/logo_travel.png">
    <title>Modifier le Profil - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gold-primary: #C9A84C;
            --gold-bright:  #F0D07A;
            --gold-deep:    #8B6914;
            --gold-gradient: linear-gradient(135deg, #8B6914 0%, #C9A84C 30%, #F0D07A 50%, #C9A84C 70%, #8B6914 100%);
            --dark-0: #080808; --dark-100: #141414; --dark-200: #1C1C1C;
            --dark-300: #262626; --dark-400: #333333; --dark-500: #4A4A4A;
            --dark-600: #6B6B6B; --dark-700: #8A8A8A; --dark-800: #B0B0B0; --dark-900: #D4D4D4;
            --glow-gold: 0 0 20px rgba(201,168,76,.25), 0 0 60px rgba(201,168,76,.08);
            --glow-gold-strong: 0 0 30px rgba(201,168,76,.4), 0 0 80px rgba(201,168,76,.15);
            --r-sm:3px; --r-md:6px; --r-lg:10px; --r-xl:14px; --r-full:9999px;
            --font-display: 'Bebas Neue', sans-serif;
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'Lato', sans-serif;
            --color-success: #2ECABB;
            --color-warning: #F0B428;
            --color-danger:  #E74C3C;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--dark-800);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(201,168,76,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Navigation */
        .nav-bar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(8,8,8,.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,168,76,.15);
        }

        .nav-link {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: var(--r-lg);
            font-weight: 600; font-size: 0.85rem;
            color: var(--dark-600); text-decoration: none;
            transition: all 0.2s;
        }
        .nav-link:hover { background: rgba(201,168,76,.07); color: var(--gold-primary); }

        /* Card */
        .card {
            background: var(--dark-100);
            border-radius: var(--r-xl);
            border: 1px solid rgba(201,168,76,.15);
            overflow: hidden;
            position: relative;
        }
        .card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.4), transparent);
        }

        /* Header gradient */
        .edit-header {
            background: linear-gradient(180deg, var(--dark-200) 0%, var(--dark-100) 100%);
            border-bottom: 1px solid rgba(201,168,76,.15);
            position: relative; overflow: hidden;
        }

        .edit-header::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 80% at 50% 0%, rgba(201,168,76,.06) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Avatar upload */
        .avatar-upload {
            position: relative;
            width: 120px; height: 120px;
            cursor: pointer;
        }

        .avatar-upload img,
        .avatar-upload .avatar-placeholder {
            width: 100%; height: 100%;
            border-radius: 50%;
            border: 3px solid rgba(201,168,76,.3);
            box-shadow: var(--glow-gold);
            object-fit: cover;
        }

        .avatar-placeholder {
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; font-weight: 700;
            color: #000; font-family: var(--font-serif);
        }

        .avatar-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,.55);
            border-radius: 50%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s;
        }
        .avatar-upload:hover .avatar-overlay { opacity: 1; }

        /* Form sections */
        .form-section {
            padding: 24px;
            border-bottom: 1px solid rgba(201,168,76,.08);
        }
        .form-section:last-child { border-bottom: none; }

        .section-title {
            font-family: var(--font-serif);
            font-weight: 600; font-size: 1.05rem;
            color: var(--dark-900);
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 20px; letter-spacing: 0.02em;
        }

        .section-icon {
            width: 36px; height: 36px; border-radius: var(--r-lg);
            display: flex; align-items: center; justify-content: center;
            background: rgba(201,168,76,.1);
            border: 1px solid rgba(201,168,76,.2);
            color: var(--gold-primary); font-size: 0.875rem;
        }

        /* Form inputs */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block; font-size: 0.7rem;
            font-weight: 700; letter-spacing: .15em;
            text-transform: uppercase; color: var(--gold-deep);
            margin-bottom: 8px;
        }

        .form-label .required { color: var(--color-danger); margin-left: 2px; }

        .form-input {
            width: 100%; padding: 12px 16px;
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            font-size: 0.9rem; color: var(--dark-900);
            background: var(--dark-200); transition: all 0.2s;
            font-family: var(--font-body);
        }

        .form-input:hover { border-color: rgba(201,168,76,.3); }

        .form-input:focus {
            outline: none;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.1);
        }

        .form-input::placeholder { color: var(--dark-500); }

        .form-input.error { border-color: var(--color-danger); }

        textarea.form-input { resize: vertical; min-height: 120px; }

        .input-error {
            display: flex; align-items: center; gap: 6px;
            margin-top: 6px; font-size: 0.8rem;
            color: var(--color-danger);
        }

        .char-counter {
            font-size: 0.75rem; color: var(--dark-600);
            text-align: right; margin-top: 4px;
        }
        .char-counter.warning { color: var(--color-warning); }
        .char-counter.danger  { color: var(--color-danger); }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center;
            justify-content: center; gap: 8px;
            padding: 12px 24px; border-radius: var(--r-lg);
            font-weight: 700; font-size: 0.875rem;
            letter-spacing: 0.08em; text-transform: uppercase;
            transition: all 0.3s; cursor: pointer; border: none;
            font-family: var(--font-body);
        }

        .btn-primary {
            background: var(--gold-gradient);
            color: #000;
            box-shadow: 0 4px 14px rgba(201,168,76,.25);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--glow-gold-strong);
        }
        .btn-primary:disabled {
            opacity: 0.6; cursor: not-allowed; transform: none;
        }

        .btn-secondary {
            background: var(--dark-300);
            color: var(--dark-700);
            border: 1px solid rgba(201,168,76,.15);
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: var(--dark-400); color: var(--dark-900);
            border-color: rgba(201,168,76,.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #E74C3C, #c0392b);
            color: white;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231,76,60,.35);
        }

        .btn-sm { padding: 8px 16px; font-size: 0.78rem; }

        /* Alert */
        .alert {
            display: flex; align-items: center; gap: 12px;
            padding: 16px 20px; border-radius: var(--r-xl);
            margin-bottom: 24px; animation: fadeIn 0.3s ease;
        }

        .alert-success {
            background: rgba(46,202,187,.08);
            border: 1px solid rgba(46,202,187,.3);
            color: var(--color-success);
        }

        .alert-error {
            background: rgba(231,76,60,.08);
            border: 1px solid rgba(231,76,60,.3);
            color: var(--color-danger);
        }

        .alert-icon {
            width: 40px; height: 40px; border-radius: var(--r-lg);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 1rem;
        }
        .alert-success .alert-icon { background: rgba(46,202,187,.15); }
        .alert-error .alert-icon   { background: rgba(231,76,60,.15); }

        /* Avatar buttons */
        .avatar-actions { display: flex; gap: 8px; margin-top: 16px; }

        .avatar-btn {
            padding: 8px 16px; border-radius: var(--r-md);
            font-size: 0.8rem; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase;
            transition: all 0.2s; cursor: pointer; border: none;
            font-family: var(--font-body);
        }

        .avatar-btn-upload {
            background: rgba(201,168,76,.12);
            color: var(--gold-primary);
            border: 1px solid rgba(201,168,76,.25);
        }
        .avatar-btn-upload:hover { background: rgba(201,168,76,.22); }

        .avatar-btn-delete {
            background: rgba(231,76,60,.1);
            color: var(--color-danger);
            border: 1px solid rgba(231,76,60,.25);
        }
        .avatar-btn-delete:hover { background: rgba(231,76,60,.2); }

        /* Spinner */
        .spinner {
            width: 20px; height: 20px;
            border: 2px solid rgba(0,0,0,.3);
            border-top-color: #000;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: inline-block;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-0); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,.25); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,.5); }

        /* Hint text */
        .hint-text { font-size: 0.78rem; color: var(--dark-600); margin-top: 4px; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-bar">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/profile" class="nav-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour au profil</span>
                </a>

                <a href="/" class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:var(--gold-gradient)">
                        <i class="fas fa-globe" style="color:#000;"></i>
                    </div>
                    <span class="hidden sm:block" style="font-family:var(--font-serif);font-weight:700;font-size:1.1rem;color:var(--dark-900);">Travel Express</span>
                </a>

                <div class="w-32"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pb-12" style="position:relative;z-index:1;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 fade-in">

            <!-- Alert Container -->
            <div id="alert-container"></div>

            <!-- Edit Card -->
            <div class="card">

                <!-- Header with Avatar -->
                <div class="edit-header px-6 py-10 relative z-10">
                    <div class="flex flex-col items-center">
                        <label class="avatar-upload">
                            <input type="file" id="avatar-input" accept="image/*" class="hidden">
                            <div id="avatar-preview"></div>
                            <div class="avatar-overlay">
                                <i class="fas fa-camera text-white text-xl mb-1"></i>
                                <span class="text-white text-xs font-medium">Modifier</span>
                            </div>
                        </label>

                        <div class="avatar-actions">
                            <button type="button" onclick="document.getElementById('avatar-input').click()" class="avatar-btn avatar-btn-upload">
                                <i class="fas fa-upload mr-2"></i>Changer
                            </button>
                            <button type="button" onclick="deleteAvatar()" id="delete-avatar-btn" class="avatar-btn avatar-btn-delete hidden">
                                <i class="fas fa-trash mr-2"></i>Supprimer
                            </button>
                        </div>

                        <p class="hint-text mt-3" style="color:var(--dark-600);">JPG, PNG ou GIF · Max 2MB</p>
                    </div>
                </div>

                <!-- Form -->
                <form id="profileForm">

                    <!-- Personal Info Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <span class="section-icon"><i class="fas fa-user"></i></span>
                            Informations personnelles
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label">Nom complet <span class="required">*</span></label>
                                <input type="text" id="name" class="form-input" placeholder="Jean Dupont" required>
                                <p class="input-error hidden" id="name-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email <span class="required">*</span></label>
                                <input type="email" id="email" class="form-input" placeholder="jean@exemple.com" required>
                                <p class="input-error hidden" id="email-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <span class="section-icon"><i class="fas fa-phone"></i></span>
                            Contact
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" id="phone" class="form-input" placeholder="+33 6 12 34 56 78">
                                <p class="input-error hidden" id="phone-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Localisation</label>
                                <input type="text" id="location" class="form-input" placeholder="Paris, France">
                                <p class="input-error hidden" id="location-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <span class="section-icon"><i class="fas fa-briefcase"></i></span>
                            Informations professionnelles
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label">Entreprise</label>
                                <input type="text" id="company" class="form-input" placeholder="Travel Express">
                                <p class="input-error hidden" id="company-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Poste</label>
                                <input type="text" id="position" class="form-input" placeholder="Designer UI/UX">
                                <p class="input-error hidden" id="position-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div class="form-group md:col-span-2">
                                <label class="form-label">Site web</label>
                                <input type="url" id="website" class="form-input" placeholder="https://exemple.com">
                                <p class="input-error hidden" id="website-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Bio Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <span class="section-icon"><i class="fas fa-quote-left"></i></span>
                            À propos de vous
                        </h3>

                        <div class="form-group">
                            <label class="form-label">Bio</label>
                            <textarea id="bio" class="form-input" maxlength="500" placeholder="Parlez-nous de vous, vos passions, vos expériences..."></textarea>
                            <div class="char-counter" id="bio-counter">0/500</div>
                            <p class="input-error hidden" id="bio-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="form-section" style="background:var(--dark-200);">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" id="saveButton" class="btn btn-primary flex-1">
                                <i class="fas fa-check"></i>
                                <span id="saveButtonText">Enregistrer les modifications</span>
                            </button>

                            <a href="/profile" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Annuler
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const authToken = localStorage.getItem('auth_token');

        if (!authToken) {
            window.location.href = '/login';
        }

        let currentUser = null;

        // Bio character counter
        const bioInput = document.getElementById('bio');
        const bioCounter = document.getElementById('bio-counter');

        bioInput.addEventListener('input', function() {
            const length = this.value.length;
            bioCounter.textContent = `${length}/500`;

            bioCounter.classList.remove('warning', 'danger');
            if (length > 450) {
                bioCounter.classList.add('danger');
            } else if (length > 350) {
                bioCounter.classList.add('warning');
            }
        });

        async function loadProfile() {
            try {
                const response = await fetch('/api/profile', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    currentUser = data.data;
                    populateForm(currentUser);
                } else {
                    if (response.status === 401) {
                        localStorage.removeItem('auth_token');
                        localStorage.removeItem('user');
                        window.location.href = '/login';
                    }
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        }

        function populateForm(user) {
            document.getElementById('name').value = user.name || '';
            document.getElementById('email').value = user.email || '';
            document.getElementById('phone').value = user.phone || '';
            document.getElementById('bio').value = user.bio || '';
            document.getElementById('company').value = user.company || '';
            document.getElementById('position').value = user.position || '';
            document.getElementById('website').value = user.website || '';
            document.getElementById('location').value = user.location || '';

            const bioLength = (user.bio || '').length;
            bioCounter.textContent = `${bioLength}/500`;
            updateAvatarPreview(user);
        }

        function updateAvatarPreview(user) {
            const preview = document.getElementById('avatar-preview');
            const deleteBtn = document.getElementById('delete-avatar-btn');

            if (user.avatar) {
                preview.innerHTML = `<img src="/storage/${user.avatar}" alt="${user.name}">`;
                deleteBtn.classList.remove('hidden');
            } else {
                const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase();
                preview.innerHTML = `<div class="avatar-placeholder">${initials}</div>`;
                deleteBtn.classList.add('hidden');
            }
        }

        document.getElementById('avatar-input').addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('avatar', file);

            const button = document.getElementById('saveButton');
            button.disabled = true;

            try {
                const response = await fetch('/api/profile/avatar', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    showAlert('Photo de profil mise à jour avec succès!', 'success');
                    currentUser = data.data.user;
                    updateAvatarPreview(currentUser);
                    localStorage.setItem('user', JSON.stringify(currentUser));
                } else {
                    showAlert(data.message || 'Erreur lors de l\'upload', 'error');
                }
            } catch (error) {
                showAlert('Erreur lors de l\'upload', 'error');
            } finally {
                button.disabled = false;
            }
        });

        async function deleteAvatar() {
            if (!confirm('Êtes-vous sûr de vouloir supprimer votre photo de profil ?')) return;

            try {
                const response = await fetch('/api/profile/avatar', {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showAlert('Photo de profil supprimée', 'success');
                    currentUser = data.data;
                    updateAvatarPreview(currentUser);
                    localStorage.setItem('user', JSON.stringify(currentUser));
                } else {
                    showAlert(data.message || 'Erreur', 'error');
                }
            } catch (error) {
                showAlert('Erreur lors de la suppression', 'error');
            }
        }

        document.getElementById('profileForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const button = document.getElementById('saveButton');
            const buttonText = document.getElementById('saveButtonText');

            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.form-input').forEach(el => el.classList.remove('error'));

            button.disabled = true;
            buttonText.innerHTML = '<span class="spinner"></span> Enregistrement...';

            try {
                const response = await fetch('/api/profile', {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        phone: document.getElementById('phone').value,
                        bio: document.getElementById('bio').value,
                        company: document.getElementById('company').value,
                        position: document.getElementById('position').value,
                        website: document.getElementById('website').value,
                        location: document.getElementById('location').value
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('user', JSON.stringify(data.data));
                    showAlert('Profil mis à jour avec succès!', 'success');
                    setTimeout(() => window.location.href = '/profile', 1500);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const input = document.getElementById(key);
                            const errorEl = document.getElementById(`${key}-error`);
                            if (input) input.classList.add('error');
                            if (errorEl) {
                                errorEl.querySelector('span').textContent = data.errors[key][0];
                                errorEl.classList.remove('hidden');
                            }
                        });
                    } else {
                        showAlert(data.message || 'Erreur de mise à jour', 'error');
                    }
                }
            } catch (error) {
                showAlert('Erreur lors de la mise à jour', 'error');
            } finally {
                button.disabled = false;
                buttonText.innerHTML = '<i class="fas fa-check"></i> Enregistrer les modifications';
            }
        });

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alert-container');
            const iconClass = type === 'success' ? 'fa-check' : 'fa-exclamation-triangle';

            alertContainer.innerHTML = `
                <div class="alert alert-${type}">
                    <div class="alert-icon">
                        <i class="fas ${iconClass}"></i>
                    </div>
                    <p class="flex-1 font-medium" style="font-weight:600;">${message}</p>
                    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:inherit;opacity:.7;font-size:1rem;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) alert.remove();
            }, 5000);
        }

        loadProfile();
    </script>
</body>
</html>
