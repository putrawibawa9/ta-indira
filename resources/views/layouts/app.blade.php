<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Barang')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        :root {
            --primary-color: #4f46e5;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --header-height: 60px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: #1e293b;
            transition: width 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar-collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            padding: 0 1rem;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .sidebar-title {
            font-weight: 600;
            font-size: 1rem;
            overflow: hidden;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .sidebar-title span {
            opacity: 0;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: background 0.2s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(79, 70, 229, 0.5) transparent;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(79, 70, 229, 0.5);
            border-radius: 3px;
        }

        .menu-section {
            margin-bottom: 1.5rem;
        }

        .menu-section-title {
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0 1rem;
            margin-bottom: 0.5rem;
            letter-spacing: 0.05em;
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .menu-section-title {
            opacity: 0;
            height: 0;
            margin: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: #334155;
            color: white;
            border-left-color: var(--primary-color);
        }

        .menu-item.active {
            background: #334155;
            color: white;
            border-left-color: var(--primary-color);
        }

        .menu-item-content {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .menu-icon {
            min-width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
            text-align: center;
        }

        .menu-text {
            flex: 1;
            overflow: hidden;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .menu-text {
            opacity: 0;
        }

        .menu-badge {
            background: var(--primary-color);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            min-width: 20px;
            text-align: center;
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .menu-badge {
            opacity: 0;
        }

        .logout-section {
            padding: 1rem;
            border-top: 1px solid #334155;
        }

        .logout-button {
            width: 100%;
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        .logout-button .material-icons {
            margin-right: 0.5rem;
        }

        .sidebar-collapsed .logout-button span {
            opacity: 0;
        }

        /* Main Content */
        .main-container {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar-collapsed + .main-container {
            margin-left: var(--sidebar-collapsed-width);
        }

        .main-navbar {
            height: var(--header-height);
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .mobile-menu-toggle {
            display: none;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-dropdown {
            position: relative;
        }

        .dropdown-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            display: flex;
            align-items: center;
            color: #64748b;
            transition: background 0.2s ease;
        }

        .dropdown-button:hover {
            background: #f1f5f9;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            min-width: 180px;
            z-index: 1000;
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
            transition: all 0.2s ease;
            overflow: hidden;
        }

        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #475569;
            text-decoration: none;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.2s ease;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: #f8fafc;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item i {
            margin-right: 0.75rem;
            width: 16px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            padding: 2rem 1.5rem;
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }

        .mobile-overlay.show {
            display: block;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-container {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .main-navbar {
                padding: 0 1rem;
            }

            .main-content {
                padding: 1rem;
            }

            .navbar-title {
                font-size: 1.1rem;
            }
        }

        /* Utility Classes */
        [x-cloak] { display: none !important; }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <span class="sidebar-title">
                    <i class="fas fa-couch"></i>
                    <span>
                        ArthaMas-{{ ucfirst(auth()->user()->role) }}
                    </span>
                </span>
                <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Sidebar Menu -->
            <nav class="sidebar-menu">
                <!-- Main Menu -->
                <div class="menu-section">
                    <div class="menu-section-title">Main Menu</div>

                    <a href="{{ route('dashboard') }}" class="menu-item" title="Dashboard">
                        <div class="menu-item-content">
                            <span class="menu-icon material-icons">dashboard</span>
                            <span class="menu-text">Home</span>
                        </div>
                    </a>
                </div>

                @if(auth()->user()->role === 'admin')
                    <!-- Admin Section -->
                    <div class="menu-section">
                        <div class="menu-section-title">Management</div>

                        <a href="{{ route('products.index') }}" class="menu-item" title="Data Barang">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">inventory_2</span>
                                <span class="menu-text">Data Barang</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalProducts ?? '-' }}
                            </span>
                        </a>

                        <a href="{{ route('users.index') }}" class="menu-item" title="Data User">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">person</span>
                                <span class="menu-text">Data User</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalUsers ?? '-' }}
                            </span>
                        </a>

                        <a href="{{ route('customers.index') }}" class="menu-item" title="Data Pelanggan">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">groups</span>
                                <span class="menu-text">Data Pelanggan</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalCustomers ?? '-' }}
                            </span>
                        </a>

                        <a href="{{ route('transactions.index') }}" class="menu-item" title="Transaksi">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">receipt_long</span>
                                <span class="menu-text">Transaksi</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalTransactions ?? '-' }}
                            </span>
                        </a>

                        <a href="{{ route('suppliers.index') }}" class="menu-item" title="Supplier">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">local_shipping</span>
                                <span class="menu-text">Supplier</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalSuppliers ?? '-' }}
                            </span>
                        </a>
                    </div>

                    <!-- Reports Section -->
                    <div class="menu-section">
                        <div class="menu-section-title">Reports</div>

                        <a href="{{ route('reports.index') }}" class="menu-item" title="Cetak Laporan">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">bar_chart</span>
                                <span class="menu-text">Cetak Laporan</span>
                            </div>
                        </a>
                    </div>
                @else
                    <!-- Employee Section -->
                    <div class="menu-section">
                        <div class="menu-section-title">Operations</div>

                        <a href="{{ route('products.index') }}" class="menu-item" title="Data Barang">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">inventory_2</span>
                                <span class="menu-text">Data Barang</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalProducts ?? '-' }}
                            </span>
                        </a>

                        <a href="{{ route('customers.index') }}" class="menu-item" title="Data Pelanggan">
                            <div class="menu-item-content">
                                <span class="menu-icon material-icons">groups</span>
                                <span class="menu-text">Data Pelanggan</span>
                            </div>
                            <span class="menu-badge">
                                {{ $sidebarTotalCustomers ?? '-' }}
                            </span>
                        </a>
                    </div>
                @endif

                <!-- Help Section -->
                <div class="menu-section">
                    <div class="menu-section-title">Support</div>

                    <a href="/guide" class="menu-item" title="Panduan Penggunaan">
                        <div class="menu-item-content">
                            <span class="menu-icon material-icons">help_outline</span>
                            <span class="menu-text">Panduan Penggunaan</span>
                        </div>
                    </a>
                </div>
            </nav>

            <!-- Logout Section -->
            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button" title="Logout">
                        <span class="material-icons">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Container -->
        <div class="main-container">
            <!-- Top Navbar -->
            <nav class="main-navbar">
                <div class="d-flex align-items-center">
                    <button class="mobile-menu-toggle" id="mobileToggle" title="Toggle Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="navbar-title">@yield('page-title', 'Dashboard')</h1>
                </div>

                <!-- Profile Section -->
                <div class="profile-section">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                             alt="Profile Photo"
                             class="profile-avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4f46e5&color=fff&size=72"
                             alt="Profile Avatar"
                             class="profile-avatar">
                    @endif

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown">
                        <button class="dropdown-button" id="profileButton" title="Profile Menu" type="button">
                            <i class="fas fa-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu" id="profileDropdown">
                            <a href="{{ route('profile.show') }}" class="dropdown-item">
                                <i class="fas fa-user"></i> Profile Saya
                            </a>

                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="fas fa-cog"></i> Pengaturan
                            </a>

                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content fade-in">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileToggle = document.getElementById('mobileToggle');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');

            // Sidebar toggle (desktop)
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('sidebar-collapsed');
                });
            }

            // Mobile sidebar toggle
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.add('mobile-open');
                    mobileOverlay.classList.add('show');
                });
            }

            // Close mobile sidebar
            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    mobileOverlay.classList.remove('show');
                });
            }

            // Profile dropdown toggle
            if (profileButton && profileDropdown) {
                profileButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('show');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                        profileDropdown.classList.remove('show');
                    }
                });

                // Close dropdown when pressing escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        profileDropdown.classList.remove('show');
                    }
                });
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('mobile-open');
                    mobileOverlay.classList.remove('show');
                }
            });

            // Handle active menu items based on current URL
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href && href === currentPath) {
                    item.classList.add('active');
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + B to toggle sidebar
                if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                    e.preventDefault();
                    sidebar.classList.toggle('sidebar-collapsed');
                }
            });

            // Auto-close dropdown after form submission
            const dropdownForms = document.querySelectorAll('.dropdown-menu form');
            dropdownForms.forEach(form => {
                form.addEventListener('submit', function() {
                    setTimeout(() => {
                        if (profileDropdown) {
                            profileDropdown.classList.remove('show');
                        }
                    }, 100);
                });
            });
        });
    </script>
</body>
</html>
