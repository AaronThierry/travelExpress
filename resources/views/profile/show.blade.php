<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Profil - Travel Express</title>
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

        /* Glass morphism cards */
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

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.3); }
            50% { box-shadow: 0 0 40px rgba(139, 92, 246, 0.6); }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes borderGlow {
            0%, 100% { border-color: rgba(139, 92, 246, 0.5); }
            50% { border-color: rgba(236, 72, 153, 0.5); }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* Profile card styles */
        .profile-card {
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            z-index: 0;
        }

        .avatar-ring {
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb, #667eea);
            background-size: 300% 300%;
            animation: borderGlow 4s ease infinite, shimmer 3s linear infinite;
            padding: 4px;
            border-radius: 9999px;
        }

        .avatar-container {
            position: relative;
        }

        .avatar-container::after {
            content: '';
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            border: 3px solid white;
            z-index: 10;
        }

        /* Stats cards */
        .stat-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            background: linear-gradient(135deg, rgba(139,92,246,0.2) 0%, rgba(236,72,153,0.1) 100%);
            border-color: rgba(139,92,246,0.3);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.2);
        }

        /* Info cards */
        .info-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(139, 92, 246, 0.3);
            transform: translateX(8px);
        }

        /* Interest badges */
        .interest-badge {
            background: linear-gradient(135deg, rgba(139,92,246,0.15) 0%, rgba(236,72,153,0.15) 100%);
            border: 1px solid rgba(139,92,246,0.3);
            transition: all 0.3s ease;
        }

        .interest-badge:hover {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
        }

        /* Social buttons */
        .social-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-btn:hover {
            transform: translateY(-6px) rotate(5deg);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        /* Contact cards */
        .contact-card {
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: scale(1.02);
        }

        /* Progress bar */
        .progress-bar {
            background: rgba(255,255,255,0.1);
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            background: linear-gradient(90deg, #8b5cf6, #ec4899, #8b5cf6);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Section headers */
        .section-header {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            border-radius: 2px;
        }

        /* Floating elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .floating-delay {
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
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

        /* Loading spinner */
        .loader {
            width: 60px;
            height: 60px;
            border: 3px solid rgba(255,255,255,0.1);
            border-top-color: #8b5cf6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-3 text-white/80 hover:text-white transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-pink-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-arrow-left text-white"></i>
                    </div>
                    <span class="font-semibold hidden sm:block">Retour</span>
                </a>

                <div class="flex items-center space-x-3">
                    <a href="/profile/edit" class="px-6 py-2.5 bg-gradient-to-r from-violet-600 to-pink-600 hover:from-violet-500 hover:to-pink-500 text-white rounded-xl font-semibold transition-all hover:scale-105 hover:shadow-lg hover:shadow-purple-500/25 flex items-center space-x-2">
                        <i class="fas fa-pen"></i>
                        <span>Modifier</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="relative z-10 max-w-7xl mx-auto px-4 pt-24 pb-12">
        <div id="profile-content">
            <!-- Loading state -->
            <div class="flex flex-col items-center justify-center min-h-[60vh]">
                <div class="loader mb-6"></div>
                <p class="text-white/60 text-lg font-medium">Chargement de votre profil...</p>
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
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                    <!-- Left Column -->
                    <div class="lg:col-span-4 space-y-6">

                        <!-- Profile Card -->
                        <div class="glass-light rounded-3xl overflow-hidden shadow-2xl fade-in-up profile-card">
                            <div class="relative pt-24 pb-6 px-6">
                                <!-- Avatar -->
                                <div class="absolute left-1/2 -translate-x-1/2 -top-0 translate-y-8 avatar-container">
                                    <div class="avatar-ring">
                                        ${avatarUrl ?
                                            `<img src="${avatarUrl}" alt="${user.name}" class="w-32 h-32 rounded-full object-cover">` :
                                            `<div class="w-32 h-32 rounded-full bg-gradient-to-br from-violet-600 via-purple-600 to-pink-600 flex items-center justify-center">
                                                <span class="text-4xl font-bold text-white">${initials}</span>
                                            </div>`
                                        }
                                    </div>
                                </div>

                                <div class="pt-16 text-center">
                                    <h1 class="text-2xl font-bold text-gray-900 mb-1">${user.name}</h1>
                                    ${user.position ? `<p class="text-violet-600 font-medium">${user.position}</p>` : ''}
                                    ${user.location ? `
                                        <div class="flex items-center justify-center text-gray-500 mt-2 space-x-1">
                                            <i class="fas fa-map-marker-alt text-pink-500"></i>
                                            <span class="text-sm">${user.location}</span>
                                        </div>
                                    ` : ''}

                                    <!-- Profile Completion -->
                                    <div class="mt-6 px-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-600">Profil complété</span>
                                            <span class="text-sm font-bold bg-gradient-to-r from-violet-600 to-pink-600 bg-clip-text text-transparent">${completionPercentage}%</span>
                                        </div>
                                        <div class="progress-bar h-2 rounded-full">
                                            <div class="progress-fill h-full rounded-full" style="width: ${completionPercentage}%"></div>
                                        </div>
                                    </div>

                                    <!-- Social Links -->
                                    ${user.linkedin || user.twitter || user.instagram ? `
                                        <div class="flex justify-center space-x-3 mt-6">
                                            ${user.linkedin ? `
                                                <a href="${user.linkedin}" target="_blank" class="social-btn w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white shadow-lg">
                                                    <i class="fab fa-linkedin-in text-lg"></i>
                                                </a>
                                            ` : ''}
                                            ${user.twitter ? `
                                                <a href="${user.twitter}" target="_blank" class="social-btn w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-400 to-blue-500 flex items-center justify-center text-white shadow-lg">
                                                    <i class="fab fa-twitter text-lg"></i>
                                                </a>
                                            ` : ''}
                                            ${user.instagram ? `
                                                <a href="${user.instagram}" target="_blank" class="social-btn w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-500 via-purple-500 to-orange-400 flex items-center justify-center text-white shadow-lg">
                                                    <i class="fab fa-instagram text-lg"></i>
                                                </a>
                                            ` : ''}
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-3 gap-3 fade-in-up delay-1">
                            <div class="stat-card rounded-2xl p-4 text-center">
                                <div class="text-2xl font-bold text-white mb-1">${filledFields}</div>
                                <div class="text-xs text-white/60 font-medium">Infos</div>
                            </div>
                            <div class="stat-card rounded-2xl p-4 text-center">
                                <div class="text-2xl font-bold text-white mb-1">${interests.length}</div>
                                <div class="text-xs text-white/60 font-medium">Intérêts</div>
                            </div>
                            <div class="stat-card rounded-2xl p-4 text-center">
                                <div class="text-2xl font-bold text-emerald-400 mb-1"><i class="fas fa-check-circle"></i></div>
                                <div class="text-xs text-white/60 font-medium">Actif</div>
                            </div>
                        </div>

                        <!-- Contact Card -->
                        <div class="glass rounded-2xl p-6 fade-in-up delay-2">
                            <h3 class="text-white font-bold mb-4 flex items-center space-x-2">
                                <i class="fas fa-address-book text-violet-400"></i>
                                <span>Contact</span>
                            </h3>
                            <div class="space-y-3">
                                <a href="mailto:${user.email}" class="contact-card flex items-center space-x-3 p-3 rounded-xl bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-white/50">Email</p>
                                        <p class="text-sm font-medium text-white truncate">${user.email}</p>
                                    </div>
                                </a>

                                ${user.phone ? `
                                    <a href="tel:${user.phone}" class="contact-card flex items-center space-x-3 p-3 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-phone text-white"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-white/50">Téléphone</p>
                                            <p class="text-sm font-medium text-white">${user.phone}</p>
                                        </div>
                                    </a>
                                ` : ''}

                                ${user.whatsapp ? `
                                    <a href="https://wa.me/${user.whatsapp.replace(/[^0-9]/g, '')}" target="_blank" class="contact-card flex items-center space-x-3 p-3 rounded-xl bg-green-500/10 hover:bg-green-500/20 border border-green-500/20">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center flex-shrink-0">
                                            <i class="fab fa-whatsapp text-white text-lg"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-white/50">WhatsApp</p>
                                            <p class="text-sm font-medium text-white">${user.whatsapp}</p>
                                        </div>
                                    </a>
                                ` : ''}
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="lg:col-span-8 space-y-6">

                        <!-- Bio Section -->
                        ${user.bio ? `
                            <div class="glass rounded-2xl p-6 fade-in-up delay-1">
                                <h2 class="section-header text-lg font-bold text-white mb-6">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-pink-500 flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    À propos
                                </h2>
                                <p class="text-white/80 leading-relaxed mt-4">${user.bio}</p>
                            </div>
                        ` : ''}

                        <!-- Interests Section -->
                        ${interests.length > 0 ? `
                            <div class="glass rounded-2xl p-6 fade-in-up delay-2">
                                <h2 class="section-header text-lg font-bold text-white mb-6">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center">
                                        <i class="fas fa-heart text-white"></i>
                                    </div>
                                    Centres d'intérêt
                                </h2>
                                <div class="flex flex-wrap gap-3 mt-4">
                                    ${interests.map(interest => `
                                        <span class="interest-badge px-4 py-2 rounded-xl text-sm font-medium text-white/90 cursor-pointer">${interest.trim()}</span>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}

                        <!-- Personal Information -->
                        <div class="glass rounded-2xl p-6 fade-in-up delay-3">
                            <h2 class="section-header text-lg font-bold text-white mb-6">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center">
                                    <i class="fas fa-id-card text-white"></i>
                                </div>
                                Informations personnelles
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                ${user.country ? `
                                    <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-globe text-blue-400 text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white/50 font-medium">Pays</p>
                                            <p class="text-white font-semibold">${user.country}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.nationality ? `
                                    <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                        <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-flag text-purple-400 text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white/50 font-medium">Nationalité</p>
                                            <p class="text-white font-semibold">${user.nationality}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.date_of_birth ? `
                                    <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                        <div class="w-12 h-12 rounded-xl bg-pink-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-birthday-cake text-pink-400 text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white/50 font-medium">Date de naissance</p>
                                            <p class="text-white font-semibold">${new Date(user.date_of_birth).toLocaleDateString('fr-FR')}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.gender ? `
                                    <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                        <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-venus-mars text-indigo-400 text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white/50 font-medium">Genre</p>
                                            <p class="text-white font-semibold">${user.gender === 'male' ? 'Homme' : user.gender === 'female' ? 'Femme' : 'Autre'}</p>
                                        </div>
                                    </div>
                                ` : ''}

                                ${user.language ? `
                                    <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                        <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-language text-green-400 text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white/50 font-medium">Langue</p>
                                            <p class="text-white font-semibold">${user.language.toUpperCase()}</p>
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>

                        <!-- Professional Information -->
                        ${user.company || user.position || user.website ? `
                            <div class="glass rounded-2xl p-6 fade-in-up delay-4">
                                <h2 class="section-header text-lg font-bold text-white mb-6">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center">
                                        <i class="fas fa-briefcase text-white"></i>
                                    </div>
                                    Informations professionnelles
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    ${user.company ? `
                                        <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                            <div class="w-12 h-12 rounded-xl bg-orange-500/20 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-building text-orange-400 text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-white/50 font-medium">Entreprise</p>
                                                <p class="text-white font-semibold">${user.company}</p>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.position ? `
                                        <div class="info-card flex items-center space-x-4 p-4 rounded-xl">
                                            <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-user-tie text-amber-400 text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-white/50 font-medium">Poste</p>
                                                <p class="text-white font-semibold">${user.position}</p>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.website ? `
                                        <div class="info-card flex items-center space-x-4 p-4 rounded-xl md:col-span-2">
                                            <div class="w-12 h-12 rounded-xl bg-violet-500/20 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-globe text-violet-400 text-lg"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-white/50 font-medium">Site web</p>
                                                <a href="${user.website}" target="_blank" class="text-violet-400 hover:text-violet-300 font-semibold truncate block transition-colors">${user.website}</a>
                                            </div>
                                            <a href="${user.website}" target="_blank" class="w-10 h-10 rounded-xl bg-violet-500/20 hover:bg-violet-500/40 flex items-center justify-center transition-colors">
                                                <i class="fas fa-external-link-alt text-violet-400"></i>
                                            </a>
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
