<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modifier le Profil - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .slide-down { animation: slideDown 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-elegant {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-elegant:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- Navigation Bar -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/profile" class="flex items-center space-x-2 text-white hover:text-white/80 transition-colors group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="font-semibold">Retour au profil</span>
                </a>
                <h1 class="text-xl font-bold text-white">Modifier le profil</h1>
                <div class="w-40"></div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="fade-in-up">
            <!-- Alert Container -->
            <div id="alert-container" class="mb-6"></div>

            <!-- Main Edit Card -->
            <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
                <!-- Avatar Section -->
                <div class="bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 px-8 py-12">
                    <div class="text-center">
                        <div class="flex justify-center mb-6">
                            <div id="avatar-preview" class="w-32 h-32 rounded-full bg-white shadow-2xl flex items-center justify-center ring-4 ring-white/50 overflow-hidden"></div>
                        </div>
                        <div class="flex justify-center space-x-3">
                            <label class="cursor-pointer px-6 py-2.5 bg-white text-violet-600 font-semibold rounded-xl hover:bg-white/90 transition-all shadow-lg">
                                <input type="file" id="avatar-input" accept="image/*" class="hidden">
                                📸 Changer la photo
                            </label>
                            <button onclick="deleteAvatar()" id="delete-avatar-btn" class="px-6 py-2.5 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 transition-all shadow-lg hidden">
                                🗑️ Supprimer
                            </button>
                        </div>
                        <p class="text-white/80 text-sm mt-4">JPG, PNG ou GIF · Max 2MB</p>
                    </div>
                </div>

                <!-- Form Section -->
                <form id="profileForm" class="p-8 space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            Informations personnelles
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet *</label>
                                <input type="text" id="name" required
                                    class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant">
                                <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="name-error"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                                <input type="email" id="email" required
                                    class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant">
                                <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="email-error"></p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            Contact
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                                <input type="tel" id="phone"
                                    class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant"
                                    placeholder="+33 6 12 34 56 78">
                                <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="phone-error"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
                                <input type="text" id="location"
                                    class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant"
                                    placeholder="Paris, France">
                                <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="location-error"></p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Professional Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            Informations professionnelles
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Entreprise</label>
                                <input type="text" id="company"
                                    class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant"
                                    placeholder="Travel Express">
                                <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="company-error"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Poste</label>
                                <input type="text" id="position"
                                    class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant"
                                    placeholder="Designer UI/UX">
                                <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="position-error"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Website -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                            Site web
                        </label>
                        <input type="url" id="website" placeholder="https://example.com"
                            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant">
                        <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="website-error"></p>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center justify-between">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                Bio
                            </span>
                            <span class="text-xs text-gray-400" id="bio-counter">0/500</span>
                        </label>
                        <textarea id="bio" rows="4" maxlength="500"
                            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-violet-500 focus:ring-0 outline-none text-gray-900 input-elegant resize-none"
                            placeholder="Parlez-nous de vous..."></textarea>
                        <p class="text-red-600 text-sm mt-1.5 hidden slide-down" id="bio-error"></p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" id="saveButton"
                            class="flex-1 py-4 btn-gradient text-white font-bold rounded-xl shadow-xl flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="saveButtonText">Enregistrer les modifications</span>
                        </button>
                        <a href="/profile"
                            class="px-8 py-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
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
            bioCounter.textContent = `${this.value.length}/500`;
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

            bioCounter.textContent = `${(user.bio || '').length}/500`;
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
                preview.innerHTML = `<div class="w-full h-full bg-gradient-to-br from-violet-600 to-indigo-600 flex items-center justify-center"><span class="text-4xl font-bold text-white">${initials}</span></div>`;
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
                    showAlert('Photo de profil mise à jour! ✨', 'success');
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
            buttonText.textContent = 'Enregistrement...';

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
                    showAlert('Profil mis à jour avec succès! 🎉', 'success');
                    setTimeout(() => window.location.href = '/profile', 1500);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const el = document.getElementById(`${key}-error`);
                            if (el) {
                                el.textContent = data.errors[key][0];
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
                buttonText.textContent = 'Enregistrer les modifications';
            }
        });

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alert-container');
            const bgGradient = type === 'success' ? 'from-green-500 to-emerald-600' : 'from-red-500 to-pink-600';
            const icon = type === 'success' ?
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';

            alertContainer.innerHTML = `
                <div class="glass-card rounded-2xl p-4 shadow-2xl slide-down">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br ${bgGradient} rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                ${icon}
                            </svg>
                        </div>
                        <p class="text-gray-900 font-semibold">${message}</p>
                    </div>
                </div>
            `;

            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        loadProfile();
    </script>
</body>
</html>
