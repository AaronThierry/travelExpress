<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dossier de candidature - Travel Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gold: #D4AF37;
            --gold-light: #F4E5B2;
            --black: #0a0a0a;
            --gray-dark: #1a1a1a;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
        }

        .gold-text { color: var(--gold); }
        .gold-bg { background-color: var(--gold); }
        .gold-border { border-color: var(--gold); }

        .card {
            background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .card:hover {
            border-color: rgba(212, 175, 55, 0.4);
        }

        .upload-zone {
            border: 2px dashed rgba(212, 175, 55, 0.3);
            background: rgba(212, 175, 55, 0.05);
            transition: all 0.3s;
        }

        .upload-zone:hover, .upload-zone.dragover {
            border-color: var(--gold);
            background: rgba(212, 175, 55, 0.1);
        }

        .progress-bar {
            height: 8px;
            background-color: rgba(212, 175, 55, 0.2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #D4AF37 0%, #F4E5B2 50%, #D4AF37 100%);
            transition: width 0.5s ease;
        }

        .btn-gold {
            background: linear-gradient(135deg, #D4AF37 0%, #B8960C 100%);
            color: #0a0a0a;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #F4E5B2 0%, #D4AF37 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .input-dark {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.2);
            color: white;
        }

        .input-dark:focus {
            border-color: var(--gold);
            outline: none;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .input-dark::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s;
        }

        .step.active {
            background: linear-gradient(135deg, #D4AF37 0%, #B8960C 100%);
            color: #0a0a0a;
        }

        .step.completed {
            background: #22c55e;
            color: white;
        }

        .step.pending {
            background: rgba(212, 175, 55, 0.2);
            color: rgba(212, 175, 55, 0.6);
        }

        .step-line {
            width: 60px;
            height: 2px;
            background: rgba(212, 175, 55, 0.2);
        }

        .step-line.active {
            background: var(--gold);
        }

        .tabs {
            display: flex;
            gap: 1rem;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            margin-bottom: 1.5rem;
        }

        .tab {
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.6);
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
        }

        .tab:hover {
            color: var(--gold);
        }

        .tab.active {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }

        .doc-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(212, 175, 55, 0.1);
            border-radius: 0.75rem;
            padding: 1rem;
            transition: all 0.3s;
        }

        .doc-item:hover {
            border-color: rgba(212, 175, 55, 0.3);
            background: rgba(212, 175, 55, 0.05);
        }

        .toast {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 0.75rem;
            padding: 1rem;
            transform: translateX(120%);
            transition: transform 0.3s;
            z-index: 50;
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
        }
    </style>
</head>
<body class="min-h-screen text-white" x-data="studentForm()">
    <!-- Background Pattern -->
    <div class="fixed inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23D4AF37\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="card rounded-2xl p-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <!-- Logo & Title -->
                <div class="flex items-center gap-4 flex-1">
                    <div class="w-16 h-16 gold-bg rounded-full flex items-center justify-center text-black text-2xl font-bold shadow-lg">
                        @if($application->student_name)
                            {{ strtoupper(substr($application->student_name, 0, 1)) }}
                        @else
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold gold-text">
                            {{ $application->student_name ?? 'Nouveau Dossier' }}
                        </h1>
                        <p class="text-gray-400">
                            Dossier {{ $application->dossier_type === 'complementaire' ? 'Complémentaire' : 'Initial' }}
                            - Programme {{ ucfirst($application->program_type) }}
                        </p>
                    </div>
                </div>

                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step {{ $application->current_step >= 1 ? ($application->current_step > 1 ? 'completed' : 'active') : 'pending' }}">
                        @if($application->current_step > 1)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        @else
                            1
                        @endif
                    </div>
                    <div class="step-line {{ $application->current_step > 1 ? 'active' : '' }}"></div>
                    <div class="step {{ $application->current_step >= 2 ? ($application->current_step > 2 ? 'completed' : 'active') : 'pending' }}">
                        @if($application->current_step > 2)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        @else
                            2
                        @endif
                    </div>
                    <div class="step-line {{ $application->current_step > 2 ? 'active' : '' }}"></div>
                    <div class="step {{ $application->current_step >= 3 ? 'active' : 'pending' }}">3</div>
                </div>
            </div>

            <!-- Progress Bars -->
            <div class="mt-8 grid md:grid-cols-2 gap-6">
                <!-- Initial Progress -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-400">Dossier Initial</span>
                        <span class="text-sm font-bold gold-text" id="initial-percentage">{{ $application->completion_percentage }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="initial-progress" style="width: {{ $application->completion_percentage }}%"></div>
                    </div>
                </div>

                <!-- Complementary Progress -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-400">Dossier Complémentaire</span>
                        <span class="text-sm font-bold gold-text" id="comp-percentage">{{ $application->complementary_completion_percentage }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="comp-progress" style="width: {{ $application->complementary_completion_percentage }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="mt-6 flex flex-wrap gap-3">
                @php
                    $statusInfo = $application->status_info;
                    $compStatusInfo = $application->complementary_status_info;
                @endphp
                <span class="px-4 py-2 rounded-full text-sm font-medium border
                    @if($statusInfo['color'] === 'green') border-green-500 text-green-400 bg-green-500/10
                    @elseif($statusInfo['color'] === 'red') border-red-500 text-red-400 bg-red-500/10
                    @elseif($statusInfo['color'] === 'blue') border-blue-500 text-blue-400 bg-blue-500/10
                    @elseif($statusInfo['color'] === 'yellow') border-yellow-500 text-yellow-400 bg-yellow-500/10
                    @else border-gray-500 text-gray-400 bg-gray-500/10
                    @endif">
                    Initial: {{ $statusInfo['label'] }}
                </span>
                <span class="px-4 py-2 rounded-full text-sm font-medium border
                    @if($compStatusInfo['color'] === 'green') border-green-500 text-green-400 bg-green-500/10
                    @elseif($compStatusInfo['color'] === 'red') border-red-500 text-red-400 bg-red-500/10
                    @elseif($compStatusInfo['color'] === 'blue') border-blue-500 text-blue-400 bg-blue-500/10
                    @elseif($compStatusInfo['color'] === 'yellow') border-yellow-500 text-yellow-400 bg-yellow-500/10
                    @else border-gray-500 text-gray-400 bg-gray-500/10
                    @endif">
                    Complémentaire: {{ $compStatusInfo['label'] }}
                </span>
            </div>
        </div>

        <!-- Student Information Form -->
        <div class="card rounded-2xl p-8 mb-8">
            <h2 class="text-xl font-bold gold-text mb-6 flex items-center gap-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                Informations personnelles
            </h2>

            <form @submit.prevent="saveInfo" class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Nom complet *</label>
                    <input type="text" x-model="info.student_name" required
                           class="w-full px-4 py-3 rounded-lg input-dark"
                           placeholder="Votre nom complet">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Email *</label>
                    <input type="email" x-model="info.student_email" required
                           class="w-full px-4 py-3 rounded-lg input-dark"
                           placeholder="votre@email.com">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Téléphone</label>
                    <input type="tel" x-model="info.student_phone"
                           class="w-full px-4 py-3 rounded-lg input-dark"
                           placeholder="+226 XX XX XX XX">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Numéro de passeport</label>
                    <input type="text" x-model="info.passport_number"
                           class="w-full px-4 py-3 rounded-lg input-dark"
                           placeholder="Numéro de passeport">
                </div>

                @if($application->dossier_type === 'complementaire' || $application->current_step >= 2)
                <div class="md:col-span-2">
                    <hr class="border-gray-800 my-4">
                    <h3 class="text-lg font-semibold gold-text mb-4">Informations complémentaires</h3>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Visa actuel</label>
                    <input type="text" x-model="info.visa_current"
                           class="w-full px-4 py-3 rounded-lg input-dark"
                           placeholder="Type et numéro de visa">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Numéro chinois</label>
                    <input type="text" x-model="info.numero_chinois"
                           class="w-full px-4 py-3 rounded-lg input-dark"
                           placeholder="Votre numéro d'étudiant chinois">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-400 mb-2">Informations complémentaires</label>
                    <textarea x-model="info.complement_application" rows="3"
                              class="w-full px-4 py-3 rounded-lg input-dark"
                              placeholder="Ajoutez toute information pertinente..."></textarea>
                </div>
                @endif

                <div class="md:col-span-2">
                    <button type="submit" class="btn-gold px-6 py-3 rounded-lg" :disabled="saving">
                        <span x-show="!saving">Enregistrer les informations</span>
                        <span x-show="saving">Enregistrement...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Documents Section -->
        <div class="card rounded-2xl p-8">
            <h2 class="text-xl font-bold gold-text mb-6 flex items-center gap-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
                Documents requis
            </h2>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab" :class="{ active: activeTab === 'initial' }" @click="activeTab = 'initial'">
                    Dossier Initial ({{ count($requiredDocuments) }})
                </button>
                <button class="tab" :class="{ active: activeTab === 'complementary' }" @click="activeTab = 'complementary'">
                    Dossier Complémentaire ({{ count($complementaryDocuments) }})
                </button>
            </div>

            <!-- Initial Documents -->
            <div x-show="activeTab === 'initial'" class="space-y-4">
                @foreach($requiredDocuments as $docType => $docLabel)
                    @php
                        $uploaded = $uploadedDocuments->get($docType);
                        $isOptional = in_array($docType, ['certificat_anglais', 'test_csca']);
                    @endphp
                    <div class="doc-item" data-doc-type="{{ $docType }}">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-white">{{ $docLabel }}</h3>
                                    @if($isOptional)
                                        <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded">Optionnel</span>
                                    @endif
                                </div>

                                @if($uploaded)
                                    <div class="mt-2 flex flex-wrap items-center gap-3">
                                        <div class="flex items-center gap-2 text-sm text-gray-400">
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $uploaded->original_filename }}</span>
                                        </div>

                                        @if($uploaded->status === 'approved')
                                            <span class="text-xs px-2 py-1 bg-green-900/50 text-green-400 rounded border border-green-700">Approuvé</span>
                                        @elseif($uploaded->status === 'rejected')
                                            <span class="text-xs px-2 py-1 bg-red-900/50 text-red-400 rounded border border-red-700">Rejeté</span>
                                        @else
                                            <span class="text-xs px-2 py-1 bg-yellow-900/50 text-yellow-400 rounded border border-yellow-700">En révision</span>
                                        @endif
                                    </div>

                                    @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                        <p class="text-sm text-red-400 mt-2 bg-red-900/20 p-2 rounded">
                                            Raison: {{ $uploaded->rejection_reason }}
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <div class="flex gap-2">
                                @if($uploaded)
                                    <a href="{{ route('document.download', $uploaded->id) }}" class="px-3 py-2 text-sm text-blue-400 hover:text-blue-300 border border-blue-500/30 rounded-lg hover:bg-blue-500/10 transition">
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
                                    <label class="btn-gold px-4 py-2 rounded-lg cursor-pointer text-sm">
                                        <input type="file" class="hidden" @change="uploadFile('{{ $docType }}', $event.target.files[0])" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                        {{ $uploaded ? 'Remplacer' : 'Uploader' }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Complementary Documents -->
            <div x-show="activeTab === 'complementary'" class="space-y-4">
                @foreach($complementaryDocuments as $docType => $docLabel)
                    @php
                        $uploaded = $uploadedDocuments->get($docType);
                        $isOptional = false;
                    @endphp
                    <div class="doc-item" data-doc-type="{{ $docType }}">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-white">{{ $docLabel }}</h3>
                                    @if($isOptional)
                                        <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded">Optionnel</span>
                                    @endif
                                </div>

                                @if($uploaded)
                                    <div class="mt-2 flex flex-wrap items-center gap-3">
                                        <div class="flex items-center gap-2 text-sm text-gray-400">
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $uploaded->original_filename }}</span>
                                        </div>

                                        @if($uploaded->status === 'approved')
                                            <span class="text-xs px-2 py-1 bg-green-900/50 text-green-400 rounded border border-green-700">Approuvé</span>
                                        @elseif($uploaded->status === 'rejected')
                                            <span class="text-xs px-2 py-1 bg-red-900/50 text-red-400 rounded border border-red-700">Rejeté</span>
                                        @else
                                            <span class="text-xs px-2 py-1 bg-yellow-900/50 text-yellow-400 rounded border border-yellow-700">En révision</span>
                                        @endif
                                    </div>

                                    @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                        <p class="text-sm text-red-400 mt-2 bg-red-900/20 p-2 rounded">
                                            Raison: {{ $uploaded->rejection_reason }}
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <div class="flex gap-2">
                                @if($uploaded)
                                    <a href="{{ route('document.download', $uploaded->id) }}" class="px-3 py-2 text-sm text-blue-400 hover:text-blue-300 border border-blue-500/30 rounded-lg hover:bg-blue-500/10 transition">
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
                                    <label class="btn-gold px-4 py-2 rounded-lg cursor-pointer text-sm">
                                        <input type="file" class="hidden" @change="uploadFile('{{ $docType }}', $event.target.files[0])" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                        {{ $uploaded ? 'Remplacer' : 'Uploader' }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-8 pt-6 border-t border-gray-800">
                @if(!$application->student_submitted_at)
                    <button @click="submitApplication"
                            class="w-full btn-gold py-4 rounded-xl text-lg font-bold"
                            :disabled="submitting">
                        <span x-show="!submitting" class="flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Soumettre mon dossier
                        </span>
                        <span x-show="submitting">Soumission en cours...</span>
                    </button>
                @else
                    <div class="text-center p-6 bg-green-900/20 border border-green-700 rounded-xl">
                        <svg class="w-12 h-12 mx-auto text-green-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-400 font-semibold">Dossier soumis le {{ $application->student_submitted_at->format('d/m/Y à H:i') }}</p>
                        <p class="text-gray-400 text-sm mt-2">Vous recevrez une notification par email dès que votre dossier sera examiné.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>Travel Express - Votre partenaire pour les études à l'étranger</p>
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
        function studentForm() {
            return {
                token: '{{ $application->access_token ?? $application->unique_token }}',
                activeTab: '{{ $application->dossier_type === "complementaire" ? "complementary" : "initial" }}',
                saving: false,
                submitting: false,
                toast: {
                    show: false,
                    type: 'success',
                    title: '',
                    message: ''
                },
                info: {
                    student_name: '{{ $application->student_name ?? "" }}',
                    student_email: '{{ $application->student_email ?? "" }}',
                    student_phone: '{{ $application->student_phone ?? "" }}',
                    passport_number: '{{ $application->passport_number ?? "" }}',
                    visa_current: '{{ $application->visa_current ?? "" }}',
                    numero_chinois: '{{ $application->numero_chinois ?? "" }}',
                    complement_application: '{{ $application->complement_application ?? "" }}'
                },
                requiredDocuments: @json($requiredDocuments),
                complementaryDocuments: @json($complementaryDocuments),

                showToast(type, title, message) {
                    this.toast = { show: true, type, title, message };
                    setTimeout(() => this.toast.show = false, 5000);
                },

                async saveInfo() {
                    this.saving = true;
                    try {
                        const response = await fetch(`/dossier/${this.token}/info`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.info)
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.showToast('success', 'Enregistré', data.message);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                        }
                    } catch (error) {
                        this.showToast('error', 'Erreur', 'Impossible de sauvegarder');
                    }
                    this.saving = false;
                },

                async uploadFile(docType, file) {
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('document_type', docType);
                    formData.append('file', file);

                    try {
                        const response = await fetch(`/dossier/${this.token}/upload`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.showToast('success', 'Document uploadé', data.message);
                            this.updateProgress(data.completion_percentage, data.complementary_completion_percentage);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                        }
                    } catch (error) {
                        this.showToast('error', 'Erreur', 'Impossible d\'uploader le document');
                    }
                },

                async deleteDocument(docType, documentId) {
                    if (!confirm('Êtes-vous sûr de vouloir supprimer ce document?')) return;

                    try {
                        const response = await fetch(`/dossier/${this.token}/document/${documentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.showToast('success', 'Supprimé', data.message);
                            this.updateProgress(data.completion_percentage, data.complementary_completion_percentage);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible de supprimer');
                        }
                    } catch (error) {
                        this.showToast('error', 'Erreur', 'Une erreur est survenue');
                    }
                },

                async submitApplication() {
                    if (!confirm('Êtes-vous sûr de vouloir soumettre votre dossier?')) return;

                    this.submitting = true;
                    try {
                        const response = await fetch(`/dossier/${this.token}/submit`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.showToast('success', 'Soumis!', data.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible de soumettre');
                        }
                    } catch (error) {
                        this.showToast('error', 'Erreur', 'Une erreur est survenue');
                    }
                    this.submitting = false;
                },

                updateProgress(initial, complementary) {
                    document.getElementById('initial-percentage').textContent = initial + '%';
                    document.getElementById('initial-progress').style.width = initial + '%';
                    document.getElementById('comp-percentage').textContent = complementary + '%';
                    document.getElementById('comp-progress').style.width = complementary + '%';
                }
            };
        }
    </script>
</body>
</html>
