@extends('layouts.app')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">✏️ Edit Barang</h1>

    <!-- Error Handling -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Barang -->
        <div>
            <label for="name" class="block font-medium">Nama Barang</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $product->name) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300" required>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="description" class="block font-medium">Deskripsi</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Stok -->
        <div>
            <label for="stock" class="block font-medium">Stok</label>
            <input type="number" id="stock" name="stock"
                   value="{{ old('stock', $product->stock) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300" min="0" required>
        </div>

        <!-- Harga -->
        <div>
            <label for="price" class="block font-medium">Harga</label>
            <input type="number" id="price" name="price"
                   value="{{ old('price', $product->price) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300" min="0" required>
        </div>

        <!-- Supplier -->
        <div>
            <label for="supplier_id" class="block font-medium">Supplier</label>
            <select id="supplier_id" name="supplier_id"
                    class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Gambar -->
        <div>
            <label for="image" class="block font-medium">Gambar Barang</label>

            @if ($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Barang" class="h-32 rounded border">
                </div>
            @endif

            <input type="file" id="image" name="image" accept="image/*"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
            <p class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('products.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
