<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Barang')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside x-data="{ open: false }" class="bg-gray-800 text-white w-64 min-h-screen flex flex-col transition-all duration-300 md:relative fixed z-30" :class="{ '-translate-x-64': !open, 'translate-x-0': open }" @click.away="open = false">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-700">
                <span class="font-bold text-lg">🗃️ ArthaMas-{{ ucfirst(auth()->user()->role) }}</span>
                <button class="md:hidden" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <span class="material-icons mr-2">dashboard</span> Home
                </a>

                {{-- Hanya admin --}}
                @if(auth()->user()->role === 'admin')
                    <a href="/products" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
                        <span class="flex items-center"><span class="material-icons mr-2">inventory_2</span> Data Barang</span>
                        <span class="ml-2 bg-blue-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalProducts ?? '-' }}</span>
                    </a>
                    <a href="/users" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
                        <span class="flex items-center"><span class="material-icons mr-2">person</span> Data User</span>
                        <span class="ml-2 bg-gray-400 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalUsers ?? '-' }}</span>
                    </a>
                    <a href="/suppliers" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
                        <span class="flex items-center"><span class="material-icons mr-2">local_shipping</span> Supplier</span>
                        <span class="ml-2 bg-yellow-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalSuppliers ?? '-' }}</span>
                    </a>
                    <a href="/categories" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
                        <span class="flex items-center"><span class="material-icons mr-2">category</span> Kategori</span>
                        <span class="ml-2 bg-purple-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalCategories ?? '-' }}</span>
                    </a>
                    <a href="/reports" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                        <span class="material-icons mr-2">bar_chart</span> Laporan
                    </a>
                @endif

                {{-- Untuk semua (admin & pegawai) --}}
                <a href="/customers" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
                    <span class="flex items-center"><span class="material-icons mr-2">groups</span>Data Pelanggan</span>
                    <span class="ml-2 bg-orange-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalCustomers ?? '-' }}</span>
                </a>
                <a href="/transactions" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
                    <span class="flex items-center"><span class="material-icons mr-2">receipt_long</span> Transaksi</span>
                    <span class="ml-2 bg-green-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalSales ?? '-' }}</span>
                </a>
                <a href="/guide" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <span class="material-icons mr-2">help_outline</span> Panduan Penggunaan
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Navbar -->
            <nav class="bg-white shadow flex items-center justify-between px-6 py-3">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex-1 flex justify-center">
                    <form class="w-full max-w-md">
                        <input type="text" placeholder="Search..." class="w-full px-4 py-2 border rounded focus:outline-none focus:ring" />
                    </form>
                </div>
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile" class="w-8 h-8 rounded-full">
                    <div class="relative" x-data="{ open: false }">
                        <button class="focus:outline-none" @click="open = !open">▼</button>
                        <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50"
                            x-show="open" @click.away="open = false" x-transition>
                            <a href="{{ route('profile.edit') }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Ganti Username/Password</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
