@extends('layouts.app')

@section('title', 'Daftar Pelanggan')
@section('page-title', 'Daftar Pelanggan')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">📋 Daftar Pelanggan</h1>
            <p class="text-gray-500 text-sm">Data pelanggan yang terdaftar di sistem</p>
        </div>
        <a href="{{ route('customers.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            ➕ Tambah Pelanggan
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & per page -->
    <div class="flex items-center justify-between mb-4">
        <form method="GET" action="{{ route('customers.index') }}" class="flex items-center space-x-2">
            <label for="perPage" class="text-sm">Show</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()"
                    class="border rounded px-2 py-1 text-sm">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span class="text-sm">entries</span>

            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="🔍 Cari pelanggan..."
                   class="border rounded px-3 py-1 text-sm focus:ring focus:border-blue-300">

            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('customers.index') }}"
                   class="px-3 py-1 bg-gray-300 text-black rounded text-sm hover:bg-gray-400">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr class="text-left text-gray-700">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Telepon</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Catatan</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $index => $customer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $customers->firstItem() + $index }}</td>
                        <td class="px-4 py-2 border font-semibold">{{ $customer->name }}</td>
                        <td class="px-4 py-2 border">{{ $customer->phone ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $customer->email ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $customer->address ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $customer->notes ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            @if($customer->image)
                                <img src="{{ asset('storage/'.$customer->image) }}"
                                     class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('customers.edit', $customer->id) }}"
                                class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm shadow-sm">
                                    ✏️ <span class="ml-1">Edit</span>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-2 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm shadow-sm">
                                        🗑 <span class="ml-1">Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada data pelanggan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $customers->appends(['search' => request('search'), 'perPage' => request('perPage')])->links() }}
    </div>
</div>
@endsection
