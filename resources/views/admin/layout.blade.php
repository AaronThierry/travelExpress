<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} - Travel Express</title>
    <link rel="icon" type="image/png" href="/images/logo/logo_travel.png">
    <link rel="shortcut icon" type="image/png" href="/images/logo/logo_travel.png">

    <!-- Royal Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Royal Design System ────────────────────────────────── */
        :root {
            --gold-primary:  #C9A84C;
            --gold-bright:   #F0D07A;
            --gold-deep:     #8B6914;
            --gold-gradient: linear-gradient(135deg, #8B6914 0%, #C9A84C 30%, #F0D07A 50%, #C9A84C 70%, #8B6914 100%);
            --dark-0:   #080808;
            --dark-50:  #0D0D0D;
            --dark-100: #141414;
            --dark-200: #1C1C1C;
            --dark-300: #262626;
            --dark-400: #333333;
            --dark-500: #4A4A4A;
            --dark-600: #6B6B6B;
            --dark-700: #8A8A8A;
            --dark-800: #B0B0B0;
            --dark-900: #D4D4D4;
            --glow-gold:        0 0 20px rgba(201,168,76,.25), 0 0 60px rgba(201,168,76,.08);
            --glow-gold-strong: 0 0 30px rgba(201,168,76,.4),  0 0 80px rgba(201,168,76,.15);
            --r-sm:   3px;
            --r-md:   6px;
            --r-lg:   10px;
            --r-xl:   14px;
            --r-full: 9999px;
            --font-display: 'Bebas Neue', sans-serif;
            --font-serif:   'Cormorant Garamond', Georgia, serif;
            --font-body:    'Lato', sans-serif;
            --color-success: #2ECABB;
            --color-warning: #F0B428;
            --color-danger:  #E74C3C;
            /* Compatibility aliases */
            --gold:     #C9A84C;
            --gold-line: rgba(201,168,76,.18);
            --gold-dim:  rgba(201,168,76,.08);
            --bg:        #080808;
            --bg-card:   #141414;
            --text:      #D4D4D4;
            --text-muted:#6B6B6B;
        }

        *, *::before, *::after { box-sizing: border-box; }

        * {
            font-family: var(--font-body);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-serif);
        }

        body {
            background-color: var(--dark-0);
            color: var(--dark-900);
            margin: 0;
        }

        /* ── Scrollbar ──────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-100); }
        ::-webkit-scrollbar-thumb { background: var(--gold-deep); border-radius: var(--r-full); }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold-primary); }

        /* ── Loading overlay ────────────────────────────────────── */
        .page-loading {
            position: fixed;
            inset: 0;
            background: var(--dark-0);
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
            border: 3px solid rgba(201,168,76,.12);
            border-top-color: var(--gold-primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Cards ──────────────────────────────────────────────── */
        .elegant-card {
            background: var(--dark-100);
            border-radius: var(--r-xl);
            border: 1px solid rgba(201,168,76,.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .elegant-card:hover {
            border-color: rgba(201,168,76,.25);
            box-shadow: var(--glow-gold);
        }

        /* ── KPI cards ──────────────────────────────────────────── */
        .kpi-card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.1);
            border-radius: var(--r-xl);
            overflow: hidden;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .kpi-card:hover {
            border-color: rgba(201,168,76,.25);
            box-shadow: var(--glow-gold);
        }

        .kpi-card-bar {
            height: 3px;
            background: var(--gold-gradient);
        }

        .kpi-number {
            font-family: var(--font-display);
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        /* ── Tables ─────────────────────────────────────────────── */
        .royal-table { width: 100%; border-collapse: collapse; }

        .royal-table thead tr {
            background: rgba(201,168,76,.06);
        }

        .royal-table th {
            color: var(--gold-deep);
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.875rem 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(201,168,76,.12);
        }

        .royal-table td {
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            color: var(--dark-800);
            border-bottom: 1px solid rgba(255,255,255,.03);
        }

        .royal-table tbody tr {
            transition: background 0.15s ease;
        }

        .royal-table tbody tr:hover {
            background: rgba(201,168,76,.04);
        }

        /* ── Buttons ─────────────────────────────────────────────── */
        .btn-royal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.55rem 1.25rem;
            background: var(--gold-gradient);
            color: #080808;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border: none;
            border-radius: var(--r-md);
            cursor: pointer;
            transition: opacity 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-royal:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(201,168,76,.3);
        }

        .btn-royal:active { transform: translateY(0); }
        .btn-royal:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }

        .btn-ghost-royal {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border: 1px solid var(--gold-line);
            color: var(--gold-primary);
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: var(--r-md);
            cursor: pointer;
            background: none;
            transition: background 0.2s, border-color 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-ghost-royal:hover {
            background: var(--gold-dim);
            border-color: rgba(201,168,76,.35);
        }

        /* ── Main content area ──────────────────────────────────── */
        .main-content {
            background: var(--dark-0);
        }

        /* ── Page header ────────────────────────────────────────── */
        .page-header-royal {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(8,8,8,.95);
            border-bottom: 1px solid rgba(201,168,76,.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* ── Animations ─────────────────────────────────────────── */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-in { animation: fadeIn 0.35s ease forwards; }

        /* ── Section label ──────────────────────────────────────── */
        .section-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--dark-600);
            padding: 0 0.75rem;
            margin: 1rem 0 0.35rem;
        }

        /* ── Status pills ────────────────────────────────────────── */
        .pill-royal {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.65rem;
            border-radius: var(--r-full);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            border: 1px solid;
        }

        .pill-success { color: var(--color-success); border-color: rgba(46,202,187,.25); background: rgba(46,202,187,.08); }
        .pill-warning { color: var(--color-warning); border-color: rgba(240,180,40,.25); background: rgba(240,180,40,.08); }
        .pill-danger  { color: var(--color-danger);  border-color: rgba(231,76,60,.25);  background: rgba(231,76,60,.08);  }
        .pill-gold    { color: var(--gold-primary);  border-color: var(--gold-line);     background: var(--gold-dim);     }
        .pill-muted   { color: var(--dark-600);      border-color: rgba(255,255,255,.08); background: rgba(255,255,255,.03); }

        /* ── Gold gradient text utility ─────────────────────────── */
        .text-gold-gradient {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Footer ─────────────────────────────────────────────── */
        .royal-footer {
            background: var(--dark-50);
            border-top: 1px solid rgba(201,168,76,.1);
        }
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
                'title'      => $title      ?? 'Dashboard',
                'subtitle'   => $subtitle   ?? null,
                'showSearch' => $showSearch  ?? false
            ])

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="royal-footer py-4 px-4 sm:px-6 lg:px-8 mt-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm" style="color: var(--dark-600);">
                        &copy; {{ date('Y') }} Travel Express. Tous droits réservés.
                    </p>
                    <div class="flex items-center gap-4 text-sm" style="color: var(--dark-600);">
                        <span style="color: var(--gold-primary); font-family: var(--font-display); font-size: 1rem; letter-spacing: 0.08em;">Version 2.0</span>
                        <span style="color: var(--dark-400);">|</span>
                        <a href="#" style="color: var(--dark-600); transition: color 0.2s; text-decoration: none;"
                           onmouseover="this.style.color='var(--gold-primary)'" onmouseout="this.style.color='var(--dark-600)'">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Global Scripts -->
    <script>
        // Global auth token for API calls (must be defined before page scripts)
        window.authToken = localStorage.getItem('auth_token');
        if (!window.authToken) {
            // Token absent → redirect to login
            window.location.href = '/login';
        }

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

        // Toast notification — Royal style
        function showToast(message, type = 'success') {
            const colorMap = {
                success: { bg: 'var(--color-success)',  border: 'rgba(46,202,187,.3)' },
                error:   { bg: 'var(--color-danger)',   border: 'rgba(231,76,60,.3)'  },
                warning: { bg: 'var(--color-warning)',  border: 'rgba(240,180,40,.3)' },
                info:    { bg: 'var(--gold-primary)',   border: 'var(--gold-line)'    },
            };
            const c = colorMap[type] || colorMap.info;

            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed; top: 1.25rem; right: 1.25rem; z-index: 9999;
                padding: 0.875rem 1.25rem;
                background: var(--dark-100);
                border: 1px solid ${c.border};
                border-left: 3px solid ${c.bg};
                border-radius: var(--r-lg);
                color: var(--dark-900);
                font-family: var(--font-body);
                font-size: 0.875rem;
                font-weight: 500;
                box-shadow: 0 8px 32px rgba(0,0,0,.6);
                transform: translateX(120%);
                transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
                max-width: 320px;
            `;
            toast.textContent = message;
            document.body.appendChild(toast);
            requestAnimationFrame(() => { toast.style.transform = 'translateX(0)'; });

            setTimeout(() => {
                toast.style.transform = 'translateX(120%)';
                setTimeout(() => toast.remove(), 350);
            }, 3500);
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
