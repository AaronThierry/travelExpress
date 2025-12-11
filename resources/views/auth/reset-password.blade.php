<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe - Travel Express</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-block">
                <span class="text-3xl font-bold text-white">Travel<span class="text-orange-500">Express</span></span>
            </a>
        </div>

        <!-- Invalid Token Message -->
        <div id="invalid-token-card" class="hidden bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Lien invalide ou expiré</h1>
                <p class="text-gray-400 text-sm mb-6" id="invalid-message">Ce lien de réinitialisation n'est plus valide. Veuillez en demander un nouveau.</p>
                <a href="/forgot-password" class="inline-block py-3 px-6 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg transition duration-300">
                    Demander un nouveau lien
                </a>
            </div>
        </div>

        <!-- Reset Form Card -->
        <div id="reset-card" class="hidden bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-orange-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Nouveau mot de passe</h1>
                <p class="text-gray-400 text-sm">Créez un nouveau mot de passe sécurisé pour votre compte.</p>
            </div>

            <!-- Success Message -->
            <div id="success-message" class="hidden mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-green-400 text-sm" id="success-text"></p>
                </div>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="hidden mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-400 text-sm" id="error-text"></p>
                </div>
            </div>

            <!-- Form -->
            <form id="reset-password-form" class="space-y-5">
                @csrf
                <input type="hidden" id="token" name="token">
                <input type="hidden" id="email" name="email">

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Nouveau mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full pl-10 pr-12 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                            placeholder="Minimum 8 caractères">
                        <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="password-eye" class="h-5 w-5 text-gray-500 hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirmer le mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                            class="w-full pl-10 pr-12 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                            placeholder="Confirmez votre mot de passe">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="password_confirmation-eye" class="h-5 w-5 text-gray-500 hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password strength indicator -->
                <div class="space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Force du mot de passe</span>
                        <span id="strength-text" class="text-gray-400">-</span>
                    </div>
                    <div class="h-2 bg-white/10 rounded-full overflow-hidden">
                        <div id="strength-bar" class="h-full w-0 transition-all duration-300 rounded-full"></div>
                    </div>
                </div>

                <button type="submit" id="submit-btn"
                    class="w-full py-3 px-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-orange-500/25 transition duration-300 flex items-center justify-center">
                    <span id="btn-text">Réinitialiser le mot de passe</span>
                    <svg id="btn-spinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Loading Card -->
        <div id="loading-card" class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">
            <div class="text-center">
                <svg class="animate-spin h-12 w-12 text-orange-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-gray-400">Vérification du lien...</p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-8">
            &copy; {{ date('Y') }} Travel Express. Tous droits réservés.
        </p>
    </div>

    <script>
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');
        const email = urlParams.get('email');

        // DOM elements
        const loadingCard = document.getElementById('loading-card');
        const resetCard = document.getElementById('reset-card');
        const invalidTokenCard = document.getElementById('invalid-token-card');

        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>`;
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            return strength;
        }

        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');

            const levels = [
                { width: '0%', color: 'bg-gray-500', text: '-' },
                { width: '20%', color: 'bg-red-500', text: 'Très faible' },
                { width: '40%', color: 'bg-orange-500', text: 'Faible' },
                { width: '60%', color: 'bg-yellow-500', text: 'Moyen' },
                { width: '80%', color: 'bg-green-400', text: 'Fort' },
                { width: '100%', color: 'bg-green-500', text: 'Très fort' }
            ];

            strengthBar.className = `h-full transition-all duration-300 rounded-full ${levels[strength].color}`;
            strengthBar.style.width = levels[strength].width;
            strengthText.textContent = levels[strength].text;
            strengthText.className = levels[strength].color.replace('bg-', 'text-');
        });

        // Verify token on page load
        async function verifyToken() {
            if (!token || !email) {
                loadingCard.classList.add('hidden');
                invalidTokenCard.classList.remove('hidden');
                document.getElementById('invalid-message').textContent = 'Lien de réinitialisation invalide. Les paramètres sont manquants.';
                return;
            }

            try {
                const response = await fetch('/api/password/verify-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ token, email })
                });

                const data = await response.json();

                loadingCard.classList.add('hidden');

                if (data.success && data.valid) {
                    resetCard.classList.remove('hidden');
                    document.getElementById('token').value = token;
                    document.getElementById('email').value = email;
                } else {
                    invalidTokenCard.classList.remove('hidden');
                    document.getElementById('invalid-message').textContent = data.message || 'Ce lien de réinitialisation n\'est plus valide.';
                }
            } catch (error) {
                loadingCard.classList.add('hidden');
                invalidTokenCard.classList.remove('hidden');
                document.getElementById('invalid-message').textContent = 'Erreur de connexion. Veuillez réessayer.';
            }
        }

        verifyToken();

        // Form submission
        document.getElementById('reset-password-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const successMessage = document.getElementById('success-message');
            const successText = document.getElementById('success-text');
            const errorMessage = document.getElementById('error-message');
            const errorText = document.getElementById('error-text');

            // Validate passwords match
            if (password !== passwordConfirmation) {
                errorText.textContent = 'Les mots de passe ne correspondent pas.';
                errorMessage.classList.remove('hidden');
                return;
            }

            // Hide messages
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            // Show loading
            submitBtn.disabled = true;
            btnText.textContent = 'Réinitialisation...';
            btnSpinner.classList.remove('hidden');

            try {
                const response = await fetch('/api/password/reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        token: document.getElementById('token').value,
                        password,
                        password_confirmation: passwordConfirmation
                    })
                });

                const data = await response.json();

                if (data.success) {
                    successText.textContent = data.message;
                    successMessage.classList.remove('hidden');
                    document.getElementById('reset-password-form').classList.add('hidden');

                    // Redirect to login after 3 seconds
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 3000);
                } else {
                    errorText.textContent = data.message || 'Une erreur est survenue.';
                    errorMessage.classList.remove('hidden');
                }
            } catch (error) {
                errorText.textContent = 'Erreur de connexion. Veuillez réessayer.';
                errorMessage.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Réinitialiser le mot de passe';
                btnSpinner.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
