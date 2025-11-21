<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Travel Express</title>

    <!-- Google Fonts - Premium Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display { font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif; }
        .font-sans { font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes glow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        .slide-in { animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .fade-in { animation: fadeIn 0.4s ease-out; }

        .input-elegant {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .input-elegant:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 113, 227, 0.12);
        }

        .btn-elegant {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 113, 227, 0.3);
        }
        .btn-elegant:active {
            transform: translateY(0);
        }

        /* Animated background blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }
        .blob-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #0071e3, #0077ED);
            top: -200px;
            left: -200px;
            animation-delay: 0s;
        }
        .blob-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #FF9500, #FF6D00);
            bottom: -150px;
            right: -150px;
            animation-delay: 2s;
        }
        .blob-3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #2997FF, #0369a1);
            top: 50%;
            right: -100px;
            animation-delay: 4s;
        }
    </style>
</head>
<body class="font-sans min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden">

    <!-- Animated Background Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
        <div class="w-full max-w-md slide-in">

            <!-- Logo - Matching the header design -->
            <div class="text-center mb-8 fade-in">
                <a href="/" class="inline-flex items-center space-x-3.5 group">
                    <div class="relative">
                        <!-- Glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-accent-500 to-accent-600 rounded-2xl blur-xl opacity-20 group-hover:opacity-40 transition-all duration-500 animate-pulse"></div>
                        <!-- Icon container -->
                        <div class="relative w-16 h-16 bg-gradient-to-br from-primary-600 via-primary-700 to-accent-600 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl shadow-primary-600/20">
                            <svg class="w-9 h-9 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-display font-bold text-dark tracking-tight leading-none group-hover:text-primary-600 transition-colors duration-300" style="letter-spacing: -0.02em;">Travel Express</span>
                        <span class="text-xs font-sans font-bold text-primary-600 tracking-[0.15em] uppercase leading-none mt-1.5 opacity-90">Study Abroad Experts</span>
                    </div>
                </a>
            </div>

            <!-- Login Card -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/5 p-8 border border-white/20 relative overflow-hidden">
                <!-- Card gradient overlay -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-600 via-accent-500 to-accent-600"></div>

                <div class="mb-8">
                    <h2 class="text-3xl font-display font-bold text-dark mb-2" style="letter-spacing: -0.02em;">Connexion</h2>
                    <p class="text-sm text-gray-600 font-medium tracking-wide">Accédez à votre espace personnel</p>
                </div>

                <div id="alert-container" class="mb-5"></div>

                <form id="loginForm" class="space-y-5">
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Adresse e-mail</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input type="email" id="email" required
                                class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                placeholder="votre@email.com">
                        </div>
                        <p class="text-red-600 text-xs mt-2 hidden font-medium" id="email-error"></p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" id="password" required
                                class="w-full pl-12 pr-12 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                placeholder="••••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-600 transition-colors">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-red-600 text-xs mt-2 hidden font-medium" id="password-error"></p>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-2 focus:ring-primary-500 transition-all">
                            <span class="ml-2.5 text-gray-700 font-medium group-hover:text-dark transition-colors">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-bold transition-colors relative group">
                            <span>Mot de passe oublié?</span>
                            <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </a>
                    </div>

                    <button type="submit" id="loginButton"
                        class="w-full py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg flex items-center justify-center space-x-2.5 btn-elegant tracking-wide">
                        <span id="loginButtonText">Se connecter</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Pas encore de compte?
                        <a href="/register" class="text-primary-600 font-bold hover:text-primary-700 transition-colors relative inline-block group">
                            <span>Créer un compte</span>
                            <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </a>
                    </p>
                </div>

                <!-- Divider -->
                <div class="my-8 flex items-center">
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <span class="px-4 text-xs font-semibold text-gray-500 tracking-wider">OU</span>
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-3">
                    <button class="flex items-center justify-center space-x-2 px-4 py-3 bg-white border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:shadow-md transition-all duration-300 group">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-dark transition-colors">Google</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 px-4 py-3 bg-white border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:shadow-md transition-all duration-300 group">
                        <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-dark transition-colors">Facebook</span>
                    </button>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="/" class="inline-flex items-center space-x-2 text-sm text-gray-600 hover:text-dark transition-colors group font-medium">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Retour à l'accueil</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('loginButtonText');
            const alertContainer = document.getElementById('alert-container');

            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));
            alertContainer.innerHTML = '';

            button.disabled = true;
            button.classList.add('opacity-75', 'cursor-not-allowed');
            buttonText.textContent = 'Connexion en cours...';

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));

                    alertContainer.innerHTML = `
                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-green-800 text-sm font-bold">${data.message}</p>
                        </div>
                    `;

                    setTimeout(() => window.location.href = '/', 1200);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const el = document.getElementById(`${key}-error`);
                            if (el) {
                                el.textContent = data.errors[key][0];
                                el.classList.remove('hidden');
                            }
                        });
                    } else if (data.message) {
                        alertContainer.innerHTML = `
                            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-red-800 text-sm font-bold">${data.message}</p>
                            </div>
                        `;
                    }
                }
            } catch (error) {
                alertContainer.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-red-800 text-sm font-bold">Erreur de connexion au serveur</p>
                    </div>
                `;
            } finally {
                button.disabled = false;
                button.classList.remove('opacity-75', 'cursor-not-allowed');
                buttonText.textContent = 'Se connecter';
            }
        });
    </script>
</body>
</html>
