<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.01em;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in { animation: slideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .fade-in { animation: fadeIn 0.3s ease-out; }
        .slide-down { animation: slideDown 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .input-focus { transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .btn-hover { transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        .btn-hover:active {
            transform: translateY(0);
        }
        .logo-hover { transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .logo-hover:hover {
            transform: scale(1.05) rotate(5deg);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">

    <div class="min-h-screen flex items-center justify-center p-4 py-8">
        <div class="w-full max-w-sm slide-in">
            <div class="text-center mb-6 fade-in">
                <a href="/" class="inline-flex items-center space-x-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-violet-600 rounded-lg flex items-center justify-center logo-hover">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Travel Express</h1>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                <div class="mb-5">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Créer un compte</h2>
                    <p class="text-sm text-gray-500">Rejoignez Travel Express</p>
                </div>

                <div id="alert-container" class="mb-3"></div>

                <form id="registerForm" class="space-y-3.5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nom complet</label>
                        <input type="text" id="name" required
                            class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none text-gray-900 input-focus"
                            placeholder="Jean Dupont">
                        <p class="text-red-600 text-xs mt-1 hidden slide-down" id="name-error"></p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Email</label>
                        <input type="email" id="email" required
                            class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none text-gray-900 input-focus"
                            placeholder="votre@email.com">
                        <p class="text-red-600 text-xs mt-1 hidden slide-down" id="email-error"></p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Mot de passe</label>
                        <div class="relative">
                            <input type="password" id="password" required
                                class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none text-gray-900 pr-10 input-focus"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors">
                                <svg id="eye-password" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Min. 8 caractères</p>
                        <p class="text-red-600 text-xs mt-1 hidden slide-down" id="password-error"></p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Confirmer mot de passe</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" required
                                class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none text-gray-900 pr-10 input-focus"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors">
                                <svg id="eye-password_confirmation" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-red-600 text-xs mt-1 hidden slide-down" id="password_confirmation-error"></p>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="terms" required class="w-3.5 h-3.5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 mt-0.5">
                        <label for="terms" class="ml-2 text-xs text-gray-600">
                            J'accepte les <a href="#" class="text-blue-600 font-semibold hover:underline">conditions d'utilisation</a>
                        </label>
                    </div>

                    <button type="submit" id="registerButton"
                        class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-violet-600 text-white text-sm font-semibold rounded-lg shadow-md flex items-center justify-center space-x-2 btn-hover">
                        <span id="registerButtonText">Créer mon compte</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>

                <div class="mt-5 text-center">
                    <p class="text-xs text-gray-600">
                        Déjà un compte?
                        <a href="/login" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">Se connecter</a>
                    </p>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="/" class="inline-flex items-center space-x-1.5 text-sm text-white/80 hover:text-white transition-colors group">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Retour</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById('eye-' + fieldId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }

        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = document.getElementById('registerButton');
            const buttonText = document.getElementById('registerButtonText');
            const alertContainer = document.getElementById('alert-container');

            document.querySelectorAll('.text-red-500').forEach(el => el.classList.add('hidden'));
            alertContainer.innerHTML = '';

            if (!document.getElementById('terms').checked) {
                alertContainer.innerHTML = '<div class="bg-red-50 border border-red-200 rounded-lg p-3 flex items-center space-x-2"><svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><p class="text-red-800 text-sm font-medium">Acceptez les conditions</p></div>';
                return;
            }

            button.disabled = true;
            buttonText.textContent = 'Inscription...';

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                        password_confirmation: document.getElementById('password_confirmation').value,
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    alertContainer.innerHTML = '<div class="bg-green-50 border border-green-200 rounded-lg p-3 flex items-center space-x-2"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><p class="text-green-800 text-sm font-medium">' + data.message + '</p></div>';
                    setTimeout(() => window.location.href = '/', 1000);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const el = document.getElementById(key + '-error');
                            if (el) { el.textContent = data.errors[key][0]; el.classList.remove('hidden'); }
                        });
                    }
                }
            } catch (error) {
                alertContainer.innerHTML = '<div class="bg-red-50 border border-red-200 rounded-lg p-3"><p class="text-red-800 text-sm font-medium">Erreur d\'inscription</p></div>';
            } finally {
                button.disabled = false;
                buttonText.textContent = 'Créer mon compte';
            }
        });
    </script>
</body>
</html>
