<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Profil - Travel Express</title>
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
        }

        .font-display { font-family: 'Montserrat', sans-serif; }
        .font-sans { font-family: 'Poppins', sans-serif; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gray-50);
            color: var(--dark);
        }

        /* Smooth animations */
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }

        /* Card styles */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
            border: 1px solid var(--gray-100);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        /* Profile header gradient */
        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 50%, var(--dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(249, 115, 22, 0.1) 100%);
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Avatar styles */
        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            object-fit: cover;
            background: linear-gradient(135deg, var(--primary-light), var(--accent));
        }

        .avatar-initials {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: white;
            font-family: 'Montserrat', sans-serif;
        }

        .status-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
            background: #10b981;
            border: 3px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Info items */
        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            border-radius: 12px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .info-item:hover {
            background: var(--gray-50);
            border-color: var(--gray-200);
        }

        .info-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Tags */
        .tag {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: var(--gray-100);
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            transition: all 0.2s ease;
            border: 1px solid var(--gray-200);
        }

        .tag:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        /* Social buttons */
        .social-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .social-btn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .social-linkedin { background: linear-gradient(135deg, #0077b5, #005885); }
        .social-twitter { background: linear-gradient(135deg, #1da1f2, #0c85d0); }
        .social-instagram { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-whatsapp { background: linear-gradient(135deg, #25d366, #128c7e); }

        /* Progress bar */
        .progress-bar {
            height: 8px;
            background: var(--gray-200);
            border-radius: 100px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 100px;
            transition: width 1s ease-out;
        }

        /* Section title */
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.125rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-title-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Quick contact */
        .contact-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 12px;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .contact-link:hover {
            background: white;
            border-color: var(--primary-light);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1);
        }

        .contact-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
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

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(30, 64, 175, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.35);
        }

        /* Loading */
        .loader {
            width: 48px;
            height: 48px;
            border: 3px solid var(--gray-200);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Stat card */
        .stat-card {
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            background: white;
            border-color: var(--primary-light);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.08);
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-bar sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="nav-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour à l'accueil</span>
                </a>

                <a href="/" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center">
                        <i class="fas fa-globe text-white"></i>
                    </div>
                    <span class="font-display font-bold text-lg text-gray-900 hidden sm:block">Travel Express</span>
                </a>

                <a href="/profile/edit" class="btn-primary">
                    <i class="fas fa-pen"></i>
                    <span class="hidden sm:inline">Modifier</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pb-12">
        <div id="profile-content">
            <!-- Loading State -->
            <div class="flex flex-col items-center justify-center min-h-[60vh]">
                <div class="loader"></div>
                <p class="mt-4 text-gray-500 font-medium">Chargement du profil...</p>
            </div>
        </div>
    </main>

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
            const interests = user.interests ? user.interests.split(',').map(i => i.trim()).filter(i => i) : [];

            const content = `
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                            <!-- Left: Avatar & Basic Info -->
                            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6">
                                <div class="avatar-wrapper fade-in">
                                    ${avatarUrl ?
                                        `<img src="${avatarUrl}" alt="${user.name}" class="avatar">` :
                                        `<div class="avatar-initials">${initials}</div>`
                                    }
                                    <div class="status-badge">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                </div>

                                <div class="text-center sm:text-left pb-2 fade-in stagger-1">
                                    <h1 class="font-display font-bold text-2xl sm:text-3xl text-white mb-1">${user.name}</h1>
                                    ${user.position ? `<p class="text-blue-200 font-medium text-lg">${user.position}</p>` : ''}
                                    ${user.location ? `
                                        <p class="text-white/70 flex items-center justify-center sm:justify-start gap-2 mt-2">
                                            <i class="fas fa-map-marker-alt text-orange-400"></i>
                                            ${user.location}
                                        </p>
                                    ` : ''}
                                </div>
                            </div>

                            <!-- Right: Quick Stats -->
                            <div class="flex gap-4 justify-center lg:justify-end fade-in stagger-2">
                                <div class="text-center px-6 py-3 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                    <div class="font-display font-bold text-2xl text-white">${filledFields}</div>
                                    <div class="text-xs text-blue-200 uppercase tracking-wide">Infos</div>
                                </div>
                                <div class="text-center px-6 py-3 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                    <div class="font-display font-bold text-2xl text-white">${interests.length}</div>
                                    <div class="text-xs text-blue-200 uppercase tracking-wide">Intérêts</div>
                                </div>
                                <div class="text-center px-6 py-3 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                    <div class="font-display font-bold text-2xl text-emerald-400">${completionPercentage}%</div>
                                    <div class="text-xs text-blue-200 uppercase tracking-wide">Complet</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Left Column -->
                        <div class="space-y-6">

                            <!-- Profile Completion Card -->
                            <div class="card p-6 fade-in stagger-1">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="font-semibold text-gray-700">Profil complété</span>
                                    <span class="font-display font-bold text-lg" style="color: var(--primary)">${completionPercentage}%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: ${completionPercentage}%"></div>
                                </div>
                                ${completionPercentage < 100 ? `
                                    <p class="text-sm text-gray-500 mt-3">
                                        <a href="/profile/edit" class="text-blue-600 hover:text-blue-700 font-medium">Compléter votre profil</a> pour une meilleure visibilité
                                    </p>
                                ` : ''}
                            </div>

                            <!-- Contact Card -->
                            <div class="card p-6 fade-in stagger-2">
                                <h3 class="section-title">
                                    <span class="section-title-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8)">
                                        <i class="fas fa-address-book text-sm"></i>
                                    </span>
                                    Contact
                                </h3>

                                <div class="space-y-3">
                                    <a href="mailto:${user.email}" class="contact-link">
                                        <span class="contact-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb)">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <div class="min-w-0 flex-1">
                                            <div class="text-xs text-gray-500 font-medium">Email</div>
                                            <div class="text-sm font-semibold text-gray-900 truncate">${user.email}</div>
                                        </div>
                                    </a>

                                    ${user.phone ? `
                                        <a href="tel:${user.phone}" class="contact-link">
                                            <span class="contact-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-xs text-gray-500 font-medium">Téléphone</div>
                                                <div class="text-sm font-semibold text-gray-900">${user.phone}</div>
                                            </div>
                                        </a>
                                    ` : ''}

                                    ${user.whatsapp ? `
                                        <a href="https://wa.me/${user.whatsapp.replace(/[^0-9]/g, '')}" target="_blank" class="contact-link">
                                            <span class="contact-icon" style="background: linear-gradient(135deg, #25d366, #128c7e)">
                                                <i class="fab fa-whatsapp text-lg"></i>
                                            </span>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-xs text-gray-500 font-medium">WhatsApp</div>
                                                <div class="text-sm font-semibold text-gray-900">${user.whatsapp}</div>
                                            </div>
                                        </a>
                                    ` : ''}
                                </div>
                            </div>

                            <!-- Social Links -->
                            ${user.linkedin || user.twitter || user.instagram ? `
                                <div class="card p-6 fade-in stagger-3">
                                    <h3 class="section-title">
                                        <span class="section-title-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed)">
                                            <i class="fas fa-share-alt text-sm"></i>
                                        </span>
                                        Réseaux sociaux
                                    </h3>

                                    <div class="flex gap-3">
                                        ${user.linkedin ? `
                                            <a href="${user.linkedin}" target="_blank" class="social-btn social-linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        ` : ''}
                                        ${user.twitter ? `
                                            <a href="${user.twitter}" target="_blank" class="social-btn social-twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        ` : ''}
                                        ${user.instagram ? `
                                            <a href="${user.instagram}" target="_blank" class="social-btn social-instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        ` : ''}
                                    </div>
                                </div>
                            ` : ''}
                        </div>

                        <!-- Right Column (2 cols) -->
                        <div class="lg:col-span-2 space-y-6">

                            <!-- Bio Section -->
                            ${user.bio ? `
                                <div class="card p-6 fade-in stagger-1">
                                    <h3 class="section-title">
                                        <span class="section-title-icon" style="background: linear-gradient(135deg, #f97316, #ea580c)">
                                            <i class="fas fa-user text-sm"></i>
                                        </span>
                                        À propos
                                    </h3>
                                    <p class="text-gray-600 leading-relaxed">${user.bio}</p>
                                </div>
                            ` : ''}

                            <!-- Interests -->
                            ${interests.length > 0 ? `
                                <div class="card p-6 fade-in stagger-2">
                                    <h3 class="section-title">
                                        <span class="section-title-icon" style="background: linear-gradient(135deg, #ec4899, #db2777)">
                                            <i class="fas fa-heart text-sm"></i>
                                        </span>
                                        Centres d'intérêt
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        ${interests.map(interest => `
                                            <span class="tag">${interest}</span>
                                        `).join('')}
                                    </div>
                                </div>
                            ` : ''}

                            <!-- Personal Info -->
                            <div class="card p-6 fade-in stagger-3">
                                <h3 class="section-title">
                                    <span class="section-title-icon" style="background: linear-gradient(135deg, #06b6d4, #0891b2)">
                                        <i class="fas fa-id-card text-sm"></i>
                                    </span>
                                    Informations personnelles
                                </h3>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    ${user.country ? `
                                        <div class="info-item">
                                            <span class="info-icon" style="background: #eff6ff; color: #2563eb;">
                                                <i class="fas fa-globe"></i>
                                            </span>
                                            <div>
                                                <div class="text-xs text-gray-500 font-medium">Pays</div>
                                                <div class="font-semibold text-gray-900">${user.country}</div>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.nationality ? `
                                        <div class="info-item">
                                            <span class="info-icon" style="background: #faf5ff; color: #7c3aed;">
                                                <i class="fas fa-flag"></i>
                                            </span>
                                            <div>
                                                <div class="text-xs text-gray-500 font-medium">Nationalité</div>
                                                <div class="font-semibold text-gray-900">${user.nationality}</div>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.date_of_birth ? `
                                        <div class="info-item">
                                            <span class="info-icon" style="background: #fdf2f8; color: #db2777;">
                                                <i class="fas fa-birthday-cake"></i>
                                            </span>
                                            <div>
                                                <div class="text-xs text-gray-500 font-medium">Date de naissance</div>
                                                <div class="font-semibold text-gray-900">${new Date(user.date_of_birth).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.gender ? `
                                        <div class="info-item">
                                            <span class="info-icon" style="background: #f0fdf4; color: #16a34a;">
                                                <i class="fas fa-venus-mars"></i>
                                            </span>
                                            <div>
                                                <div class="text-xs text-gray-500 font-medium">Genre</div>
                                                <div class="font-semibold text-gray-900">${user.gender === 'male' ? 'Homme' : user.gender === 'female' ? 'Femme' : 'Autre'}</div>
                                            </div>
                                        </div>
                                    ` : ''}

                                    ${user.language ? `
                                        <div class="info-item">
                                            <span class="info-icon" style="background: #fefce8; color: #ca8a04;">
                                                <i class="fas fa-language"></i>
                                            </span>
                                            <div>
                                                <div class="text-xs text-gray-500 font-medium">Langue</div>
                                                <div class="font-semibold text-gray-900">${user.language.toUpperCase()}</div>
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>

                            <!-- Professional Info -->
                            ${user.company || user.position || user.website ? `
                                <div class="card p-6 fade-in stagger-4">
                                    <h3 class="section-title">
                                        <span class="section-title-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706)">
                                            <i class="fas fa-briefcase text-sm"></i>
                                        </span>
                                        Informations professionnelles
                                    </h3>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        ${user.company ? `
                                            <div class="info-item">
                                                <span class="info-icon" style="background: #fff7ed; color: #ea580c;">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                                <div>
                                                    <div class="text-xs text-gray-500 font-medium">Entreprise</div>
                                                    <div class="font-semibold text-gray-900">${user.company}</div>
                                                </div>
                                            </div>
                                        ` : ''}

                                        ${user.position ? `
                                            <div class="info-item">
                                                <span class="info-icon" style="background: #fefce8; color: #ca8a04;">
                                                    <i class="fas fa-user-tie"></i>
                                                </span>
                                                <div>
                                                    <div class="text-xs text-gray-500 font-medium">Poste</div>
                                                    <div class="font-semibold text-gray-900">${user.position}</div>
                                                </div>
                                            </div>
                                        ` : ''}

                                        ${user.website ? `
                                            <div class="info-item sm:col-span-2">
                                                <span class="info-icon" style="background: #eff6ff; color: #2563eb;">
                                                    <i class="fas fa-globe"></i>
                                                </span>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-xs text-gray-500 font-medium">Site web</div>
                                                    <a href="${user.website}" target="_blank" class="font-semibold text-blue-600 hover:text-blue-700 truncate block">${user.website}</a>
                                                </div>
                                                <a href="${user.website}" target="_blank" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600 transition-colors">
                                                    <i class="fas fa-external-link-alt text-sm"></i>
                                                </a>
                                            </div>
                                        ` : ''}
                                    </div>
                                </div>
                            ` : ''}

                        </div>
                    </div>
                </div>
            `;

            document.getElementById('profile-content').innerHTML = content;
        }

        loadProfile();
    </script>
</body>
</html>
