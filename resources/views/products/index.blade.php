@extends('layouts.app')

@section('title', 'Data Barang')
@section('page-title', 'Data Barang')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">📦 Data Barang</h1>
            <p class="text-gray-500 text-sm">Daftar stok barang yang tersedia</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            ➕ Tambah Barang
        </a>
    </div>

    <!-- Search & per page -->
    <div class="flex items-center justify-between mb-4">
        <form method="GET" action="{{ route('products.index') }}" class="flex items-center space-x-2">
            <label for="perPage" class="text-sm">Show</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()"
                    class="border rounded px-2 py-1 text-sm">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span class="text-sm">entries</span>

            <div>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="🔍 Cari barang..."
                    class="border rounded px-3 py-1 text-sm focus:ring focus:border-blue-300">
            </div>
            <button type="submit"
                    class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                Cari
            </button>
            @if($search)
                <a href="{{ route('products.index') }}"
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
                    <th class="px-4 py-2 border">Nama Barang</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Stok</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Supplier</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border font-semibold">{{ $product->name }}</td>
                        <td class="px-4 py-2 border">{{ Str::limit($product->description, 50) }}</td>
                        <td class="px-4 py-2 border">{{ $product->stock }}</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ $product->supplier->name ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus barang ini?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada barang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
