@extends('layouts.app')

@section('title', 'Tambah Transaksi')
@section('page-title', 'Tambah Transaksi')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">➕ Tambah Transaksi</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Customer -->
        <div>
            <label for="customer_id" class="block font-medium">Customer</label>
            <select id="customer_id" name="customer_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label for="date" class="block font-medium">Tanggal</label>
            <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Produk -->
        <div>
            <label class="block font-medium">Produk</label>
            <div id="product-list" class="space-y-2">
                <div class="flex space-x-2">
                    <select name="products[0][id]" class="border rounded px-3 py-2 w-1/2">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="products[0][quantity]" placeholder="Qty" class="border rounded px-3 py-2 w-1/4" min="1">
                </div>
            </div>
            <button type="button" onclick="addProduct()" class="mt-2 px-3 py-1 bg-gray-600 text-white rounded">+ Tambah Produk</button>
        </div>

        <!-- Metode -->
        <div>
            <label for="payment_method" class="block font-medium">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="w-full border rounded px-3 py-2">
                <option value="tunai">Tunai</option>
                <option value="kredit">Kredit</option>
            </select>
        </div>

        <!-- DP -->
        <div>
            <label for="dp" class="block font-medium">DP</label>
            <input type="number" step="0.01" id="dp" name="dp" value="0" class="w-full border rounded px-3 py-2">
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2">
                <option value="lunas">Lunas</option>
                <option value="belum_lunas">Belum Lunas</option>
                <option value="batal">Batal</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>

<script>
let productIndex = 1;
function addProduct() {
    const container = document.getElementById('product-list');
    const div = document.createElement('div');
    div.classList.add('flex','space-x-2','mt-2');
    div.innerHTML = `
        <select name="products[${productIndex}][id]" class="border rounded px-3 py-2 w-1/2">
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})</option>
            @endforeach
        </select>
        <input type="number" name="products[${productIndex}][quantity]" placeholder="Qty" class="border rounded px-3 py-2 w-1/4" min="1">
    `;
    container.appendChild(div);
    productIndex++;
}
</script>
@endsection
