<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} - Travel Express</title>

    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"></noscript>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --gold: #d4af37;
            --gold-light: #f4e4bc;
            --gold-dark: #b8960c;
            --noir: #0a0a0a;
            --noir-light: #1a1a1a;
        }

        * { font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }

        body {
            background-color: var(--noir);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Loading overlay */
        .page-loading {
            position: fixed;
            inset: 0;
            background: var(--noir);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .page-loading.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(212, 175, 55, 0.1);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Elegant card */
        .elegant-card {
            background: linear-gradient(145deg, var(--noir-light) 0%, var(--noir) 100%);
            border-radius: 1rem;
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .elegant-card:hover {
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        /* Quick fade animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in { animation: fadeIn 0.3s ease forwards; }
    </style>

    @stack('styles')
</head>
<body class="antialiased">
    <!-- Page Loading Overlay -->
    <div id="page-loading" class="page-loading">
        <div class="loading-spinner"></div>
    </div>

    <div class="min-h-screen">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content Area -->
        <div class="main-content min-h-screen flex flex-col transition-all duration-300" style="margin-left: 0;" id="main-content">
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
            <footer class="bg-[#0a0a0a] border-t border-[#d4af37]/10 py-4 px-4 sm:px-6 lg:px-8 mt-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} Travel Express. Tous droits reserves.
                    </p>
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="text-[#d4af37]">Version 2.0</span>
                        <span class="text-gray-700">|</span>
                        <a href="#" class="hover:text-[#d4af37] transition-colors">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Global Scripts -->
    <script>
        // Hide loading overlay when page is ready
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loading');
            if (loader) {
                loader.classList.add('hidden');
                setTimeout(() => loader.remove(), 300);
            }
        });

        // CSRF Token for API calls
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        // Optimized API call helper with caching
        const apiCache = new Map();
        const CACHE_DURATION = 30000; // 30 seconds

        async function apiCall(url, options = {}) {
            const cacheKey = `${options.method || 'GET'}_${url}`;
            const useCache = (!options.method || options.method === 'GET') && !options.noCache;

            // Check cache for GET requests
            if (useCache && apiCache.has(cacheKey)) {
                const cached = apiCache.get(cacheKey);
                if (Date.now() - cached.timestamp < CACHE_DURATION) {
                    return cached.data;
                }
                apiCache.delete(cacheKey);
            }

            const defaultOptions = {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin'
            };

            // Remove noCache from options before merging
            const { noCache, ...restOptions } = options;

            const mergedOptions = {
                ...defaultOptions,
                ...restOptions,
                headers: { ...defaultOptions.headers, ...(restOptions.headers || {}) }
            };

            const response = await fetch(url, mergedOptions);
            if (!response.ok) {
                const error = await response.json().catch(() => ({ message: 'Une erreur est survenue' }));
                throw new Error(error.message || `HTTP ${response.status}`);
            }

            const data = await response.json();

            // Cache GET requests only if we have data
            if (useCache && data && (data.data?.length > 0 || data.data?.total > 0 || typeof data.data === 'object')) {
                apiCache.set(cacheKey, { data, timestamp: Date.now() });
            }

            return data;
        }

        // Clear cache for specific URL pattern
        function clearApiCache(pattern) {
            if (!pattern) {
                apiCache.clear();
                return;
            }
            for (const key of apiCache.keys()) {
                if (key.includes(pattern)) {
                    apiCache.delete(key);
                }
            }
        }

        // Toast notification (simplified)
        function showToast(message, type = 'success') {
            const colors = {
                success: 'from-emerald-500 to-emerald-700',
                error: 'from-red-500 to-red-700',
                warning: 'from-amber-500 to-amber-700',
                info: 'from-[#d4af37] to-[#b8960c]'
            };

            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-2xl bg-gradient-to-r ${colors[type] || colors.info} text-white font-medium transform transition-transform duration-300 translate-x-full`;
            toast.textContent = message;

            document.body.appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-x-full'));

            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Set initial margin for main content
        document.addEventListener('DOMContentLoaded', () => {
            const mainContent = document.getElementById('main-content');
            if (mainContent && window.innerWidth >= 1024) {
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                mainContent.style.marginLeft = isCollapsed ? '4.5rem' : '16rem';
            }
        });

        // Handle responsive margin on resize (debounced)
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const mainContent = document.getElementById('main-content');
                if (mainContent) {
                    if (window.innerWidth >= 1024) {
                        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                        mainContent.style.marginLeft = isCollapsed ? '4.5rem' : '16rem';
                    } else {
                        mainContent.style.marginLeft = '0';
                    }
                }
            }, 100);
        });
    </script>

    @stack('scripts')
</body>
</html>
