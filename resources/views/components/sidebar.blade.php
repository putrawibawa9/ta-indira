<aside x-data="{ open: false }" class="bg-gray-800 text-white w-64 min-h-screen flex flex-col transition-all duration-300 md:relative fixed z-30" :class="{ '-translate-x-64': !open, 'translate-x-0': open }" @click.away="open = false">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-700">
        <span class="font-bold text-lg">🗃️ ArthaMas</span>
        <button class="md:hidden" @click="open = !open">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="/dashboard" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
            <span class="material-icons mr-2">dashboard</span> Home
        </a>
        <a href="/products" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
            <span class="flex items-center"><span class="material-icons mr-2">inventory_2</span> Data Barang</span>
            <span class="ml-2 bg-blue-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalProducts ?? '-' }}</span>
        </a>
           <a href="/users" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
            <span class="flex items-center"><span class="material-icons mr-2">person</span> Data User</span>
            <span class="ml-2 bg-gray-400 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalUsers ?? '-' }}</span>
        </a>
         <a href="/customers" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
            <span class="flex items-center"><span class="material-icons mr-2">groups</span>Data Pelanggan</span>
            <span class="ml-2 bg-orange-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalCustomers ?? '-' }}</span>
        </a>
        <a href="/transactions" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition justify-between">
            <span class="flex items-center"><span class="material-icons mr-2">receipt_long</span> Transaksi</span>
            <span class="ml-2 bg-green-600 text-xs px-2 py-0.5 rounded-full">{{ $sidebarTotalSales ?? '-' }}</span>
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
        <a href="/guide" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
            <span class="material-icons mr-2">help_outline</span> Panduan Penggu
        </a>
      
    </nav>
</aside>
