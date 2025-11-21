<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Profil - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .shimmer-effect {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        .progress-ring {
            transition: stroke-dashoffset 1s ease;
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        .interest-badge {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border: 2px solid rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .interest-badge:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
        }

        .timeline-item {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: -4px;
            top: 6px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #667eea;
            border: 3px solid white;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.3);
        }

        .skill-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            position: relative;
        }

        .skill-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 999px;
            transition: width 1.5s ease;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2 text-white hover:text-white/80 transition-colors group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="font-semibold">Retour</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="/profile/edit" class="px-5 py-2.5 bg-white/20 hover:bg-white/30 text-white rounded-xl font-medium transition-all backdrop-blur-sm flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Modifier</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div id="profile-content" class="fade-in-up">
            <!-- Loading state -->
            <div class="text-center text-white py-20">
                <div class="inline-block relative">
                    <div class="w-16 h-16 border-4 border-white/30 border-t-white rounded-full animate-spin"></div>
                </div>
                <p class="mt-6 text-lg font-medium">Chargement de votre profil...</p>
            </div>
        </div>
    </div>

    <script>
        const authToken = localStorage.getItem('auth_token');

        if (!authToken) {
            window.location.href = '/login';
        }

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

        function displayProfile(user) {
            const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase();
            const avatarUrl = user.avatar ? `/storage/${user.avatar}` : null;

            // Calculate profile completion
            const fields = ['name', 'email', 'phone', 'bio', 'country', 'whatsapp', 'date_of_birth', 'gender', 'nationality', 'language', 'interests', 'linkedin', 'twitter', 'instagram', 'company', 'position', 'location', 'website'];
            const filledFields = fields.filter(field => user[field] && user[field] !== '').length;
            const completionPercentage = Math.round((filledFields / fields.length) * 100);

            // Parse interests
            const interests = user.interests ? user.interests.split(',') : [];

            const content = `
                <!-- Main Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Left Column: Profile Card -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Profile Card -->
                        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl">
                            <!-- Gradient Header -->
                            <div class="h-32 bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 relative overflow-hidden">
                                <div class="absolute inset-0 shimmer-effect"></div>
                            </div>

                            <div class="px-6 pb-6">
                                <!-- Avatar -->
                                <div class="relative -mt-16 mb-4 flex justify-center">
                                    ${avatarUrl ?
                                        `<img src="${avatarUrl}" alt="${user.name}" class="w-32 h-32 rounded-3xl border-4 border-white shadow-2xl object-cover">` :
                                        `<div class="w-32 h-32 rounded-3xl border-4 border-white shadow-2xl bg-gradient-to-br from-violet-600 to-indigo-600 flex items-center justify-center">
                                            <span class="text-4xl font-bold text-white">${initials}</span>
                                        </div>`
                                    }
                                    <div class="absolute bottom-0 right-1/2 translate-x-12 w-10 h-10 bg-green-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                </div>

                                <!-- Name & Title -->
                                <div class="text-center mb-6">
                                    <h1 class="text-2xl font-bold text-gray-900 mb-1">${user.name}</h1>
                                    ${user.position ? `<p class="text-sm text-gray-600 font-medium">${user.position}</p>` : ''}
                                    ${user.location ? `
                                        <div class="flex items-center justify-center text-gray-500 space-x-1 mt-2">
                                            <i class="fas fa-map-marker-alt text-xs"></i>
                                            <span class="text-sm">${user.location}</span>
                                        </div>
                                    ` : ''}
                                </div>

                                <!-- Profile Completion -->
                                <div class="mb-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold text-gray-700">Profil complété</span>
                                        <span class="text-sm font-bold bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent">${completionPercentage}%</span>
                                    </div>
                                    <div class="skill-bar">
                                        <div class="skill-bar-fill" style="width: ${completionPercentage}%"></div>
                                    </div>
                                </div>

                                <!-- Quick Stats -->
                                <div class="grid grid-cols-3 gap-3 mb-6">
                                    <div class="text-center p-3 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                                        <div class="text-xl font-bold text-blue-600">${filledFields}</div>
                                        <div class="text-xs text-blue-600 font-medium mt-1">Infos</div>
                                    </div>
                                    <div class="text-center p-3 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl">
                                        <div class="text-xl font-bold text-purple-600">${interests.length}</div>
                                        <div class="text-xs text-purple-600 font-medium mt-1">Intérêts</div>
                                    </div>
                                    <div class="text-center p-3 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                                        <div class="text-xl font-bold text-green-600"><i class="fas fa-check"></i></div>
                                        <div class="text-xs text-green-600 font-medium mt-1">Actif</div>
                                    </div>
                                </div>

                                <!-- Social Links -->
                                ${user.linkedin || user.twitter || user.instagram ? `
                                    <div class="border-t border-gray-100 pt-4">
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Réseaux sociaux</p>
                                        <div class="flex justify-center space-x-3">
                                            ${user.linkedin ? `
                                                <a href="${user.linkedin}" target="_blank" class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white social-icon shadow-lg">
                                                    <i class="fab fa-linkedin-in text-lg"></i>
                                                </a>
                                            ` : ''}
                                            ${user.twitter ? `
                                                <a href="${user.twitter}" target="_blank" class="w-12 h-12 rounded-xl bg-gradient-to-br from-sky-400 to-blue-500 flex items-center justify-center text-white social-icon shadow-lg">
                                                    <i class="fab fa-twitter text-lg"></i>
                                                </a>
                                            ` : ''}
                                            ${user.instagram ? `
                                                <a href="${user.instagram}" target="_blank" class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center text-white social-icon shadow-lg">
                                                    <i class="fab fa-instagram text-lg"></i>
                                                </a>
                                            ` : ''}
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>

                        <!-- Quick Contact Card -->
                        <div class="glass-card rounded-2xl p-6 shadow-lg">
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">Contact rapide</h3>
                            <div class="space-y-3">
                                <a href="mailto:${user.email}" class="flex items-center space-x-3 p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500 font-medium">Email</p>
                                        <p class="text-sm font-semibold text-gray-900 truncate">${user.email}</p>
                                    </div>
                                </a>

                                ${user.phone ? `
                                    <a href="tel:${user.phone}" class="flex items-center space-x-3 p-3 bg-green-50 rounded-xl hover:bg-green-100 transition-colors">
                                        <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-phone text-white"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 font-medium">Téléphone</p>
                                            <p class="text-sm font-semibold text-gray-900">${user.phone}</p>
                                        </div>
                                    </a>
                                ` : ''}

                                ${user.whatsapp ? `
                                    <a href="https://wa.me/${user.whatsapp.replace(/[^0-9]/g, '')}" target="_blank" class="flex items-center space-x-3 p-3 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition-colors">
                                        <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
                                            <i class="fab fa-whatsapp text-white"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 font-medium">WhatsApp</p>
                                            <p class="text-sm font-semibold text-gray-900">${user.whatsapp}</p>
                                        </div>
                                    </a>
                                ` : ''}
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Details -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Bio Section -->
                        ${user.bio ? `
                            <div class="glass-card rounded-2xl p-6 shadow-lg">
                                <div class="flex items-center space-x-2 mb-4">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-900">À propos</h2>
                                </div>
                                <p class="text-gray-700 leading-relaxed">${user.bio}</p>
                            </div>
                        ` : ''}

                        <!-- Interests Section -->
                        ${interests.length > 0 ? `
                            <div class="glass-card rounded-2xl p-6 shadow-lg">
                                <div class="flex items-center space-x-2 mb-4">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center">
                                        <i class="fas fa-heart text-white text-sm"></i>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-900">Centres d'intérêt</h2>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    ${interests.map(interest => `
                                        <span class="interest-badge px-4 py-2 rounded-xl text-sm font-medium">${interest.trim()}</span>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}

                        <!-- Personal Information -->
                        <div class="glass-card rounded-2xl p-6 shadow-lg">
                            <div class="flex items-center space-x-2 mb-6">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                                    <i class="fas fa-id-card text-white text-sm"></i>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900">Informations personnelles</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                ${user.country ? `
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-globe text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Pays</p>
                                            <p class="text-sm font-semibold text-gray-900">${user.country}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.nationality ? `
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-flag text-purple-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Nationalité</p>
                                            <p class="text-sm font-semibold text-gray-900">${user.nationality}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.date_of_birth ? `
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-pink-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-birthday-cake text-pink-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Date de naissance</p>
                                            <p class="text-sm font-semibold text-gray-900">${new Date(user.date_of_birth).toLocaleDateString('fr-FR')}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.gender ? `
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-venus-mars text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Genre</p>
                                            <p class="text-sm font-semibold text-gray-900 capitalize">${user.gender === 'male' ? 'Homme' : user.gender === 'female' ? 'Femme' : 'Autre'}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.language ? `
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-language text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Langue</p>
                                            <p class="text-sm font-semibold text-gray-900">${user.language.toUpperCase()}</p>
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>

                        <!-- Professional Information -->
                        ${user.company || user.position || user.website ? `
                            <div class="glass-card rounded-2xl p-6 shadow-lg">
                                <div class="flex items-center space-x-2 mb-6">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                                        <i class="fas fa-briefcase text-white text-sm"></i>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-900">Informations professionnelles</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    ${user.company ? `
                                        <div class="flex items-start space-x-3">
                                            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-building text-orange-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 font-medium">Entreprise</p>
                                                <p class="text-sm font-semibold text-gray-900">${user.company}</p>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.position ? `
                                        <div class="flex items-start space-x-3">
                                            <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-user-tie text-yellow-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 font-medium">Poste</p>
                                                <p class="text-sm font-semibold text-gray-900">${user.position}</p>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.website ? `
                                        <div class="flex items-start space-x-3 md:col-span-2">
                                            <div class="w-10 h-10 rounded-lg bg-violet-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-globe text-violet-600"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-gray-500 font-medium">Site web</p>
                                                <a href="${user.website}" target="_blank" class="text-sm font-semibold text-violet-600 hover:text-violet-700 truncate block">${user.website}</a>
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        ` : ''}

                    </div>
                </div>
            `;

            document.getElementById('profile-content').innerHTML = content;
        }

        loadProfile();
    </script>
</body>
</html>
