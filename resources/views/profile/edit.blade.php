<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modifier le Profil - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --accent: #f97316;
            --dark: #0f172a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --success: #10b981;
            --error: #ef4444;
        }

        .font-display { font-family: 'Montserrat', sans-serif; }
        .font-sans { font-family: 'Poppins', sans-serif; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gray-50);
            color: var(--dark);
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
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-bottom: 1px solid var(--gray-100);
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            color: var(--gray-600);
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: var(--gray-100);
            color: var(--dark);
        }

        /* Card */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
            border: 1px solid var(--gray-100);
        }

        /* Header gradient */
        .edit-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 50%, var(--dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .edit-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(249, 115, 22, 0.1) 100%);
        }

        /* Avatar upload */
        .avatar-upload {
            position: relative;
            width: 120px;
            height: 120px;
            cursor: pointer;
        }

        .avatar-upload img,
        .avatar-upload .avatar-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            object-fit: cover;
        }

        .avatar-placeholder {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            font-family: 'Montserrat', sans-serif;
        }

        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .avatar-upload:hover .avatar-overlay {
            opacity: 1;
        }

        /* Form sections */
        .form-section {
            padding: 24px;
            border-bottom: 1px solid var(--gray-100);
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
        }

        /* Form inputs */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .form-label .required {
            color: var(--error);
            margin-left: 2px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 0.9375rem;
            color: var(--dark);
            background: white;
            transition: all 0.2s ease;
        }

        .form-input:hover {
            border-color: var(--gray-300);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-input::placeholder {
            color: var(--gray-400);
        }

        .form-input.error {
            border-color: var(--error);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 120px;
        }

        .input-error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            font-size: 0.8125rem;
            color: var(--error);
        }

        .char-counter {
            font-size: 0.75rem;
            color: var(--gray-400);
            text-align: right;
            margin-top: 4px;
        }

        .char-counter.warning { color: #f59e0b; }
        .char-counter.danger { color: var(--error); }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 4px 14px rgba(30, 64, 175, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.35);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.8125rem;
        }

        /* Alert */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            animation: fadeIn 0.3s ease;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .alert-success .alert-icon {
            background: #10b981;
            color: white;
        }

        .alert-error .alert-icon {
            background: #ef4444;
            color: white;
        }

        /* Avatar buttons */
        .avatar-actions {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .avatar-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .avatar-btn-upload {
            background: white;
            color: var(--primary);
            border: none;
        }

        .avatar-btn-upload:hover {
            background: rgba(255,255,255,0.9);
        }

        .avatar-btn-delete {
            background: rgba(239, 68, 68, 0.2);
            color: #fecaca;
            border: none;
        }

        .avatar-btn-delete:hover {
            background: rgba(239, 68, 68, 0.3);
        }

        /* Spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-bar sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/profile" class="nav-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour au profil</span>
                </a>

                <a href="/" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center">
                        <i class="fas fa-globe text-white"></i>
                    </div>
                    <span class="font-display font-bold text-lg text-gray-900 hidden sm:block">Travel Express</span>
                </a>

                <div class="w-32"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 fade-in">

            <!-- Alert Container -->
            <div id="alert-container"></div>

            <!-- Edit Card -->
            <div class="card overflow-hidden">

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

                        <p class="text-blue-200 text-xs mt-3">JPG, PNG ou GIF - Max 2MB</p>
                    </div>
                </div>

                <!-- Form -->
                <form id="profileForm">

                    <!-- Personal Info Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <span class="section-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8)">
                                <i class="fas fa-user"></i>
                            </span>
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
                            <span class="section-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                                <i class="fas fa-phone"></i>
                            </span>
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
                            <span class="section-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706)">
                                <i class="fas fa-briefcase"></i>
                            </span>
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
                            <span class="section-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed)">
                                <i class="fas fa-quote-left"></i>
                            </span>
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
                    <div class="form-section bg-gray-50">
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
                    <p class="flex-1 font-medium">${message}</p>
                    <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
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
