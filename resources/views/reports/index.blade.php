@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Cetak Laporan')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">📑 Cetak Laporan</h1>

    <form action="{{ route('reports.export') }}" method="POST" target="_blank" class="space-y-4">
        @csrf

        <!-- Pilih Jenis Laporan -->
        <div>
            <label class="block font-medium mb-2">Pilih Laporan</label>
            <div class="grid grid-cols-2 gap-2">
                <label><input type="checkbox" name="types[]" value="customers"> Pelanggan</label>
                <label><input type="checkbox" name="types[]" value="products"> Produk</label>
                <label><input type="checkbox" name="types[]" value="suppliers"> Supplier</label>
                <label><input type="checkbox" name="types[]" value="transactions"> Transaksi</label>
            </div>
        </div>

        <!-- Filter Tanggal -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="from_date" class="block font-medium">Dari Tanggal</label>
                <input type="date" id="from_date" name="from_date" class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
            </div>
            <div>
                <label for="to_date" class="block font-medium">Sampai Tanggal</label>
                <input type="date" id="to_date" name="to_date" class="w-full border rounded px-3 py-2 focus:ring focus:border-blue-300">
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2">
            <button type="reset" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Reset
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Preview & Cetak
            </button>
        </div>
    </form>
</div>
@endsection
