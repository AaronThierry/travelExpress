<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Profil - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display { font-family: 'Montserrat', sans-serif; }
        .font-sans { font-family: 'Poppins', sans-serif; }
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="font-sans text-dark antialiased bg-gray-light" x-data="{
    mobileMenuOpen: false,
    user: null,
    init() {
        const userData = localStorage.getItem('user');
        if (userData) this.user = JSON.parse(userData);
    },
    logout() {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        window.location.href = '/';
    },
    getInitials(name) {
        return name ? name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2) : '';
    }
}">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-2xl border-b border-black/[0.08] shadow-sm">
        <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white py-1.5 hidden lg:block">
            <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center space-x-6">
                        <a href="tel:+221771234567" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <i class="fas fa-phone text-xs"></i>
                            <span class="font-medium">+221 77 123 45 67</span>
                        </a>
                        <a href="mailto:contact@travelexpress.com" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <i class="fas fa-envelope text-xs"></i>
                            <span class="font-medium">contact@travelexpress.com</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center space-x-2">
                            <i class="fas fa-clock text-xs"></i>
                            <span class="font-medium">Lun-Ven: 9h-18h | Sam: 10h-14h</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <nav class="flex items-center justify-between h-[70px]">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-11 h-11 bg-gradient-to-br from-primary-600 to-accent-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-globe text-white text-lg"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-display font-extrabold text-dark">Travel Express</span>
                        <span class="text-[9px] font-bold text-primary-600 tracking-widest uppercase">Study Abroad</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="/#programmes" class="text-sm font-semibold text-gray-600 hover:text-dark transition-colors">Programmes</a>
                    <a href="/#pourquoi" class="text-sm font-semibold text-gray-600 hover:text-dark transition-colors">Avantages</a>
                    <a href="/#processus" class="text-sm font-semibold text-gray-600 hover:text-dark transition-colors">Processus</a>
                    <a href="/#contact" class="text-sm font-semibold text-gray-600 hover:text-dark transition-colors">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/profile/edit" class="hidden sm:flex items-center space-x-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold text-sm transition-colors">
                        <i class="fas fa-pen"></i>
                        <span>Modifier</span>
                    </a>
                    <button @click="logout()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold text-sm transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hidden sm:inline">Déconnexion</span>
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-[120px] lg:pt-[140px] pb-16">
        <div id="profile-content" class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="flex flex-col items-center justify-center min-h-[50vh]">
                <div class="w-12 h-12 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
                <p class="mt-4 text-gray-500 font-medium">Chargement du profil...</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-globe text-white"></i>
                        </div>
                        <span class="text-xl font-display font-bold">Travel Express</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Votre partenaire de confiance pour vos études à l'étranger.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-display font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/#programmes" class="text-gray-400 hover:text-white transition-colors">Nos programmes</a></li>
                        <li><a href="/#pourquoi" class="text-gray-400 hover:text-white transition-colors">Pourquoi nous</a></li>
                        <li><a href="/#processus" class="text-gray-400 hover:text-white transition-colors">Notre processus</a></li>
                        <li><a href="/#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-display font-bold mb-4">Destinations</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Chine</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Espagne</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Allemagne</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bourses d'études</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-display font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-envelope"></i>
                            <span>contact@travelexpress.com</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-phone"></i>
                            <span>+221 77 123 45 67</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Dakar, Sénégal</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 text-center text-sm text-gray-400">
                <p>© 2025 Travel Express. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) window.location.href = '/login';

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
                    displayProfile(data.data);
                } else if (response.status === 401) {
                    localStorage.removeItem('auth_token');
                    localStorage.removeItem('user');
                    window.location.href = '/login';
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        }

        function displayProfile(user) {
            const initials = user.name ? user.name.split(' ').map(n => n[0]).join('').toUpperCase() : '';

            // Correction de l'URL de l'avatar
            let avatarHtml = '';
            if (user.avatar) {
                const avatarUrl = user.avatar.startsWith('http') ? user.avatar : `/storage/${user.avatar}`;
                avatarHtml = `<img src="${avatarUrl}" alt="${user.name}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl">`;
            } else {
                avatarHtml = `<div class="w-32 h-32 rounded-full bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center border-4 border-white shadow-xl">
                    <span class="text-4xl font-bold text-white font-display">${initials}</span>
                </div>`;
            }

            const fields = ['name', 'email', 'phone', 'bio', 'country', 'whatsapp', 'date_of_birth', 'gender', 'nationality', 'language', 'interests', 'linkedin', 'twitter', 'instagram', 'company', 'position', 'location', 'website'];
            const filledFields = fields.filter(f => user[f] && user[f] !== '').length;
            const completionPercentage = Math.round((filledFields / fields.length) * 100);
            const interests = user.interests ? user.interests.split(',').map(i => i.trim()).filter(i => i) : [];

            const content = `
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-dark rounded-2xl p-8 mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center md:items-end gap-6">
                        <div class="relative">
                            ${avatarHtml}
                            <div class="absolute bottom-1 right-1 w-8 h-8 bg-green-500 rounded-full border-3 border-white flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                        </div>

                        <div class="text-center md:text-left flex-1">
                            <h1 class="text-3xl font-display font-bold text-white mb-1">${user.name}</h1>
                            ${user.position ? `<p class="text-primary-200 font-medium text-lg">${user.position}</p>` : ''}
                            ${user.location ? `<p class="text-white/70 flex items-center justify-center md:justify-start gap-2 mt-2"><i class="fas fa-map-marker-alt text-accent-400"></i>${user.location}</p>` : ''}
                        </div>

                        <div class="flex gap-3">
                            <div class="text-center px-5 py-3 bg-white/10 rounded-xl backdrop-blur-sm">
                                <div class="text-2xl font-bold text-white font-display">${filledFields}</div>
                                <div class="text-xs text-primary-200 uppercase">Infos</div>
                            </div>
                            <div class="text-center px-5 py-3 bg-white/10 rounded-xl backdrop-blur-sm">
                                <div class="text-2xl font-bold text-white font-display">${interests.length}</div>
                                <div class="text-xs text-primary-200 uppercase">Intérêts</div>
                            </div>
                            <div class="text-center px-5 py-3 bg-white/10 rounded-xl backdrop-blur-sm">
                                <div class="text-2xl font-bold text-green-400 font-display">${completionPercentage}%</div>
                                <div class="text-xs text-primary-200 uppercase">Complet</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Completion Card -->
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <div class="flex justify-between items-center mb-3">
                                <span class="font-semibold text-gray-700">Profil complété</span>
                                <span class="font-bold text-primary-600">${completionPercentage}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-primary-500 to-accent-500 rounded-full transition-all duration-1000" style="width: ${completionPercentage}%"></div>
                            </div>
                            ${completionPercentage < 100 ? `<p class="text-sm text-gray-500 mt-3"><a href="/profile/edit" class="text-primary-600 hover:underline font-medium">Compléter votre profil</a></p>` : ''}
                        </div>

                        <!-- Contact Card -->
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-display font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center"><i class="fas fa-address-book text-primary-600 text-sm"></i></span>
                                Contact
                            </h3>
                            <div class="space-y-3">
                                <a href="mailto:${user.email}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <span class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center"><i class="fas fa-envelope text-white"></i></span>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-xs text-gray-500">Email</div>
                                        <div class="text-sm font-semibold text-gray-900 truncate">${user.email}</div>
                                    </div>
                                </a>
                                ${user.phone ? `
                                <a href="tel:${user.phone}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <span class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center"><i class="fas fa-phone text-white"></i></span>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-xs text-gray-500">Téléphone</div>
                                        <div class="text-sm font-semibold text-gray-900">${user.phone}</div>
                                    </div>
                                </a>` : ''}
                                ${user.whatsapp ? `
                                <a href="https://wa.me/${user.whatsapp.replace(/[^0-9]/g, '')}" target="_blank" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <span class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center"><i class="fab fa-whatsapp text-white text-lg"></i></span>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-xs text-gray-500">WhatsApp</div>
                                        <div class="text-sm font-semibold text-gray-900">${user.whatsapp}</div>
                                    </div>
                                </a>` : ''}
                            </div>
                        </div>

                        ${user.linkedin || user.twitter || user.instagram ? `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-display font-bold text-gray-900 mb-4">Réseaux sociaux</h3>
                            <div class="flex gap-3">
                                ${user.linkedin ? `<a href="${user.linkedin}" target="_blank" class="w-11 h-11 bg-blue-700 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform"><i class="fab fa-linkedin-in"></i></a>` : ''}
                                ${user.twitter ? `<a href="${user.twitter}" target="_blank" class="w-11 h-11 bg-sky-500 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform"><i class="fab fa-twitter"></i></a>` : ''}
                                ${user.instagram ? `<a href="${user.instagram}" target="_blank" class="w-11 h-11 bg-gradient-to-br from-pink-500 to-orange-400 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform"><i class="fab fa-instagram"></i></a>` : ''}
                            </div>
                        </div>` : ''}
                    </div>

                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        ${user.bio ? `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-display font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 bg-accent-100 rounded-lg flex items-center justify-center"><i class="fas fa-user text-accent-600 text-sm"></i></span>
                                À propos
                            </h3>
                            <p class="text-gray-600 leading-relaxed">${user.bio}</p>
                        </div>` : ''}

                        ${interests.length > 0 ? `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-display font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center"><i class="fas fa-heart text-pink-600 text-sm"></i></span>
                                Centres d'intérêt
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                ${interests.map(i => `<span class="px-4 py-2 bg-gray-100 hover:bg-primary-600 hover:text-white rounded-full text-sm font-medium text-gray-700 transition-colors cursor-default">${i}</span>`).join('')}
                            </div>
                        </div>` : ''}

                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-display font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center"><i class="fas fa-id-card text-cyan-600 text-sm"></i></span>
                                Informations personnelles
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                ${user.country ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fas fa-globe text-blue-600"></i></span><div><div class="text-xs text-gray-500">Pays</div><div class="font-semibold text-gray-900">${user.country}</div></div></div>` : ''}
                                ${user.nationality ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center"><i class="fas fa-flag text-purple-600"></i></span><div><div class="text-xs text-gray-500">Nationalité</div><div class="font-semibold text-gray-900">${user.nationality}</div></div></div>` : ''}
                                ${user.date_of_birth ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center"><i class="fas fa-birthday-cake text-pink-600"></i></span><div><div class="text-xs text-gray-500">Date de naissance</div><div class="font-semibold text-gray-900">${new Date(user.date_of_birth).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' })}</div></div></div>` : ''}
                                ${user.gender ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center"><i class="fas fa-venus-mars text-green-600"></i></span><div><div class="text-xs text-gray-500">Genre</div><div class="font-semibold text-gray-900">${user.gender === 'male' ? 'Homme' : user.gender === 'female' ? 'Femme' : 'Autre'}</div></div></div>` : ''}
                                ${user.language ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center"><i class="fas fa-language text-yellow-600"></i></span><div><div class="text-xs text-gray-500">Langue</div><div class="font-semibold text-gray-900">${user.language.toUpperCase()}</div></div></div>` : ''}
                            </div>
                        </div>

                        ${user.company || user.position || user.website ? `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-display font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center"><i class="fas fa-briefcase text-orange-600 text-sm"></i></span>
                                Informations professionnelles
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                ${user.company ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center"><i class="fas fa-building text-orange-600"></i></span><div><div class="text-xs text-gray-500">Entreprise</div><div class="font-semibold text-gray-900">${user.company}</div></div></div>` : ''}
                                ${user.position ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg"><span class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center"><i class="fas fa-user-tie text-amber-600"></i></span><div><div class="text-xs text-gray-500">Poste</div><div class="font-semibold text-gray-900">${user.position}</div></div></div>` : ''}
                                ${user.website ? `<div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg sm:col-span-2"><span class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fas fa-globe text-blue-600"></i></span><div class="flex-1 min-w-0"><div class="text-xs text-gray-500">Site web</div><a href="${user.website}" target="_blank" class="font-semibold text-primary-600 hover:underline truncate block">${user.website}</a></div></div>` : ''}
                            </div>
                        </div>` : ''}
                    </div>
                </div>
            `;

            document.getElementById('profile-content').innerHTML = content;
        }

        loadProfile();
    </script>
</body>
</html>
