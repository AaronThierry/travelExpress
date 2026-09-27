    <!-- Evaluation Modal - Formulaire pour les anciens collaborateurs -->
    <!-- ══ Evaluation Modal — Art Deco Vault Edition ══ -->
    <style>
        /* ── Evaluation modal dark theme ── */
        #eval-modal-card {
            background: #080808;
            border: 1px solid rgba(212,175,55,0.2);
            box-shadow: 0 48px 120px rgba(0,0,0,0.9), 0 0 0 1px rgba(212,175,55,0.05);
        }
        /* Progress bar track */
        #eval-modal-card .h-2.bg-gray-200 { background: rgba(255,255,255,0.06) !important; }
        /* Gray backgrounds → dark */
        #eval-modal-card .bg-gray-50 { background: rgba(255,255,255,0.03) !important; }
        #eval-modal-card .bg-gray-100 { background: rgba(255,255,255,0.04) !important; }
        #eval-modal-card .bg-white { background: #0e0d0b !important; }
        /* Step connector inactive */
        #eval-modal-card .bg-gray-200 { background: rgba(255,255,255,0.08) !important; }
        /* Text */
        #eval-modal-card .text-gray-500 { color: rgba(255,255,255,0.45) !important; }
        #eval-modal-card .text-gray-600 { color: rgba(255,255,255,0.6) !important; }
        #eval-modal-card .text-gray-700 { color: rgba(255,255,255,0.8) !important; }
        #eval-modal-card .text-gray-400 { color: rgba(255,255,255,0.35) !important; }
        /* Labels */
        #eval-modal-card label.block.text-sm.font-semibold { color: rgba(212,175,55,0.75) !important; }
        #eval-modal-card label.block.text-xs.font-semibold { color: rgba(212,175,55,0.75) !important; }
        #eval-modal-card label.block.text-\[10px\].font-semibold { color: rgba(212,175,55,0.7) !important; }
        /* Inputs */
        #eval-modal-card input[type="text"],
        #eval-modal-card input[type="email"],
        #eval-modal-card input[type="tel"],
        #eval-modal-card select,
        #eval-modal-card textarea {
            background: rgba(255,255,255,0.04) !important;
            border-color: rgba(212,175,55,0.15) !important;
            color: rgba(255,255,255,0.85) !important;
        }
        #eval-modal-card input::placeholder,
        #eval-modal-card textarea::placeholder { color: rgba(255,255,255,0.2) !important; }
        #eval-modal-card input:focus,
        #eval-modal-card select:focus,
        #eval-modal-card textarea:focus {
            border-color: rgba(212,175,55,0.45) !important;
            box-shadow: 0 0 0 3px rgba(212,175,55,0.07) !important;
            outline: none !important;
        }
        /* Select options */
        #eval-modal-card select option { background: #0e0d0b; color: #fff; }
        /* Radio cards (border-gray-200) */
        #eval-modal-card .border-gray-200 { border-color: rgba(212,175,55,0.14) !important; }
        /* Radio card text */
        #eval-modal-card .peer-checked\:border-\[\#d4af37\]:checked ~ div { border-color: #D4AF37; }
        /* Emerald validation → gold */
        #eval-modal-card .border-emerald-500 { border-color: rgba(212,175,55,0.5) !important; }
        #eval-modal-card .bg-emerald-50\/50 { background: rgba(212,175,55,0.04) !important; }
        #eval-modal-card .text-emerald-500 { color: #D4AF37 !important; }
        /* Red validation stays red */
        #eval-modal-card .border-red-400 { border-color: rgba(239,68,68,0.5) !important; }
        #eval-modal-card .bg-red-50\/50 { background: rgba(239,68,68,0.05) !important; }
        /* Error box */
        #eval-modal-card .bg-red-50.border.border-red-200 {
            background: rgba(239,68,68,0.07) !important;
            border-color: rgba(239,68,68,0.22) !important;
        }
        #eval-modal-card .text-red-700 { color: #fca5a5 !important; }
        #eval-modal-card .text-red-500 { color: #f87171 !important; }
        /* Story section gradient */
        #eval-modal-card .bg-gradient-to-br.from-\[\#d4af37\]\/10 {
            background: rgba(212,175,55,0.05) !important;
        }
        /* Ambassador section */
        #eval-modal-card .bg-gradient-to-br.from-\[\#d4af37\]\/10.to-\[\#0a0a0a\]\/5 {
            background: rgba(212,175,55,0.05) !important;
        }
        /* Step indicator future circles */
        #eval-modal-card .bg-gray-200.rounded-full { background: rgba(255,255,255,0.08) !important; }
        /* Detailed rating rows */
        #eval-modal-card .text-gray-300 { color: rgba(255,255,255,0.12) !important; }
        /* Recommend No button */
        #eval-modal-card .peer-checked\:bg-gray-100 { background: rgba(239,68,68,0.1) !important; }
        /* Footer */
        #eval-modal-card .border-t.border-gray-200 { border-color: rgba(212,175,55,0.1) !important; }
        #eval-modal-card .bg-gradient-to-r.from-gray-50.to-white { background: #0b0b0b !important; }
        /* Screenshot thumbnails */
        #eval-modal-card .border-gray-200 { border-color: rgba(212,175,55,0.14) !important; }
        /* Phone dropdown */
        #eval-modal-card .bg-gray-50.border.border-gray-200 { background: rgba(255,255,255,0.04) !important; border-color: rgba(212,175,55,0.14) !important; }
        #eval-modal-card .bg-gray-50 { background: rgba(255,255,255,0.03) !important; }
        /* Country dropdown */
        #eval-modal-card .bg-white.rounded-xl.shadow-2xl.border.border-gray-200 {
            background: #0e0d0b !important;
            border-color: rgba(212,175,55,0.2) !important;
            box-shadow: 0 24px 60px rgba(0,0,0,0.8) !important;
        }
        #eval-modal-card .border-b.border-gray-100 { border-color: rgba(212,175,55,0.08) !important; }
        #eval-modal-card .border-b.border-gray-50 { border-color: rgba(212,175,55,0.05) !important; }
        #eval-modal-card .hover\:bg-\[\#d4af37\]\/10:hover { background: rgba(212,175,55,0.08) !important; }
        #eval-modal-card .text-gray-700.font-medium { color: rgba(255,255,255,0.75) !important; }
        #eval-modal-card .bg-gray-100.px-2.py-0 { background: rgba(255,255,255,0.06) !important; }
        /* Signature canvas */
        #eval-modal-card #signature-canvas { background: #f5f0e8 !important; border-color: rgba(212,175,55,0.35) !important; }
        /* Service type radio cards text */
        #eval-modal-card .text-\[0a0a0a\] { color: rgba(255,255,255,0.8) !important; }
        /* Submit green button → gold */
        #eval-modal-card .from-emerald-600 { --tw-gradient-from: #B8960C !important; }
        #eval-modal-card .to-emerald-700 { --tw-gradient-to: #D4AF37 !important; }
        #eval-modal-card .border-emerald-600 { border-color: rgba(212,175,55,0.4) !important; }
        #eval-modal-card .hover\:shadow-emerald-500\/50:hover { box-shadow: 0 20px 50px rgba(212,175,55,0.3) !important; }
        /* Success screen */
        #eval-modal-card .text-\[0a0a0a\].text-3xl { color: #F0D060 !important; }
        #eval-modal-card .text-3xl.font-bold { color: #F0D060 !important; }
    </style>

    <div x-show="evaluationModalOpen"
         x-transition:enter="transition ease-out duration-400"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="evaluationModalOpen = false"
         class="fixed inset-0 z-50 overflow-y-auto flex items-start justify-center p-2 sm:p-4 pt-4 sm:pt-10 pb-4 sm:pb-10"
         style="background:rgba(2,1,1,0.92);backdrop-filter:blur(16px);"
         style="display: none;">
        <div id="eval-modal-card"
             x-show="evaluationModalOpen"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95"
             @click.stop
             class="relative w-full max-w-3xl max-h-[90vh] sm:max-h-[88vh] rounded-2xl sm:rounded-3xl overflow-hidden flex flex-col">

            <!-- Gold top accent line -->
            <div class="h-0.5 w-full flex-shrink-0" style="background:linear-gradient(to right,transparent,#B8960C,#D4AF37,#B8960C,transparent);"></div>

            <!-- Header -->
            <div class="relative px-4 sm:px-6 py-3 sm:py-4 flex-shrink-0" style="background:#080808;border-bottom:1px solid rgba(212,175,55,0.1);">
                <!-- Decorative cross pattern -->
                <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image:url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23d4af37\' fill-opacity=\'1\'%3E%3Cpath d=\'M20 18h-2v-8h-2v8H4v2h12v8h2v-8h12v-2H20z\'/%3E%3C/g%3E%3C/svg%3E');"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl flex items-center justify-center flex-shrink-0"
                             style="background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.22);">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="#D4AF37" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold tracking-wide text-base sm:text-xl" style="color:#F0D060;">Formulaire d'évaluation</h3>
                            <p class="text-xs sm:text-sm mt-0.5" style="color:rgba(212,175,55,0.45);">Partagez votre expérience avec Travel Express</p>
                        </div>
                    </div>
                    <button @click="evaluationModalOpen = false"
                            class="p-2 rounded-xl transition-all duration-200 flex-shrink-0"
                            style="color:rgba(212,175,55,0.4);"
                            onmouseover="this.style.background='rgba(212,175,55,0.08)';this.style.color='#D4AF37';"
                            onmouseout="this.style.background='transparent';this.style.color='rgba(212,175,55,0.4)';">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Form Content - Scrollable -->
            <form id="evaluation-form" class="flex flex-col flex-1 min-h-0" x-data="evaluationForm()">
                <!-- Scrollable Content Area -->
                <div class="flex-1 overflow-y-auto px-4 sm:px-6 py-3 sm:py-4">
                <!-- Progress bar -->
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold" style="color:rgba(212,175,55,0.7);">Étape <span x-text="step"></span> / <span x-text="totalSteps"></span></span>
                        <span class="text-xs" style="color:rgba(255,255,255,0.4);" x-text="step === 1 ? 'Informations personnelles' : step === 2 ? 'Parcours académique' : step === 3 ? 'Votre expérience' : 'Évaluation'"></span>
                    </div>
                    <div class="h-0.5 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06);">
                        <div class="h-full rounded-full transition-all duration-700" style="background:linear-gradient(to right,#B8960C,#D4AF37,#F0D060);" :style="'width: ' + (step / totalSteps * 100) + '%'"></div>
                    </div>
                </div>

                <!-- Step Indicators — Art Deco Roman numerals -->
                <div class="flex items-center justify-center gap-1 mb-6" x-show="!success">
                    <template x-for="s in totalSteps" :key="s">
                        <div class="flex items-center"
                             x-data="{ isCompleted: s < step || (s === step && ((s === 1 && isStep1Valid) || (s === 2 && isStep2Valid) || (s === 3 && isStep3Valid) || (s === 4 && isStep4Valid))) }">
                            <!-- Step button -->
                            <div class="relative w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center transition-all duration-500"
                                 :class="s === step ? 'scale-110' : 'scale-100'">
                                <!-- Ring -->
                                <div class="absolute inset-0 rounded-full transition-all duration-500"
                                     :style="isCompleted ? 'background:linear-gradient(135deg,#B8960C,#D4AF37);box-shadow:0 4px 16px rgba(212,175,55,0.4);' :
                                             s === step ? 'background:rgba(212,175,55,0.08);box-shadow:0 0 0 2px #D4AF37,0 0 20px rgba(212,175,55,0.2);' :
                                             'background:rgba(255,255,255,0.04);box-shadow:0 0 0 1px rgba(255,255,255,0.1);'"></div>
                                <!-- Label -->
                                <div class="relative z-10 text-xs sm:text-sm font-bold font-display transition-all duration-300"
                                     :style="isCompleted ? 'color:#080808;' : s === step ? 'color:#D4AF37;' : 'color:rgba(255,255,255,0.25);'">
                                    <span x-show="isCompleted"
                                          x-transition:enter="transition ease-out duration-300"
                                          x-transition:enter-start="opacity-0 scale-0"
                                          x-transition:enter-end="opacity-100 scale-100">✓</span>
                                    <span x-show="!isCompleted"
                                          x-text="['I','II','III','IV'][s-1]"></span>
                                </div>
                                <!-- Pulse on active -->
                                <div x-show="s === step && !isCompleted"
                                     class="absolute inset-0 rounded-full animate-ping"
                                     style="background:rgba(212,175,55,0.15);"></div>
                            </div>
                            <!-- Connector -->
                            <div x-show="s < totalSteps"
                                 class="h-px w-6 sm:w-10 mx-1 rounded-full transition-all duration-700"
                                 :style="s < step ? 'background:linear-gradient(to right,#D4AF37,#B8960C);' : 'background:rgba(255,255,255,0.07);'"></div>
                        </div>
                    </template>
                </div>

                <!-- Validation Errors Alert -->
                <div x-show="stepValidationAttempted && getStepErrors().length > 0" x-transition
                     class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-red-700">Veuillez corriger les champs suivants :</p>
                            <ul class="mt-1 text-xs text-red-600 list-disc list-inside">
                                <template x-for="err in getStepErrors()" :key="err">
                                    <li x-text="err"></li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Success Message - Black & Gold theme -->
                <div x-show="success" x-transition class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-[#d4af37] to-[#b8960c] rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl animate-bounce">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-2xl sm:text-3xl mb-4" style="color:#F0D060;">Évaluation envoyée avec succès !</h4>
                    <p class="text-base sm:text-lg mb-3" style="color:rgba(255,255,255,0.6);">Merci pour votre précieux retour 🙏</p>
                    <p class="text-sm" style="color:rgba(255,255,255,0.35);">Cette fenêtre se fermera automatiquement...</p>
                </div>

                <!-- Error Message -->
                <div x-show="error" x-transition class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-red-700 text-sm" x-text="error"></span>
                    <button @click="error = null" class="ml-auto text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Step 1: Informations personnelles - Black & Gold theme -->
                <div x-show="step === 1 && !success" x-transition>
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Prénom *</label>
                                <div class="relative">
                                    <input type="text" x-model="firstName" @blur="firstNameTouched = true" required placeholder="Votre prénom"
                                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                           :class="{
                                               'border-gray-200': !firstNameTouched,
                                               'border-emerald-500 bg-emerald-50/50': firstNameTouched && firstName.trim().length >= 2,
                                               'border-red-400 bg-red-50/50': firstNameTouched && firstName.trim().length < 2
                                           }">
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                        <svg x-show="firstNameTouched && firstName.trim().length >= 2" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <svg x-show="firstNameTouched && firstName.trim().length < 2" class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                </div>
                                <p x-show="firstNameTouched && firstName.trim().length < 2" class="text-xs text-red-500 mt-1">Min. 2 caractères</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Nom *</label>
                                <div class="relative">
                                    <input type="text" x-model="lastName" @blur="lastNameTouched = true" required placeholder="Votre nom"
                                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                           :class="{
                                               'border-gray-200': !lastNameTouched,
                                               'border-emerald-500 bg-emerald-50/50': lastNameTouched && lastName.trim().length >= 2,
                                               'border-red-400 bg-red-50/50': lastNameTouched && lastName.trim().length < 2
                                           }">
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                        <svg x-show="lastNameTouched && lastName.trim().length >= 2" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <svg x-show="lastNameTouched && lastName.trim().length < 2" class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                </div>
                                <p x-show="lastNameTouched && lastName.trim().length < 2" class="text-xs text-red-500 mt-1">Min. 2 caractères</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Email *</label>
                            <div class="relative">
                                <input type="email" x-model="email" @blur="emailTouched = true" required placeholder="votre.email@exemple.com"
                                       class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                       :class="{
                                           'border-gray-200': !emailTouched,
                                           'border-emerald-500 bg-emerald-50/50': emailTouched && isValidEmail,
                                           'border-red-400 bg-red-50/50': emailTouched && !isValidEmail
                                       }">
                                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg x-show="emailTouched && isValidEmail" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <svg x-show="emailTouched && !isValidEmail" class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </div>
                            <p x-show="emailTouched && !isValidEmail" class="text-xs text-red-500 mt-1">Email invalide</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Téléphone</label>
                            <div class="flex gap-2" x-data="{
                                evalPhoneOpen: false,
                                evalPhoneSearch: '',
                                evalPhoneNumber: '',
                                evalSelectedCode: '+226',
                                evalSelectedIso: 'bf',
                                evalSelectedCountry: 'Burkina Faso',
                                evalCountries: [
                                    { code: '+27', country: 'Afrique du Sud', iso: 'za' },
                                    { code: '+213', country: 'Algérie', iso: 'dz' },
                                    { code: '+49', country: 'Allemagne', iso: 'de' },
                                    { code: '+32', country: 'Belgique', iso: 'be' },
                                    { code: '+229', country: 'Bénin', iso: 'bj' },
                                    { code: '+55', country: 'Brésil', iso: 'br' },
                                    { code: '+226', country: 'Burkina Faso', iso: 'bf' },
                                    { code: '+257', country: 'Burundi', iso: 'bi' },
                                    { code: '+237', country: 'Cameroun', iso: 'cm' },
                                    { code: '+1', country: 'Canada/USA', iso: 'us' },
                                    { code: '+236', country: 'Centrafrique', iso: 'cf' },
                                    { code: '+86', country: 'Chine', iso: 'cn' },
                                    { code: '+242', country: 'Congo', iso: 'cg' },
                                    { code: '+243', country: 'RD Congo', iso: 'cd' },
                                    { code: '+225', country: 'Côte d\'Ivoire', iso: 'ci' },
                                    { code: '+20', country: 'Égypte', iso: 'eg' },
                                    { code: '+971', country: 'Émirats', iso: 'ae' },
                                    { code: '+34', country: 'Espagne', iso: 'es' },
                                    { code: '+251', country: 'Éthiopie', iso: 'et' },
                                    { code: '+33', country: 'France', iso: 'fr' },
                                    { code: '+241', country: 'Gabon', iso: 'ga' },
                                    { code: '+220', country: 'Gambie', iso: 'gm' },
                                    { code: '+233', country: 'Ghana', iso: 'gh' },
                                    { code: '+224', country: 'Guinée', iso: 'gn' },
                                    { code: '+245', country: 'Guinée-Bissau', iso: 'gw' },
                                    { code: '+91', country: 'Inde', iso: 'in' },
                                    { code: '+39', country: 'Italie', iso: 'it' },
                                    { code: '+81', country: 'Japon', iso: 'jp' },
                                    { code: '+254', country: 'Kenya', iso: 'ke' },
                                    { code: '+961', country: 'Liban', iso: 'lb' },
                                    { code: '+261', country: 'Madagascar', iso: 'mg' },
                                    { code: '+223', country: 'Mali', iso: 'ml' },
                                    { code: '+212', country: 'Maroc', iso: 'ma' },
                                    { code: '+230', country: 'Maurice', iso: 'mu' },
                                    { code: '+222', country: 'Mauritanie', iso: 'mr' },
                                    { code: '+227', country: 'Niger', iso: 'ne' },
                                    { code: '+234', country: 'Nigéria', iso: 'ng' },
                                    { code: '+256', country: 'Ouganda', iso: 'ug' },
                                    { code: '+31', country: 'Pays-Bas', iso: 'nl' },
                                    { code: '+351', country: 'Portugal', iso: 'pt' },
                                    { code: '+44', country: 'Royaume-Uni', iso: 'gb' },
                                    { code: '+250', country: 'Rwanda', iso: 'rw' },
                                    { code: '+221', country: 'Sénégal', iso: 'sn' },
                                    { code: '+232', country: 'Sierra Leone', iso: 'sl' },
                                    { code: '+41', country: 'Suisse', iso: 'ch' },
                                    { code: '+235', country: 'Tchad', iso: 'td' },
                                    { code: '+228', country: 'Togo', iso: 'tg' },
                                    { code: '+216', country: 'Tunisie', iso: 'tn' },
                                    { code: '+90', country: 'Turquie', iso: 'tr' },
                                    { code: '+260', country: 'Zambie', iso: 'zm' },
                                    { code: '+263', country: 'Zimbabwe', iso: 'zw' }
                                ],
                                get evalFilteredCountries() {
                                    if (!this.evalPhoneSearch) return this.evalCountries;
                                    const s = this.evalPhoneSearch.toLowerCase();
                                    return this.evalCountries.filter(c => c.country.toLowerCase().includes(s) || c.code.includes(s));
                                },
                                evalSelectCountry(c) {
                                    this.evalSelectedCode = c.code;
                                    this.evalSelectedIso = c.iso;
                                    this.evalSelectedCountry = c.country;
                                    this.evalPhoneOpen = false;
                                    this.evalPhoneSearch = '';
                                    this.updateParentPhone();
                                },
                                formatEvalPhone() {
                                    let digits = this.evalPhoneNumber.replace(/\D/g, '');
                                    if (digits.length > 0) {
                                        let formatted = '';
                                        for (let i = 0; i < digits.length; i += 2) {
                                            if (i > 0) formatted += ' ';
                                            formatted += digits.substring(i, i + 2);
                                        }
                                        this.evalPhoneNumber = formatted;
                                    }
                                    this.updateParentPhone();
                                },
                                updateParentPhone() {
                                    const digits = this.evalPhoneNumber.replace(/\D/g, '');
                                    if (digits) {
                                        phone = this.evalSelectedCode + ' ' + this.evalPhoneNumber;
                                    } else {
                                        phone = '';
                                    }
                                }
                            }" x-init="$watch('evalPhoneNumber', () => formatEvalPhone())">
                                <!-- Bouton sélecteur avec drapeau -->
                                <div class="relative">
                                    <button type="button" @click="evalPhoneOpen = !evalPhoneOpen"
                                            class="flex items-center gap-2 w-[120px] sm:w-[140px] px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all text-sm font-medium hover:bg-gray-100"
                                            :class="{ 'ring-2 ring-[#d4af37] border-[#d4af37]': evalPhoneOpen }">
                                        <img :src="'https://flagcdn.com/w40/' + evalSelectedIso + '.png'"
                                             :srcset="'https://flagcdn.com/w80/' + evalSelectedIso + '.png 2x'"
                                             :alt="evalSelectedCountry"
                                             class="w-7 h-5 object-cover rounded-sm shadow-sm ring-1 ring-black/10">
                                        <span class="font-bold text-[#0a0a0a]" x-text="evalSelectedCode"></span>
                                        <svg class="w-4 h-4 ml-auto text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': evalPhoneOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>

                                    <!-- Dropdown -->
                                    <div x-show="evalPhoneOpen" @click.away="evalPhoneOpen = false"
                                         x-transition:enter="transition ease-out duration-150"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-100"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="absolute z-50 left-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden"
                                         style="display: none;">

                                        <!-- Recherche -->
                                        <div class="p-3 border-b border-gray-100 bg-gray-50">
                                            <div class="relative">
                                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                                <input type="text" x-model="evalPhoneSearch" placeholder="Rechercher un pays..."
                                                       class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] outline-none bg-white"
                                                       @click.stop>
                                            </div>
                                        </div>

                                        <!-- Liste des pays -->
                                        <div class="max-h-64 overflow-y-auto">
                                            <template x-for="c in evalFilteredCountries" :key="c.iso">
                                                <button type="button" @click="evalSelectCountry(c)"
                                                        class="flex items-center gap-3 w-full px-4 py-3 hover:bg-[#d4af37]/10 transition-colors text-left border-b border-gray-50"
                                                        :class="{ 'bg-[#d4af37]/10 border-l-4 border-l-[#d4af37]': evalSelectedIso === c.iso }">
                                                    <img :src="'https://flagcdn.com/w40/' + c.iso + '.png'"
                                                         :srcset="'https://flagcdn.com/w80/' + c.iso + '.png 2x'"
                                                         :alt="c.country"
                                                         class="w-8 h-6 object-cover rounded-sm shadow-sm ring-1 ring-black/10">
                                                    <span class="flex-1 text-sm font-medium text-gray-700" x-text="c.country"></span>
                                                    <span class="text-sm font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded" x-text="c.code"></span>
                                                    <svg x-show="evalSelectedIso === c.iso" class="w-5 h-5 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </template>
                                            <div x-show="evalFilteredCountries.length === 0" class="px-4 py-6 text-sm text-gray-500 text-center">
                                                Aucun pays trouvé
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Champ téléphone -->
                                <input type="tel" x-model="evalPhoneNumber" placeholder="70 00 00 00"
                                       class="flex-1 min-w-0 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Parcours académique - Black & Gold theme -->
                <div x-show="step === 2 && !success" x-transition>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Université / École *</label>
                            <div class="relative">
                                <input type="text" x-model="university" @blur="universityTouched = true" required placeholder="Nom de votre université ou école"
                                       class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                       :class="{
                                           'border-gray-200': !universityTouched,
                                           'border-emerald-500 bg-emerald-50/50': universityTouched && university.trim().length >= 3,
                                           'border-red-400 bg-red-50/50': universityTouched && university.trim().length < 3
                                       }">
                                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg x-show="universityTouched && university.trim().length >= 3" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <svg x-show="universityTouched && university.trim().length < 3" class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </div>
                            <p x-show="universityTouched && university.trim().length < 3" class="text-xs text-red-500 mt-1">Min. 3 caractères</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Pays d'études *</label>
                                <div class="relative">
                                    <select x-model="countryOfStudy" @change="countryOfStudyTouched = true" required
                                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                            :class="{
                                                'border-gray-200': !countryOfStudyTouched,
                                                'border-emerald-500 bg-emerald-50/50': countryOfStudyTouched && countryOfStudy !== '',
                                                'border-red-400 bg-red-50/50': countryOfStudyTouched && countryOfStudy === ''
                                            }">
                                        <option value="">Sélectionner...</option>
                                        <option value="Chine">Chine</option>
                                        <option value="Espagne">Espagne</option>
                                        <option value="Allemagne">Allemagne</option>
                                        <option value="France">France</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Belgique">Belgique</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                    <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg x-show="countryOfStudyTouched && countryOfStudy !== ''" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                </div>
                                <p x-show="countryOfStudyTouched && countryOfStudy === ''" class="text-xs text-red-500 mt-1">Requis</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Niveau d'études *</label>
                                <div class="relative">
                                    <select x-model="studyLevel" @change="studyLevelTouched = true" required
                                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                            :class="{
                                                'border-gray-200': !studyLevelTouched,
                                                'border-emerald-500 bg-emerald-50/50': studyLevelTouched && studyLevel !== '',
                                                'border-red-400 bg-red-50/50': studyLevelTouched && studyLevel === ''
                                            }">
                                        <option value="">Sélectionner...</option>
                                        <option value="licence_1">Licence 1</option>
                                        <option value="licence_2">Licence 2</option>
                                        <option value="licence_3">Licence 3</option>
                                        <option value="master_1">Master 1</option>
                                        <option value="master_2">Master 2</option>
                                        <option value="doctorat">Doctorat</option>
                                        <option value="formation_professionnelle">Formation professionnelle</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                    <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg x-show="studyLevelTouched && studyLevel !== ''" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                </div>
                                <p x-show="studyLevelTouched && studyLevel === ''" class="text-xs text-red-500 mt-1">Requis</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Filière *</label>
                                <div class="relative">
                                    <input type="text" x-model="fieldOfStudy" @blur="fieldOfStudyTouched = true" required placeholder="Ex: Informatique, Commerce..."
                                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all pr-10"
                                           :class="{
                                               'border-gray-200': !fieldOfStudyTouched,
                                               'border-emerald-500 bg-emerald-50/50': fieldOfStudyTouched && fieldOfStudy.trim().length >= 2,
                                               'border-red-400 bg-red-50/50': fieldOfStudyTouched && fieldOfStudy.trim().length < 2
                                           }">
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                        <svg x-show="fieldOfStudyTouched && fieldOfStudy.trim().length >= 2" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <svg x-show="fieldOfStudyTouched && fieldOfStudy.trim().length < 2" class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                </div>
                                <p x-show="fieldOfStudyTouched && fieldOfStudy.trim().length < 2" class="text-xs text-red-500 mt-1">Min. 2 caractères</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Année de début</label>
                                <select x-model="startYear"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all">
                                    <option value="">Sélectionner...</option>
                                    <template x-for="year in Array.from({length: 10}, (_, i) => new Date().getFullYear() - i)" :key="year">
                                        <option :value="year" x-text="year"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#0a0a0a] mb-2">Type de service utilisé</label>
                            <div class="grid grid-cols-3 gap-2 sm:gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="serviceUsed" value="etudes" class="peer sr-only">
                                    <div class="p-2 sm:p-3 border-2 border-gray-200 rounded-lg sm:rounded-xl text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all">
                                        <span class="text-xl sm:text-2xl mb-1 block">🎓</span>
                                        <span class="text-xs sm:text-sm font-medium">Études</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="serviceUsed" value="business" class="peer sr-only">
                                    <div class="p-2 sm:p-3 border-2 border-gray-200 rounded-lg sm:rounded-xl text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all">
                                        <span class="text-xl sm:text-2xl mb-1 block">💼</span>
                                        <span class="text-xs sm:text-sm font-medium">Business</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="serviceUsed" value="visa_seul" class="peer sr-only">
                                    <div class="p-2 sm:p-3 border-2 border-gray-200 rounded-lg sm:rounded-xl text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all">
                                        <span class="text-xl sm:text-2xl mb-1 block">📄</span>
                                        <span class="text-xs sm:text-sm font-medium">Visa seul</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Expérience - Black & Gold theme -->
                <div x-show="step === 3 && !success" x-transition>
                    <div class="space-y-3">
                        <!-- Histoire du projet -->
                        <div>
                            <label class="block text-xs font-semibold text-[#0a0a0a] mb-1.5">
                                Comment êtes-vous parvenu(e) à réaliser votre projet ? *
                            </label>
                            <textarea x-model="projectStory" @blur="projectStoryTouched = true" required rows="3"
                                      placeholder="Votre parcours, étapes clés, défis..."
                                      class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all resize-none"
                                      :class="{
                                          'border-gray-200': !projectStoryTouched,
                                          'border-emerald-500 bg-emerald-50/50': projectStoryTouched && projectStory.trim().length >= 50,
                                          'border-red-400 bg-red-50/50': projectStoryTouched && projectStory.trim().length < 50
                                      }"></textarea>
                            <div class="flex items-center justify-between mt-1">
                                <p class="text-[10px]" :class="projectStory.trim().length >= 50 ? 'text-emerald-600' : 'text-gray-500'">
                                    <span x-text="projectStory.length"></span>/50 car.
                                    <span x-show="projectStory.trim().length >= 50">✓</span>
                                </p>
                                <p x-show="projectStoryTouched && projectStory.trim().length < 50" class="text-[10px] text-red-500">Min. 50</p>
                            </div>
                        </div>

                        <!-- Source de découverte -->
                        <div>
                            <label class="block text-xs font-semibold text-[#0a0a0a] mb-1.5">
                                Comment avez-vous connu Travel Express ? *
                            </label>
                            <p x-show="discoverySourceTouched && discoverySource === ''" class="text-[10px] text-red-500 mb-1.5">Sélectionner une option</p>
                            <div class="grid grid-cols-3 gap-1.5">
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="siao" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">🏢</span>
                                        <span class="text-[9px] font-medium block">SIAO</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="instagram" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">📸</span>
                                        <span class="text-[9px] font-medium block">Instagram</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="ambassadeur_ley_ley" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">👨‍💼</span>
                                        <span class="text-[9px] font-medium block">Ley Ley</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="bouche_a_oreille" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">🗣️</span>
                                        <span class="text-[9px] font-medium block">Bouche à or.</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="facebook" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">📘</span>
                                        <span class="text-[9px] font-medium block">Facebook</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="ambassadeur_autre" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">🤝</span>
                                        <span class="text-[9px] font-medium block">Autre amb.</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="youtube" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">▶️</span>
                                        <span class="text-[9px] font-medium block">YouTube</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="ambassadeur_la_bobolaise" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">👩‍💼</span>
                                        <span class="text-[9px] font-medium block">La Bobolaise</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="tiktok" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">🎵</span>
                                        <span class="text-[9px] font-medium block">TikTok</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="autre" class="peer sr-only">
                                    <div class="p-1.5 border-2 border-gray-200 rounded-lg text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all hover:border-gray-300">
                                        <span class="text-xl block mb-0.5">❓</span>
                                        <span class="text-[9px] font-medium block">Autre</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div x-show="discoverySource === 'ambassadeur_autre' || discoverySource === 'autre'" x-transition>
                            <label class="block text-xs font-semibold text-[#0a0a0a] mb-1.5">Précisez</label>
                            <input type="text" x-model="discoverySourceDetail" placeholder="Nom ou source..."
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all">
                        </div>

                        <!-- Questions spécifiques aux ambassadrices -->
                        <div x-show="isAmbassadorSelected" x-transition class="space-y-2">
                            <!-- Question mise en relation directe -->
                            <div class="bg-gradient-to-br from-[#d4af37]/10 to-[#0a0a0a]/5 rounded p-2 border border-[#d4af37]/30">
                                <label class="block text-[10px] font-semibold text-[#0a0a0a] mb-1.5">
                                    <span x-text="discoverySource === 'ambassadeur_la_bobolaise' ? 'La Bobolaise' : discoverySource === 'ambassadeur_ley_ley' ? 'Ley Ley' : 'Ambassadeur'"></span>
                                    vous a mis en relation directe ? *
                                </label>
                                <div class="flex gap-1.5">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" x-model="ambassadorDirectContact" :value="true" class="peer sr-only">
                                        <div class="p-1.5 border-2 border-gray-200 rounded text-center peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10 transition-all">
                                            <span class="text-lg block">✅</span>
                                            <span class="font-semibold text-[#0a0a0a] text-[10px]">Oui</span>
                                        </div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" x-model="ambassadorDirectContact" :value="false" class="peer sr-only">
                                        <div class="p-1.5 border-2 border-gray-200 rounded text-center peer-checked:border-gray-400 peer-checked:bg-gray-100 transition-all">
                                            <span class="text-lg block">❌</span>
                                            <span class="font-semibold text-gray-700 text-[10px]">Non</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Upload de captures d'écran -->
                            <div class="rounded-lg border-2 overflow-hidden"
                                 :class="screenshotPreviews.length === 0 ? 'border-[#d4af37] border-dashed' : 'border-[#d4af37]/50'">
                                <!-- Header -->
                                <div class="flex items-center justify-between px-3 py-2 bg-[#d4af37]/15">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg">📸</span>
                                        <div>
                                            <p class="text-[11px] font-bold text-[#d4af37] uppercase tracking-wider">Captures d'écran <span class="text-red-400">*</span></p>
                                            <p class="text-[9px] text-[#d4af37]/70">Conversation avec <span x-text="discoverySource === 'ambassadeur_la_bobolaise' ? 'La Bobolaise' : 'Ley Ley'"></span> — obligatoire</p>
                                        </div>
                                    </div>
                                    <input type="file" id="screenshot-upload" @change="handleScreenshotUpload($event)"
                                           accept="image/*" multiple class="hidden">
                                    <label for="screenshot-upload"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md cursor-pointer transition-all text-[10px] font-bold uppercase tracking-wide"
                                           style="background:linear-gradient(135deg,#d4af37,#b8941e);color:#0a0a0a;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Ajouter
                                    </label>
                                </div>

                                <!-- Drop zone vide -->
                                <div x-show="screenshotPreviews.length === 0"
                                     class="flex flex-col items-center justify-center py-5 px-4 bg-[#d4af37]/5 cursor-pointer"
                                     @click="document.getElementById('screenshot-upload').click()">
                                    <svg class="w-8 h-8 text-[#d4af37]/60 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-[11px] font-semibold text-[#d4af37]/80 mb-0.5">Cliquez ici pour ajouter vos captures</p>
                                    <p class="text-[9px] text-[#d4af37]/50">PNG, JPG, WEBP — plusieurs fichiers acceptés</p>
                                </div>

                                <!-- Prévisualisation des captures -->
                                <div x-show="screenshotPreviews.length > 0" class="grid grid-cols-4 gap-1.5 p-2 bg-[#0a0a0a]/10">
                                    <template x-for="(preview, index) in screenshotPreviews" :key="index">
                                        <div class="relative group">
                                            <img :src="preview" class="w-full h-16 object-cover rounded border border-[#d4af37]/30">
                                            <button type="button" @click="removeScreenshot(index)"
                                                    class="absolute top-0.5 right-0.5 p-0.5 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <!-- Ajouter plus -->
                                    <label for="screenshot-upload" class="flex flex-col items-center justify-center h-16 rounded border-2 border-dashed border-[#d4af37]/30 cursor-pointer hover:border-[#d4af37]/60 transition-colors">
                                        <svg class="w-4 h-4 text-[#d4af37]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Évaluation - Black & Gold theme -->
                <div x-show="step === 4 && !success" x-transition>
                    <div class="space-y-6">
                        <!-- Note globale -->
                        <div class="bg-gradient-to-br from-[#d4af37]/10 to-[#0a0a0a]/5 rounded-xl sm:rounded-2xl p-3 sm:p-5 border border-[#d4af37]/20">
                            <label class="block text-xs sm:text-sm font-semibold text-[#0a0a0a] mb-2 sm:mb-3">Note globale à Travel Express *</label>
                            <div class="flex items-center justify-center gap-1 sm:gap-2">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click="rating = star" class="focus:outline-none transform hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 sm:w-10 sm:h-10 transition-colors" :class="star <= rating ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <p class="text-center text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2" x-text="rating === 5 ? 'Excellent !' : rating === 4 ? 'Très bien' : rating === 3 ? 'Bien' : rating === 2 ? 'Moyen' : 'À améliorer'"></p>
                        </div>

                        <!-- Notes détaillées -->
                        <div class="grid grid-cols-2 gap-2 sm:gap-4">
                            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-2.5 sm:p-4">
                                <label class="block text-[10px] sm:text-xs font-medium text-gray-600 mb-1.5 sm:mb-2">Accompagnement</label>
                                <div class="flex gap-0.5 sm:gap-1 justify-center sm:justify-start">
                                    <template x-for="star in 5" :key="'acc-'+star">
                                        <button type="button" @click="ratingAccompagnement = star" class="focus:outline-none">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" :class="star <= ratingAccompagnement ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-2.5 sm:p-4">
                                <label class="block text-[10px] sm:text-xs font-medium text-gray-600 mb-1.5 sm:mb-2">Communication</label>
                                <div class="flex gap-0.5 sm:gap-1 justify-center sm:justify-start">
                                    <template x-for="star in 5" :key="'com-'+star">
                                        <button type="button" @click="ratingCommunication = star" class="focus:outline-none">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" :class="star <= ratingCommunication ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-2.5 sm:p-4">
                                <label class="block text-[10px] sm:text-xs font-medium text-gray-600 mb-1.5 sm:mb-2">Délais</label>
                                <div class="flex gap-0.5 sm:gap-1 justify-center sm:justify-start">
                                    <template x-for="star in 5" :key="'del-'+star">
                                        <button type="button" @click="ratingDelais = star" class="focus:outline-none">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" :class="star <= ratingDelais ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-2.5 sm:p-4">
                                <label class="block text-[10px] sm:text-xs font-medium text-gray-600 mb-1.5 sm:mb-2">Qualité/Prix</label>
                                <div class="flex gap-0.5 sm:gap-1 justify-center sm:justify-start">
                                    <template x-for="star in 5" :key="'qp-'+star">
                                        <button type="button" @click="ratingQualitePrix = star" class="focus:outline-none">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" :class="star <= ratingQualitePrix ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Recommandation -->
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold mb-2 sm:mb-3" style="color:rgba(212,175,55,0.85);">Recommanderiez-vous Travel Express ?</label>
                            <div class="flex gap-3 sm:gap-4">
                                <div class="flex-1 cursor-pointer" @click="wouldRecommend = true">
                                    <div class="relative p-3 sm:p-5 rounded-2xl text-center transition-all duration-200 overflow-hidden"
                                         :style="wouldRecommend ? 'background:rgba(212,175,55,0.12);border:2px solid rgba(212,175,55,0.6);box-shadow:0 0 24px rgba(212,175,55,0.12);' : 'background:rgba(255,255,255,0.04);border:2px solid rgba(255,255,255,0.1);'">
                                        <div class="absolute top-2 right-2 w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold"
                                             :style="wouldRecommend ? 'background:#D4AF37;color:#080808;opacity:1;' : 'opacity:0;'"
                                             x-cloak>✓</div>
                                        <span class="text-2xl sm:text-4xl block mb-2">👍</span>
                                        <span class="font-bold text-sm sm:text-base tracking-wide"
                                              :style="wouldRecommend ? 'color:#F0D060;' : 'color:rgba(255,255,255,0.45);'">Oui !</span>
                                    </div>
                                </div>
                                <div class="flex-1 cursor-pointer" @click="wouldRecommend = false">
                                    <div class="relative p-3 sm:p-5 rounded-2xl text-center transition-all duration-200 overflow-hidden"
                                         :style="!wouldRecommend ? 'background:rgba(239,68,68,0.08);border:2px solid rgba(239,68,68,0.45);box-shadow:0 0 20px rgba(239,68,68,0.08);' : 'background:rgba(255,255,255,0.04);border:2px solid rgba(255,255,255,0.1);'">
                                        <div class="absolute top-2 right-2 w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold"
                                             :style="!wouldRecommend ? 'background:#ef4444;color:#fff;opacity:1;' : 'opacity:0;'"
                                             x-cloak>✕</div>
                                        <span class="text-2xl sm:text-4xl block mb-2">👎</span>
                                        <span class="font-bold text-sm sm:text-base tracking-wide"
                                              :style="!wouldRecommend ? 'color:#fca5a5;' : 'color:rgba(255,255,255,0.45);'">Non</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Signature - Black & Gold theme -->
                        <div class="bg-gradient-to-br from-[#d4af37]/10 to-[#0a0a0a]/5 rounded-xl sm:rounded-2xl p-3 sm:p-5 border border-[#d4af37]/30">
                            <div class="flex items-start gap-2 sm:gap-3 mb-2 sm:mb-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-[#d4af37]/20 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0 border border-[#d4af37]/30">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[#0a0a0a] text-sm sm:text-base">Signature *</h4>
                                    <p class="text-xs sm:text-sm text-gray-600">Signez ci-dessous pour valider</p>
                                </div>
                            </div>
                            <div class="relative">
                                <canvas id="signature-canvas"
                                        class="w-full border-2 border-[#0a0a0a] rounded-lg sm:rounded-xl bg-white cursor-default sm:cursor-crosshair touch-none shadow-inner"
                                        style="height: 120px;"></canvas>
                                <button type="button" @click="clearSignature()"
                                        class="absolute top-1.5 right-1.5 sm:top-2 sm:right-2 p-1.5 sm:p-2 bg-white/80 hover:bg-white text-gray-500 hover:text-red-500 rounded-md sm:rounded-lg transition-colors shadow-sm">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-[10px] sm:text-xs text-[#0a0a0a]/70 mt-1.5 sm:mt-2 flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Utilisez votre doigt ou souris pour signer
                            </p>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Scrollable Content Area -->

                <!-- Footer navigation -->
                <div x-show="!success"
                     class="flex-shrink-0 px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between"
                     style="border-top:1px solid rgba(212,175,55,0.1);background:#080808;">
                    <!-- Précédent -->
                    <button type="button" @click="prevStep()" x-show="step > 1"
                            class="group flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl text-sm sm:text-base font-semibold transition-all duration-300"
                            style="border:1px solid rgba(212,175,55,0.15);color:rgba(255,255,255,0.55);"
                            onmouseover="this.style.borderColor='rgba(212,175,55,0.35)';this.style.color='#D4AF37';this.style.background='rgba(212,175,55,0.05)';"
                            onmouseout="this.style.borderColor='rgba(212,175,55,0.15)';this.style.color='rgba(255,255,255,0.55)';this.style.background='transparent';">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <span class="hidden sm:inline">Précédent</span>
                        <span class="sm:hidden">Retour</span>
                    </button>
                    <div x-show="step === 1"></div>

                    <!-- Suivant -->
                    <button type="button" @click="nextStep()" x-show="step < totalSteps"
                            :disabled="(step === 1 && !isStep1Valid) || (step === 2 && !isStep2Valid) || (step === 3 && !isStep3Valid)"
                            class="group flex items-center gap-2 px-5 sm:px-7 py-2.5 sm:py-3 rounded-xl text-sm sm:text-base font-bold transition-all duration-300 disabled:opacity-40 disabled:cursor-not-allowed hover:scale-105 disabled:hover:scale-100"
                            style="background:linear-gradient(135deg,#0e0c08,#1a1508);border:1px solid rgba(212,175,55,0.32);color:#D4AF37;box-shadow:0 4px 20px rgba(212,175,55,0.1);"
                            onmouseover="if(!this.disabled){this.style.boxShadow='0 8px 28px rgba(212,175,55,0.25)';this.style.borderColor='rgba(212,175,55,0.55)';}"
                            onmouseout="this.style.boxShadow='0 4px 20px rgba(212,175,55,0.1)';this.style.borderColor='rgba(212,175,55,0.32)';">
                        <span>Suivant</span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Envoyer -->
                    <button type="button" @click="submitForm()" x-show="step === totalSteps"
                            :disabled="submitting || !signatureData"
                            class="group flex items-center gap-2 px-5 sm:px-7 py-2.5 sm:py-3 rounded-xl text-sm sm:text-base font-bold transition-all duration-300 disabled:opacity-40 disabled:cursor-not-allowed hover:scale-105 disabled:hover:scale-100"
                            style="background:linear-gradient(135deg,#B8960C,#D4AF37);color:#080808;box-shadow:0 6px 24px rgba(212,175,55,0.3);">
                        <svg x-show="submitting" class="animate-spin w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <svg x-show="!submitting" class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-text="submitting ? 'Envoi...' : 'Envoyer'" class="sm:hidden"></span>
                        <span x-text="submitting ? 'Envoi en cours...' : 'Envoyer mon évaluation'" class="hidden sm:inline"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
