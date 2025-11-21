<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Travel Express</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .step-indicator {
            position: relative;
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
        }

        .step {
            position: relative;
            flex: 1;
            text-align: center;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: 700;
            font-size: 1.125rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .step.active .step-circle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transform: scale(1.1);
        }

        .step.completed .step-circle {
            background: #10b981;
            color: white;
        }

        .step-line {
            position: absolute;
            top: 25px;
            left: 50%;
            right: -50%;
            height: 3px;
            background: #e5e7eb;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .step.completed .step-line {
            background: #10b981;
        }

        .step:last-child .step-line {
            display: none;
        }

        .form-step {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
            background: white;
        }

        .input-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        .gender-option {
            flex: 1;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            background: white;
        }

        .gender-option:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .gender-option.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .interest-tag {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            background: #f3f4f6;
            border: 2px solid #e5e7eb;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .interest-tag:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .interest-tag.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #667eea;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        .progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: width 0.5s ease;
            border-radius: 999px;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="w-full max-w-3xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Créez votre compte</h1>
            <p class="text-white text-opacity-90">Rejoignez Travel Express en quelques étapes simples</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-bar-fill" id="progressBar" style="width: 25%"></div>
            </div>

            <!-- Step Indicators -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-circle">1</div>
                    <div class="step-line"></div>
                    <div class="text-sm font-medium">Compte</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-circle">2</div>
                    <div class="step-line"></div>
                    <div class="text-sm font-medium">Personnel</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-circle">3</div>
                    <div class="step-line"></div>
                    <div class="text-sm font-medium">Social</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-circle">4</div>
                    <div class="text-sm font-medium">Intérêts</div>
                </div>
            </div>

            <!-- Form -->
            <form id="registrationForm">
                <!-- Step 1: Account Info -->
                <div class="form-step active" data-step="1">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Informations du compte</h2>

                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="name" placeholder="Nom complet" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" placeholder="Adresse email" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="button" class="btn-primary" onclick="nextStep()">
                            Suivant <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Personal Info -->
                <div class="form-step" data-step="2">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Informations personnelles</h2>

                    <div class="input-group">
                        <i class="fas fa-globe input-icon"></i>
                        <select name="country" required>
                            <option value="">Sélectionnez votre pays</option>
                            <option value="FR">🇫🇷 France</option>
                            <option value="BE">🇧🇪 Belgique</option>
                            <option value="CH">🇨🇭 Suisse</option>
                            <option value="CA">🇨🇦 Canada</option>
                            <option value="MA">🇲🇦 Maroc</option>
                            <option value="TN">🇹🇳 Tunisie</option>
                            <option value="DZ">🇩🇿 Algérie</option>
                            <option value="SN">🇸🇳 Sénégal</option>
                            <option value="CI">🇨🇮 Côte d'Ivoire</option>
                            <option value="US">🇺🇸 États-Unis</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-flag input-icon"></i>
                        <input type="text" name="nationality" placeholder="Nationalité">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-whatsapp input-icon"></i>
                        <input type="tel" name="whatsapp" placeholder="Numéro WhatsApp (ex: +33 6 12 34 56 78)">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="tel" name="phone" placeholder="Téléphone">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-calendar input-icon"></i>
                        <input type="date" name="date_of_birth" placeholder="Date de naissance">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Genre</label>
                        <div class="flex gap-3">
                            <div class="gender-option" data-gender="male">
                                <i class="fas fa-mars text-2xl mb-2"></i>
                                <div class="font-medium">Homme</div>
                            </div>
                            <div class="gender-option" data-gender="female">
                                <i class="fas fa-venus text-2xl mb-2"></i>
                                <div class="font-medium">Femme</div>
                            </div>
                            <div class="gender-option" data-gender="other">
                                <i class="fas fa-genderless text-2xl mb-2"></i>
                                <div class="font-medium">Autre</div>
                            </div>
                        </div>
                        <input type="hidden" name="gender" id="genderInput">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-language input-icon"></i>
                        <select name="language">
                            <option value="fr">Français</option>
                            <option value="en">English</option>
                            <option value="es">Español</option>
                            <option value="de">Deutsch</option>
                            <option value="ar">العربية</option>
                        </select>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" class="btn-secondary" onclick="prevStep()">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button type="button" class="btn-primary" onclick="nextStep()">
                            Suivant <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Social & Professional -->
                <div class="form-step" data-step="3">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Réseaux sociaux & Professionnel</h2>

                    <div class="input-group">
                        <i class="fas fa-building input-icon"></i>
                        <input type="text" name="company" placeholder="Entreprise">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-briefcase input-icon"></i>
                        <input type="text" name="position" placeholder="Poste">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <input type="text" name="location" placeholder="Ville">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-linkedin input-icon"></i>
                        <input type="url" name="linkedin" placeholder="Profil LinkedIn (https://linkedin.com/in/...)">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-twitter input-icon"></i>
                        <input type="url" name="twitter" placeholder="Profil Twitter (https://twitter.com/...)">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-instagram input-icon"></i>
                        <input type="url" name="instagram" placeholder="Profil Instagram (https://instagram.com/...)">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-globe input-icon"></i>
                        <input type="url" name="website" placeholder="Site web personnel">
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" class="btn-secondary" onclick="prevStep()">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button type="button" class="btn-primary" onclick="nextStep()">
                            Suivant <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Interests & Bio -->
                <div class="form-step" data-step="4">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Centres d'intérêt</h2>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Sélectionnez vos intérêts</label>
                        <div id="interestsContainer" class="p-4 bg-gray-50 rounded-xl">
                            <span class="interest-tag" data-interest="Voyages">✈️ Voyages</span>
                            <span class="interest-tag" data-interest="Photographie">📷 Photographie</span>
                            <span class="interest-tag" data-interest="Gastronomie">🍽️ Gastronomie</span>
                            <span class="interest-tag" data-interest="Sport">⚽ Sport</span>
                            <span class="interest-tag" data-interest="Culture">🎭 Culture</span>
                            <span class="interest-tag" data-interest="Nature">🌿 Nature</span>
                            <span class="interest-tag" data-interest="Aventure">🏔️ Aventure</span>
                            <span class="interest-tag" data-interest="Plage">🏖️ Plage</span>
                            <span class="interest-tag" data-interest="Histoire">📚 Histoire</span>
                            <span class="interest-tag" data-interest="Art">🎨 Art</span>
                            <span class="interest-tag" data-interest="Musique">🎵 Musique</span>
                            <span class="interest-tag" data-interest="Technologie">💻 Technologie</span>
                        </div>
                        <input type="hidden" name="interests" id="interestsInput">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-pen input-icon" style="top: 1.5rem;"></i>
                        <textarea name="bio" placeholder="Parlez-nous de vous... (optionnel)" maxlength="500"></textarea>
                        <div class="text-right text-sm text-gray-500 mt-1">
                            <span id="bioCount">0</span>/500 caractères
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-violet-50 to-purple-50 border-2 border-violet-200 rounded-xl p-4 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-violet-600 text-xl mr-3 mt-1"></i>
                            <div>
                                <h3 class="font-semibold text-violet-900 mb-1">Presque terminé !</h3>
                                <p class="text-sm text-violet-700">Vous êtes sur le point de rejoindre la communauté Travel Express.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" class="btn-secondary" onclick="prevStep()">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-check mr-2"></i> Créer mon compte
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-6">
            <p class="text-white text-opacity-90">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="font-semibold hover:underline">Connectez-vous</a>
            </p>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        // Gender selection
        document.querySelectorAll('.gender-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.gender-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('genderInput').value = this.dataset.gender;
            });
        });

        // Interest selection
        const selectedInterests = [];
        document.querySelectorAll('.interest-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                this.classList.toggle('selected');
                const interest = this.dataset.interest;

                if (selectedInterests.includes(interest)) {
                    selectedInterests.splice(selectedInterests.indexOf(interest), 1);
                } else {
                    selectedInterests.push(interest);
                }

                document.getElementById('interestsInput').value = selectedInterests.join(',');
            });
        });

        // Bio character counter
        const bioTextarea = document.querySelector('textarea[name="bio"]');
        const bioCount = document.getElementById('bioCount');
        bioTextarea.addEventListener('input', function() {
            bioCount.textContent = this.value.length;
        });

        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                // Hide current step
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('completed');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');

                // Show next step
                currentStep++;
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');

                updateProgress();

                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                // Hide current step
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');

                // Show previous step
                currentStep--;
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('completed');

                updateProgress();

                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    // Store token and user data
                    localStorage.setItem('token', result.token);
                    localStorage.setItem('user', JSON.stringify(result.user));

                    // Show success message
                    alert('Compte créé avec succès !');

                    // Redirect to profile
                    window.location.href = '/profile';
                } else {
                    alert('Erreur: ' + (result.message || 'Une erreur est survenue'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de l\'inscription');
            }
        });
    </script>
</body>
</html>
