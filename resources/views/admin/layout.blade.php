<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} - Travel Express</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 40% 20%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(139, 92, 246, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(236, 72, 153, 0.03) 0px, transparent 50%);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .elegant-card {
            background: linear-gradient(145deg, #ffffff 0%, #fafbfc 100%);
            border-radius: 1rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.02),
                0 8px 16px rgba(0, 0, 0, 0.04),
                0 16px 32px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .elegant-card:hover {
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.03),
                0 12px 24px rgba(0, 0, 0, 0.05),
                0 24px 48px rgba(0, 0, 0, 0.03);
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

        .fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased">
    <div class="min-h-screen">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content Area -->
        <div class="main-content lg:ml-72 min-h-screen flex flex-col transition-all duration-300">
            <!-- Header -->
            @include('admin.partials.header', [
                'title' => $title ?? 'Dashboard',
                'subtitle' => $subtitle ?? null,
                'showSearch' => $showSearch ?? false
            ])

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200 py-6 px-4 sm:px-6 lg:px-8 mt-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-600">
                        © {{ date('Y') }} Travel Express. Tous droits réservés.
                    </p>
                    <div class="flex items-center gap-4 text-sm text-slate-600">
                        <span class="text-slate-400">Version 2.0</span>
                        <span class="text-slate-300">|</span>
                        <a href="#" class="hover:text-indigo-600 transition-colors">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Global Scripts -->
    <script>
        // CSRF Token for API calls
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        // Helper function for API calls (uses session auth, no Bearer token needed)
        async function apiCall(url, options = {}) {
            const defaultOptions = {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin'
            };

            const mergedOptions = {
                ...defaultOptions,
                ...options,
                headers: {
                    ...defaultOptions.headers,
                    ...options.headers
                }
            };

            const response = await fetch(url, mergedOptions);
            if (!response.ok) {
                const error = await response.json().catch(() => ({ message: 'Une erreur est survenue' }));
                throw new Error(error.message || `HTTP ${response.status}`);
            }
            return response.json();
        }

        // Show/hide loading state
        function setLoading(elementId, loading) {
            const element = document.getElementById(elementId);
            if (!element) return;

            if (loading) {
                element.classList.add('opacity-50', 'pointer-events-none');
            } else {
                element.classList.remove('opacity-50', 'pointer-events-none');
            }
        }

        // Toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-2xl transform transition-all duration-300 translate-x-full flex items-center gap-3 max-w-md ${
                type === 'success' ? 'bg-gradient-to-r from-emerald-500 to-teal-600' :
                type === 'error' ? 'bg-gradient-to-r from-red-500 to-rose-600' :
                type === 'warning' ? 'bg-gradient-to-r from-amber-500 to-orange-600' :
                'bg-gradient-to-r from-indigo-500 to-purple-600'
            } text-white font-medium`;

            const icons = {
                success: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
                error: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
                warning: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                info: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            };

            toast.innerHTML = `${icons[type] || icons.info}<span>${message}</span>`;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Confirm dialog
        function confirmAction(message) {
            return confirm(message);
        }

        // Add fade-in animation to elements
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                }, index * 50);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
