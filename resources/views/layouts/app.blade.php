<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Manajemen Kos & Properti')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --canvas: #f8fafc;
            --surface: #ffffff;
            --surface-muted: #f1f5f9;
            --border: #e2e8f0;
            --border-focus: #cbd5e1;
            --text-heading: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --primary: #c2410c;
            --primary-hover: #ea580c;
            --primary-light: #fff7ed;
            --danger: #b91c1c;
            --danger-light: #fef2f2;
            --success: #047857;
            --success-light: #ecfdf5;
            --warning: #b45309;
            --warning-light: #fffbeb;
            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --shadow-subtle: 0 1px 3px rgba(15, 23, 42, 0.05);
            --shadow-card: 0 2px 8px -2px rgba(15, 23, 42, 0.06), 0 1px 4px -1px rgba(15, 23, 42, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--canvas);
            color: var(--text-body);
            line-height: 1.5;
            font-size: 14px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .navbar {
            background-color: #0f172a;
            color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: -0.01em;
        }

        .navbar-brand-badge {
            background-color: var(--primary);
            color: #ffffff;
            padding: 2px 7px;
            font-size: 0.72rem;
            font-weight: 700;
            border-radius: var(--radius-sm);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-sm);
            transition: color 0.15s ease, background-color 0.15s ease;
        }

        .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.06);
        }

        .nav-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.12);
            font-weight: 600;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-info {
            text-align: right;
            line-height: 1.25;
        }

        .user-name {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: #f1f5f9;
        }

        .role-badge {
            display: inline-block;
            padding: 2px 8px;
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .role-badge.admin {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .role-badge.staff {
            background-color: #fef3c7;
            color: #92400e;
        }

        .role-badge.penghuni {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .btn-logout {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #e2e8f0;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.4rem 0.75rem;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-logout:hover {
            background-color: var(--danger);
            border-color: var(--danger);
            color: #ffffff;
        }

        /* Mobile Hamburger */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 0.4rem;
        }

        /* Main Content Container */
        .main-wrapper {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 1.75rem 1.25rem 3rem 1.25rem;
            flex: 1;
        }

        /* Flash Notifications */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            line-height: 1.4;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: var(--success-light);
            color: var(--success);
            border-color: #a7f3d0;
        }

        .alert-error {
            background-color: var(--danger-light);
            color: var(--danger);
            border-color: #fecaca;
        }

        .alert-warning {
            background-color: var(--warning-light);
            color: var(--warning);
            border-color: #fde68a;
        }

        /* Breadcrumbs / Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-heading);
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
        }

        .page-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.55rem 1rem;
            border-radius: var(--radius-sm);
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
            line-height: 1.25;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--surface);
            color: var(--text-body);
            border-color: var(--border);
        }

        .btn-secondary:hover {
            background-color: var(--surface-muted);
            border-color: var(--border-focus);
        }

        .btn-danger {
            background-color: var(--danger);
            color: #ffffff;
            border-color: var(--danger);
        }

        .btn-danger:hover {
            background-color: #991b1b;
        }

        .btn-sm {
            padding: 0.35rem 0.65rem;
            font-size: 0.78rem;
        }

        /* Cards & Panels */
        .card {
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-subtle);
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            background-color: #ffffff;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-heading);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Data Tables */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table.data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.85rem;
            text-align: left;
        }

        table.data-table th {
            background-color: var(--surface-muted);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.04em;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        table.data-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-body);
            vertical-align: middle;
        }

        table.data-table tbody tr:hover td {
            background-color: #fafbfc;
        }

        table.data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            white-space: nowrap;
        }

        .badge-success {
            background-color: var(--success-light);
            color: var(--success);
        }

        .badge-danger {
            background-color: var(--danger-light);
            color: var(--danger);
        }

        .badge-warning {
            background-color: var(--warning-light);
            color: var(--warning);
        }

        .badge-slate {
            background-color: var(--surface-muted);
            color: var(--text-muted);
        }

        .badge-primary {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.15rem;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-heading);
            margin-bottom: 0.4rem;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.55rem 0.85rem;
            font-size: 0.875rem;
            font-family: inherit;
            color: var(--text-heading);
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.15);
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .form-error {
            font-size: 0.75rem;
            color: var(--danger);
            margin-top: 0.35rem;
        }

        /* Footer */
        .footer {
            background-color: var(--surface);
            border-top: 1px solid var(--border);
            padding: 1.25rem 0;
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: auto;
        }

        /* Responsive Breakpoints */
        @media (max-width: 900px) {
            .mobile-toggle {
                display: block;
            }

            .navbar-nav {
                display: none;
                position: absolute;
                top: 64px;
                left: 0;
                right: 0;
                background-color: #0f172a;
                flex-direction: column;
                padding: 1rem 1.25rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                gap: 0.5rem;
            }

            .navbar-nav.show {
                display: flex;
            }

            .user-info {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <span>🏠 Kos &amp; Properti</span>
                <span class="navbar-brand-badge">Sistem Terpadu</span>
            </a>

            <button class="mobile-toggle" onclick="toggleNav()" aria-label="Toggle Navigation">☰</button>

            <ul class="navbar-nav" id="mainNav">
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('kamars.index') }}" class="nav-link {{ request()->routeIs('kamars.*') ? 'active' : '' }}">
                        Master Kamar
                    </a>
                </li>
                <li>
                    <a href="{{ route('penghuni.index') }}" class="nav-link {{ request()->routeIs('penghuni.*') ? 'active' : '' }}">
                        {{ Auth::check() && Auth::user()->isPenghuni() ? 'Hunian Saya' : 'Data Penghuni' }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.index') }}" class="nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                        Housekeeper
                    </a>
                </li>
                <li>
                    <a href="{{ route('asets.index') }}" class="nav-link {{ request()->routeIs('asets.*') ? 'active' : '' }}">
                        Inventaris Aset
                    </a>
                </li>
            </ul>

            <div class="navbar-user">
                @auth
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="role-badge {{ Auth::user()->role }}">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout" title="Keluar dari akun">
                            Keluar
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="main-wrapper">
        <!-- Global Notifications -->
        @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                <span>✓</span>
                <div>{{ session('sukses') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" role="alert">
                <span>✕</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <span>✕</span>
                <div>
                    <strong>Terdapat beberapa kesalahan:</strong>
                    <ul style="margin-top: 0.25rem; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="navbar-container" style="justify-content: center;">
            <p>&copy; {{ date('Y') }} Sistem Manajemen Kos &amp; Properti. Tugas Besar Terpadu Kelompok (Case A, B, C, D).</p>
        </div>
    </footer>

    <script>
        function toggleNav() {
            var nav = document.getElementById('mainNav');
            nav.classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
