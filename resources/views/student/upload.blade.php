<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Upload de documents - {{ $application->student_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .upload-zone {
            border: 2px dashed #cbd5e0;
            transition: all 0.3s;
        }
        .upload-zone.dragover {
            border-color: #4f46e5;
            background-color: #eef2ff;
        }
        .progress-bar {
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($application->student_name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $application->student_name }}</h1>
                    <p class="text-gray-600">Dossier de candidature - {{ ucfirst($application->program_type) }}</p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mt-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progression du dossier</span>
                    <span class="text-sm font-bold text-blue-600" id="progress-percentage">{{ $application->completion_percentage }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill" style="width: {{ $application->completion_percentage }}%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2" id="progress-text">
                    @if($application->is_complete)
                        Dossier complet! Vous pouvez soumettre votre candidature.
                    @else
                        Uploadez tous les documents requis pour compléter votre dossier.
                    @endif
                </p>
            </div>

            <!-- Status Badge -->
            <div class="mt-4">
                <span class="px-4 py-2 rounded-full text-sm font-medium
                    @if($application->status === 'approved') bg-green-100 text-green-800
                    @elseif($application->status === 'rejected') bg-red-100 text-red-800
                    @elseif($application->status === 'complete') bg-blue-100 text-blue-800
                    @elseif($application->status === 'incomplete') bg-yellow-100 text-yellow-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    @if($application->status === 'approved') ✓ Dossier approuvé
                    @elseif($application->status === 'rejected') ✗ Dossier rejeté
                    @elseif($application->status === 'complete') ✓ Dossier complet
                    @elseif($application->status === 'incomplete') En cours
                    @else En attente
                    @endif
                </span>
            </div>
        </div>

        <!-- Document Upload Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Documents requis</h2>

            <div class="space-y-4" id="documents-list">
                @foreach($requiredDocuments as $docType => $docLabel)
                    @php
                        $uploaded = $uploadedDocuments->get($docType);
                        $isOptional = in_array($docType, ['visite_medicale', 'test_anglais']);
                    @endphp
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors" data-doc-type="{{ $docType }}">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-gray-900">{{ $docLabel }}</h3>
                                    @if($isOptional)
                                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded">Optionnel</span>
                                    @endif
                                </div>

                                @if($uploaded)
                                    <div class="mt-2 flex items-center gap-3">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $uploaded->original_filename }}</span>
                                            <span class="text-gray-400">({{ $uploaded->file_size_human }})</span>
                                        </div>

                                        @if($uploaded->status === 'approved')
                                            <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">✓ Approuvé</span>
                                        @elseif($uploaded->status === 'rejected')
                                            <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded">✗ Rejeté</span>
                                            @if($uploaded->rejection_reason)
                                                <p class="text-sm text-red-600 mt-1">Raison: {{ $uploaded->rejection_reason }}</p>
                                            @endif
                                        @else
                                            <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded">En révision</span>
                                        @endif

                                        <div class="flex gap-2 ml-auto">
                                            <a href="{{ route('document.download', $uploaded->id) }}" class="text-blue-600 hover:text-blue-800 text-sm underline">Télécharger</a>
                                            <button onclick="deleteDocument('{{ $docType }}', {{ $uploaded->id }})" class="text-red-600 hover:text-red-800 text-sm underline">Supprimer</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <label for="file-{{ $docType }}" class="upload-zone block rounded-lg p-6 cursor-pointer hover:border-blue-400">
                                            <input type="file" id="file-{{ $docType }}" class="hidden" onchange="uploadFile('{{ $docType }}', this.files[0])" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                            <div class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-2 text-sm text-gray-600">
                                                    <span class="font-medium text-blue-600">Cliquez pour uploader</span> ou glissez-déposez
                                                </p>
                                                <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG, DOC (max 10MB)</p>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            @if($application->is_complete && !$application->submitted_at)
                <div class="mt-8 text-center">
                    <button onclick="submitApplication()" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg">
                        Soumettre mon dossier
                    </button>
                </div>
            @elseif($application->submitted_at)
                <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg text-center">
                    <p class="text-blue-800 font-medium">Dossier soumis le {{ $application->submitted_at->format('d/m/Y à H:i') }}</p>
                    <p class="text-blue-600 text-sm mt-1">Vous recevrez une notification par email dès que votre dossier sera examiné.</p>
                </div>
            @endif
        </div>

        <!-- Toast Notification -->
        <div id="toast" class="fixed top-4 right-4 bg-white rounded-lg shadow-xl p-4 transform translate-x-full transition-transform duration-300 z-50 max-w-sm">
            <div class="flex items-center gap-3">
                <div id="toast-icon" class="w-6 h-6"></div>
                <div>
                    <div id="toast-title" class="font-semibold text-gray-900"></div>
                    <div id="toast-message" class="text-sm text-gray-600"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const token = '{{ $application->unique_token }}';

        function showToast(type, title, message) {
            const toast = document.getElementById('toast');
            const icon = document.getElementById('toast-icon');
            const titleEl = document.getElementById('toast-title');
            const messageEl = document.getElementById('toast-message');

            const icons = {
                success: '<svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>',
                error: '<svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>'
            };

            icon.innerHTML = icons[type] || icons.success;
            titleEl.textContent = title;
            messageEl.textContent = message;

            toast.classList.remove('translate-x-full');
            setTimeout(() => {
                toast.classList.add('translate-x-full');
            }, 5000);
        }

        async function uploadFile(docType, file) {
            if (!file) return;

            const formData = new FormData();
            formData.append('document_type', docType);
            formData.append('file', file);

            try {
                const response = await fetch(`/student/upload/${token}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    showToast('success', 'Document uploadé', data.message);
                    updateProgress(data.completion_percentage);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                }
            } catch (error) {
                showToast('error', 'Erreur', 'Impossible d\'uploader le document');
            }
        }

        async function deleteDocument(docType, documentId) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce document?')) return;

            try {
                const response = await fetch(`/student/upload/${token}/document/${documentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showToast('success', 'Document supprimé', data.message);
                    updateProgress(data.completion_percentage);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast('error', 'Erreur', data.error || 'Impossible de supprimer le document');
                }
            } catch (error) {
                showToast('error', 'Erreur', 'Une erreur est survenue');
            }
        }

        async function submitApplication() {
            if (!confirm('Êtes-vous sûr de vouloir soumettre votre dossier? Vous pourrez toujours modifier vos documents après.')) return;

            try {
                const response = await fetch(`/student/upload/${token}/submit`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showToast('success', 'Dossier soumis!', data.message);
                    setTimeout(() => location.reload(), 2000);
                } else {
                    showToast('error', 'Erreur', data.error || 'Impossible de soumettre le dossier');
                }
            } catch (error) {
                showToast('error', 'Erreur', 'Une erreur est survenue');
            }
        }

        function updateProgress(percentage) {
            document.getElementById('progress-fill').style.width = percentage + '%';
            document.getElementById('progress-percentage').textContent = percentage + '%';

            if (percentage === 100) {
                document.getElementById('progress-text').textContent = 'Dossier complet! Vous pouvez soumettre votre candidature.';
            } else {
                document.getElementById('progress-text').textContent = 'Uploadez tous les documents requis pour compléter votre dossier.';
            }
        }

        // Drag and drop support
        document.querySelectorAll('.upload-zone').forEach(zone => {
            zone.addEventListener('dragover', (e) => {
                e.preventDefault();
                zone.classList.add('dragover');
            });

            zone.addEventListener('dragleave', () => {
                zone.classList.remove('dragover');
            });

            zone.addEventListener('drop', (e) => {
                e.preventDefault();
                zone.classList.remove('dragover');

                const docType = zone.closest('[data-doc-type]').dataset.docType;
                const file = e.dataTransfer.files[0];
                if (file) uploadFile(docType, file);
            });
        });
    </script>
</body>
</html>
