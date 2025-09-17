@extends('layouts.app')

@section('title', 'Tambah Supplier')
@section('page-title', 'Tambah Supplier')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">➕ Tambah Supplier</h1>

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
    <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Nama -->
        <div>
            <label for="name" class="block font-medium">Nama Supplier</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300" required>
        </div>

        <!-- Telepon -->
        <div>
            <label for="phone" class="block font-medium">Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
        </div>

        <!-- Alamat -->
        <div>
            <label for="address" class="block font-medium">Alamat</label>
            <textarea id="address" name="address" rows="2"
                      class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">{{ old('address') }}</textarea>
        </div>

        <!-- Total Pembelian -->
        <div>
            <label for="total_purchase" class="block font-medium">Total Pembelian</label>
            <input type="number" id="total_purchase" name="total_purchase" value="{{ old('total_purchase', 0) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300" min="0" step="0.01">
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block font-medium">Keterangan</label>
            <textarea id="notes" name="notes" rows="2"
                      class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">{{ old('notes') }}</textarea>
        </div>

        <!-- Gambar -->
        <div>
            <label for="image" class="block font-medium">Gambar Supplier</label>
            <input type="file" id="image" name="image" accept="image/*"
                   class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('suppliers.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
