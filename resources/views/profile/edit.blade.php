<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modifier le Profil - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #0f0f1a;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated gradient background */
        .bg-animated {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(255, 119, 198, 0.2) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            animation: bgMove 20s ease infinite;
            z-index: 0;
        }

        @keyframes bgMove {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(5deg); }
        }

        /* Glass morphism */
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-light {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .floating-delay {
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
        }

        /* Form inputs */
        .input-modern {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-modern::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-modern:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1), 0 8px 20px rgba(139, 92, 246, 0.15);
            transform: translateY(-2px);
        }

        .input-modern:hover:not(:focus) {
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Section cards */
        .section-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(139, 92, 246, 0.2);
        }

        /* Button gradient */
        .btn-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(139, 92, 246, 0.4);
        }

        .btn-gradient:active {
            transform: translateY(-1px);
        }

        /* Avatar upload */
        .avatar-upload {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-upload:hover {
            transform: scale(1.05);
        }

        .avatar-upload:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Labels */
        .label-modern {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .label-modern i {
            color: #8b5cf6;
        }

        /* Error messages */
        .error-msg {
            color: #f87171;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Alert */
        .alert {
            animation: fadeInUp 0.5s ease;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #8b5cf6, #ec4899);
            border-radius: 4px;
        }

        /* Character counter */
        .char-counter {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.4);
            transition: color 0.3s ease;
        }

        .char-counter.warning {
            color: #fbbf24;
        }

        .char-counter.danger {
            color: #f87171;
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animated"></div>

    <!-- Floating decorative elements -->
    <div class="fixed top-20 left-10 w-72 h-72 bg-purple-500/10 rounded-full blur-3xl floating"></div>
    <div class="fixed bottom-20 right-10 w-96 h-96 bg-pink-500/10 rounded-full blur-3xl floating-delay"></div>

    <!-- Navigation Bar -->
    <nav class="glass fixed top-0 left-0 right-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/profile" class="flex items-center space-x-3 text-white/80 hover:text-white transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-pink-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-arrow-left text-white"></i>
                    </div>
                    <span class="font-semibold hidden sm:block">Retour au profil</span>
                </a>

                <h1 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fas fa-user-edit text-violet-400"></i>
                    Modifier le profil
                </h1>

                <div class="w-10 sm:w-40"></div>
            </div>
        </div>
    </nav>

    <div class="relative z-10 max-w-5xl mx-auto px-4 pt-24 pb-12">
        <div class="fade-in-up">

            <!-- Alert Container -->
            <div id="alert-container" class="mb-6"></div>

            <!-- Main Form Card -->
            <div class="glass rounded-3xl overflow-hidden">

                <!-- Header with Avatar -->
                <div class="relative bg-gradient-to-r from-violet-600 via-purple-600 to-pink-600 px-8 py-12">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-1/2 -right-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-1/2 -left-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                    </div>

                    <div class="relative text-center">
                        <label class="avatar-upload inline-block">
                            <input type="file" id="avatar-input" accept="image/*" class="hidden">
                            <div id="avatar-preview" class="w-32 h-32 rounded-full bg-white/20 flex items-center justify-center ring-4 ring-white/30 overflow-hidden mx-auto"></div>
                            <div class="avatar-overlay">
                                <div class="text-center">
                                    <i class="fas fa-camera text-2xl text-white mb-1"></i>
                                    <p class="text-xs text-white font-medium">Changer</p>
                                </div>
                            </div>
                        </label>

                        <div class="mt-4 flex justify-center gap-3">
                            <button onclick="document.getElementById('avatar-input').click()" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-xl transition-all backdrop-blur-sm">
                                <i class="fas fa-upload mr-2"></i>Changer la photo
                            </button>
                            <button onclick="deleteAvatar()" id="delete-avatar-btn" class="px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-200 text-sm font-medium rounded-xl transition-all backdrop-blur-sm hidden">
                                <i class="fas fa-trash mr-2"></i>Supprimer
                            </button>
                        </div>
                        <p class="text-white/60 text-xs mt-3">JPG, PNG ou GIF - Max 2MB</p>
                    </div>
                </div>

                <!-- Form -->
                <form id="profileForm" class="p-8 space-y-8">

                    <!-- Personal Information Section -->
                    <div class="section-card rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            Informations personnelles
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="label-modern">
                                    <i class="fas fa-signature"></i>
                                    Nom complet <span class="text-pink-400">*</span>
                                </label>
                                <input type="text" id="name" required
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="Jean Dupont">
                                <p class="error-msg hidden" id="name-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div>
                                <label class="label-modern">
                                    <i class="fas fa-envelope"></i>
                                    Email <span class="text-pink-400">*</span>
                                </label>
                                <input type="email" id="email" required
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="jean@exemple.com">
                                <p class="error-msg hidden" id="email-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="section-card rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center">
                                <i class="fas fa-address-book text-white"></i>
                            </div>
                            Contact
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="label-modern">
                                    <i class="fas fa-phone"></i>
                                    Téléphone
                                </label>
                                <input type="tel" id="phone"
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="+33 6 12 34 56 78">
                                <p class="error-msg hidden" id="phone-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div>
                                <label class="label-modern">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Localisation
                                </label>
                                <input type="text" id="location"
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="Paris, France">
                                <p class="error-msg hidden" id="location-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Section -->
                    <div class="section-card rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center">
                                <i class="fas fa-briefcase text-white"></i>
                            </div>
                            Informations professionnelles
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="label-modern">
                                    <i class="fas fa-building"></i>
                                    Entreprise
                                </label>
                                <input type="text" id="company"
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="Travel Express">
                                <p class="error-msg hidden" id="company-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div>
                                <label class="label-modern">
                                    <i class="fas fa-user-tie"></i>
                                    Poste
                                </label>
                                <input type="text" id="position"
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="Designer UI/UX">
                                <p class="error-msg hidden" id="position-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="label-modern">
                                    <i class="fas fa-globe"></i>
                                    Site web
                                </label>
                                <input type="url" id="website"
                                    class="w-full px-4 py-3.5 rounded-xl input-modern outline-none"
                                    placeholder="https://exemple.com">
                                <p class="error-msg hidden" id="website-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Bio Section -->
                    <div class="section-card rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center">
                                <i class="fas fa-quote-left text-white"></i>
                            </div>
                            À propos de vous
                        </h3>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="label-modern mb-0">
                                    <i class="fas fa-pen-fancy"></i>
                                    Bio
                                </label>
                                <span class="char-counter" id="bio-counter">0/500</span>
                            </div>
                            <textarea id="bio" rows="4" maxlength="500"
                                class="w-full px-4 py-3.5 rounded-xl input-modern outline-none resize-none"
                                placeholder="Parlez-nous de vous, vos passions, vos expériences..."></textarea>
                            <p class="error-msg hidden" id="bio-error"><i class="fas fa-exclamation-circle"></i><span></span></p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="submit" id="saveButton"
                            class="flex-1 py-4 btn-gradient text-white font-bold rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <span id="saveButtonText">Enregistrer les modifications</span>
                        </button>

                        <a href="/profile"
                            class="px-8 py-4 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-white font-semibold rounded-xl transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                preview.innerHTML = `<img src="/storage/${user.avatar}" alt="${user.name}" class="w-full h-full object-cover">`;
                deleteBtn.classList.remove('hidden');
            } else {
                const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase();
                preview.innerHTML = `<div class="w-full h-full bg-gradient-to-br from-violet-600 via-purple-600 to-pink-600 flex items-center justify-center"><span class="text-4xl font-bold text-white">${initials}</span></div>`;
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

            button.disabled = true;
            buttonText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Enregistrement...';

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
                            const el = document.getElementById(`${key}-error`);
                            if (el) {
                                el.querySelector('span').textContent = data.errors[key][0];
                                el.classList.remove('hidden');
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
                buttonText.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Enregistrer les modifications';
            }
        });

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alert-container');
            const bgClass = type === 'success' ? 'from-emerald-500 to-green-600' : 'from-red-500 to-pink-600';
            const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            alertContainer.innerHTML = `
                <div class="alert glass rounded-2xl p-4 border ${type === 'success' ? 'border-emerald-500/30' : 'border-red-500/30'}">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br ${bgClass} flex items-center justify-center flex-shrink-0">
                            <i class="fas ${iconClass} text-white text-xl"></i>
                        </div>
                        <p class="text-white font-medium flex-1">${message}</p>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-white/50 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;

            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 5000);
        }

        loadProfile();
    </script>
</body>
</html>
