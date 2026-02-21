<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dossier Visa - Travel Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --gold: #D4AF37; --blue: #3b82f6; }
        body { background: linear-gradient(135deg, #0a0a0a 0%, #0d1117 50%, #0a0a0a 100%); }

        .card {
            background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .card-blue {
            background: linear-gradient(145deg, #0f1929 0%, #0a1020 100%);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        .gold-text { color: var(--gold); }
        .blue-text  { color: #60a5fa; }

        .progress-bar  { height: 8px; background: rgba(59,130,246,0.15); border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #3b82f6, #60a5fa); transition: width 0.5s ease; }

        .btn-gold {
            background: linear-gradient(135deg, #D4AF37 0%, #B8960C 100%);
            color: #0a0a0a; font-weight: 600; transition: all 0.3s;
        }
        .btn-gold:hover { background: linear-gradient(135deg, #F4E5B2 0%, #D4AF37 100%); transform: translateY(-2px); }
        .btn-blue {
            background: rgba(59,130,246,0.2); color: #60a5fa;
            border: 1px solid rgba(59,130,246,0.4); font-weight: 500; transition: all 0.3s;
        }
        .btn-blue:hover { background: rgba(59,130,246,0.35); }

        .input-dark {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(59,130,246,0.25); color: white;
        }
        .input-dark:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .input-dark::placeholder { color: rgba(255,255,255,0.35); }

        .doc-item {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(59,130,246,0.15);
            border-radius: 0.75rem; padding: 1rem; transition: all 0.3s;
        }
        .doc-item.uploaded { border-color: rgba(34,197,94,0.3); background: rgba(34,197,94,0.04); }
        .doc-item:hover { border-color: rgba(59,130,246,0.35); }

        .toast {
            position: fixed; top: 1rem; right: 1rem;
            background: linear-gradient(145deg, #1a1a1a, #0d0d0d);
            border: 1px solid rgba(212,175,55,0.3); border-radius: 0.75rem;
            padding: 1rem; transform: translateX(120%); transition: transform 0.3s;
            z-index: 50; max-width: 350px;
        }
        .toast.show { transform: translateX(0); }
    </style>
</head>
<body class="min-h-screen text-white" x-data="visaForm()">

    <div class="relative container mx-auto px-4 py-8 max-w-3xl">

        <!-- ── Header ─────────────────────────────────────────────────── -->
        <div class="card rounded-2xl p-8 mb-6">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <div class="flex items-center gap-4 flex-1">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center text-black font-bold text-xl"
                         style="background: linear-gradient(135deg,#3b82f6,#60a5fa);">
                        @if($visa->student_name)
                            {{ strtoupper(substr($visa->student_name, 0, 1)) }}
                        @else
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold blue-text">
                            {{ $visa->student_name ?? 'Nouveau Dossier Visa' }}
                        </h1>
                        <p class="text-gray-400 text-sm">Dossier Visa — Travel Express</p>
                    </div>
                </div>
                <!-- Status badge -->
                @php $si = $visa->status_info; @endphp
                <span class="px-4 py-2 rounded-full text-sm font-medium border self-start
                    @if($si['color']==='green') border-green-500 text-green-400 bg-green-500/10
                    @elseif($si['color']==='red') border-red-500 text-red-400 bg-red-500/10
                    @elseif($si['color']==='blue') border-blue-500 text-blue-400 bg-blue-500/10
                    @elseif($si['color']==='yellow') border-yellow-500 text-yellow-400 bg-yellow-500/10
                    @else border-gray-500 text-gray-400 bg-gray-500/10 @endif">
                    {{ $si['label'] }}
                </span>
            </div>

            <!-- Progress -->
            <div class="mt-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-400">Progression du dossier</span>
                    <span class="text-sm font-bold blue-text" id="visa-percentage">{{ $visa->completion_percentage }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="visa-progress" style="width:{{ $visa->completion_percentage }}%"></div>
                </div>
            </div>
        </div>

        <!-- ── Personal Info Form ─────────────────────────────────────── -->
        <div class="card rounded-2xl p-8 mb-6">
            <h2 class="text-lg font-bold gold-text mb-5 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                Informations personnelles
            </h2>
            <form @submit.prevent="saveInfo" class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Nom complet *</label>
                    <input type="text" x-model="info.student_name" required
                           class="w-full px-4 py-3 rounded-lg input-dark" placeholder="Votre nom complet">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Email *</label>
                    <input type="email" x-model="info.student_email" required
                           class="w-full px-4 py-3 rounded-lg input-dark" placeholder="votre@email.com">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Téléphone</label>
                    <input type="tel" x-model="info.student_phone"
                           class="w-full px-4 py-3 rounded-lg input-dark" placeholder="+226 XX XX XX XX">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Numéro de passeport</label>
                    <input type="text" x-model="info.passport_number"
                           class="w-full px-4 py-3 rounded-lg input-dark" placeholder="Numéro de passeport">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="btn-gold px-6 py-3 rounded-lg" :disabled="saving">
                        <span x-show="!saving">Enregistrer</span>
                        <span x-show="saving">Enregistrement...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- ── Visa Documents ─────────────────────────────────────────── -->
        <div class="card-blue rounded-2xl p-8 mb-6">
            <!-- Section header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                <h2 class="text-xl font-bold blue-text flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                         style="background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#60a5fa;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    Documents Visa
                </h2>
                @php
                    $reqCount = count(array_diff(array_keys(\App\Models\VisaApplication::DOCUMENTS), \App\Models\VisaApplication::OPTIONAL_DOCUMENTS));
                    $uploadedCount = $uploadedDocuments->count();
                @endphp
                <span class="text-sm" style="color:#93c5fd;">
                    {{ $uploadedCount }} / {{ count($documents) }} uploadés
                </span>
            </div>

            <!-- Info box -->
            <div class="mb-6 p-4 rounded-xl" style="background:rgba(59,130,246,0.07);border:1px solid rgba(59,130,246,0.2);">
                <p class="text-sm" style="color:#93c5fd;">
                    Ces documents sont requis pour votre dossier visa. Les documents
                    <strong>Optionnel</strong> peuvent renforcer votre demande mais ne sont pas obligatoires.
                    Formats acceptés : PDF, JPG, PNG, DOC (max 10 Mo).
                </p>
            </div>

            <!-- Document list -->
            <div class="space-y-4">
                @foreach($documents as $docType => $docLabel)
                    @php
                        $uploaded   = $uploadedDocuments->get($docType);
                        $isOptional = in_array($docType, \App\Models\VisaApplication::OPTIONAL_DOCUMENTS);
                        $cleanLabel = str_replace(' (optionnel)', '', $docLabel);
                    @endphp
                    <div class="doc-item {{ $uploaded ? 'uploaded' : '' }}" data-doc-type="{{ $docType }}">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    @if($uploaded)
                                        <svg class="w-5 h-5 flex-shrink-0 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:rgba(59,130,246,0.45);">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    @endif
                                    <h3 class="font-semibold text-white">{{ $cleanLabel }}</h3>
                                    @if($isOptional)
                                        <span class="text-xs px-2 py-0.5 rounded" style="background:rgba(107,114,128,0.3);color:#9ca3af;">Optionnel</span>
                                    @else
                                        <span class="text-xs px-2 py-0.5 rounded" style="background:rgba(59,130,246,0.15);color:#93c5fd;">Requis</span>
                                    @endif
                                </div>

                                @if($uploaded)
                                    <div class="mt-2 flex flex-wrap items-center gap-3 ml-7">
                                        <span class="text-sm text-gray-400">{{ $uploaded->original_filename }}</span>
                                        @if($uploaded->status === 'approved')
                                            <span class="text-xs px-2 py-0.5 bg-green-900/50 text-green-400 rounded border border-green-700">Approuvé</span>
                                        @elseif($uploaded->status === 'rejected')
                                            <span class="text-xs px-2 py-0.5 bg-red-900/50 text-red-400 rounded border border-red-700">Rejeté</span>
                                        @else
                                            <span class="text-xs px-2 py-0.5 bg-yellow-900/50 text-yellow-400 rounded border border-yellow-700">En révision</span>
                                        @endif
                                    </div>
                                    @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                        <p class="text-sm text-red-400 mt-2 ml-7 bg-red-900/20 p-2 rounded">
                                            Raison : {{ $uploaded->rejection_reason }}
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <div class="flex gap-2 flex-shrink-0">
                                @if($uploaded)
                                    <a href="{{ route('visa.document.download', $uploaded->id) }}"
                                       class="px-3 py-2 text-sm text-blue-400 hover:text-blue-300 border border-blue-500/30 rounded-lg hover:bg-blue-500/10 transition">
                                        Télécharger
                                    </a>
                                    @if($uploaded->status !== 'approved')
                                        <button @click="deleteDocument('{{ $docType }}', {{ $uploaded->id }})"
                                                class="px-3 py-2 text-sm text-red-400 hover:text-red-300 border border-red-500/30 rounded-lg hover:bg-red-500/10 transition">
                                            Supprimer
                                        </button>
                                    @endif
                                @endif
                                @if(!$uploaded || $uploaded->status === 'rejected')
                                    <label class="btn-blue px-4 py-2 rounded-lg cursor-pointer text-sm">
                                        <input type="file" class="hidden"
                                               @change="uploadFile('{{ $docType }}', $event.target.files[0])"
                                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.webp">
                                        {{ $uploaded ? 'Remplacer' : 'Uploader' }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ── Submit ─────────────────────────────────────────────────── -->
        <div class="mb-8">
            @if(!$visa->student_submitted_at)
                <button @click="submitDossier"
                        class="w-full btn-gold py-4 rounded-xl text-lg font-bold"
                        :disabled="submitting">
                    <span x-show="!submitting" class="flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Soumettre mon dossier visa
                    </span>
                    <span x-show="submitting">Soumission en cours...</span>
                </button>
            @else
                <div class="text-center p-6 bg-green-900/20 border border-green-700 rounded-xl">
                    <svg class="w-12 h-12 mx-auto text-green-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-400 font-semibold">Dossier soumis le {{ $visa->student_submitted_at->format('d/m/Y à H:i') }}</p>
                    <p class="text-gray-400 text-sm mt-2">Notre équipe examinera votre dossier et vous contactera.</p>
                </div>
            @endif
        </div>

        <div class="text-center text-gray-600 text-sm">
            <p>Travel Express — Votre partenaire visa</p>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" :class="{ show: toast.show }">
        <div class="flex items-center gap-3">
            <div :class="toast.type === 'success' ? 'text-green-500' : 'text-red-500'">
                <svg x-show="toast.type === 'success'" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <svg x-show="toast.type === 'error'" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold gold-text" x-text="toast.title"></p>
                <p class="text-sm text-gray-400" x-text="toast.message"></p>
            </div>
        </div>
    </div>

    <script>
        function visaForm() {
            return {
                token: '{{ $visa->access_token ?? $visa->unique_token }}',
                saving: false,
                submitting: false,
                toast: { show: false, type: 'success', title: '', message: '' },
                info: {
                    student_name:    '{{ addslashes($visa->student_name ?? '') }}',
                    student_email:   '{{ addslashes($visa->student_email ?? '') }}',
                    student_phone:   '{{ addslashes($visa->student_phone ?? '') }}',
                    passport_number: '{{ addslashes($visa->passport_number ?? '') }}',
                },

                showToast(type, title, message) {
                    this.toast = { show: true, type, title, message };
                    setTimeout(() => this.toast.show = false, 5000);
                },

                async saveInfo() {
                    this.saving = true;
                    try {
                        const res = await fetch(`/visa/${this.token}/info`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify(this.info),
                        });
                        const data = await res.json();
                        if (res.ok) this.showToast('success', 'Enregistré', data.message);
                        else        this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                    } catch { this.showToast('error', 'Erreur', 'Impossible de sauvegarder'); }
                    this.saving = false;
                },

                async uploadFile(docType, file) {
                    if (!file) return;
                    const formData = new FormData();
                    formData.append('document_type', docType);
                    formData.append('file', file);
                    try {
                        const res = await fetch(`/visa/${this.token}/upload`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: formData,
                        });
                        const data = await res.json();
                        if (res.ok) {
                            this.showToast('success', 'Document uploadé', data.message);
                            document.getElementById('visa-percentage').textContent = data.completion_percentage + '%';
                            document.getElementById('visa-progress').style.width = data.completion_percentage + '%';
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                        }
                    } catch { this.showToast('error', 'Erreur', "Impossible d'uploader le document"); }
                },

                async deleteDocument(docType, documentId) {
                    if (!confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) return;
                    try {
                        const res = await fetch(`/visa/${this.token}/document/${documentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        });
                        const data = await res.json();
                        if (res.ok) {
                            this.showToast('success', 'Supprimé', data.message);
                            document.getElementById('visa-percentage').textContent = data.completion_percentage + '%';
                            document.getElementById('visa-progress').style.width = data.completion_percentage + '%';
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible de supprimer');
                        }
                    } catch { this.showToast('error', 'Erreur', 'Une erreur est survenue'); }
                },

                async submitDossier() {
                    if (!confirm('Confirmer la soumission de votre dossier visa ?')) return;
                    this.submitting = true;
                    try {
                        const res = await fetch(`/visa/${this.token}/submit`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        });
                        const data = await res.json();
                        if (res.ok) {
                            this.showToast('success', 'Soumis !', data.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible de soumettre');
                        }
                    } catch { this.showToast('error', 'Erreur', 'Une erreur est survenue'); }
                    this.submitting = false;
                },
            };
        }
    </script>
</body>
</html>
