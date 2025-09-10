@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-6 gap-6">
    <!-- Card: Total Produk -->
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <span class="material-icons text-blue-500 text-4xl mr-4">inventory_2</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalProducts }}</div>
            <div class="text-gray-500">Total Produk</div>
        </div>
    </div>
    <!-- Card: Total Transaksi -->
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <span class="material-icons text-green-500 text-4xl mr-4">receipt_long</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalSales }}</div>
            <div class="text-gray-500">Total Transaksi</div>
        </div>
    </div>
    <!-- Card: Total User -->
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <span class="material-icons text-gray-700 text-4xl mr-4">person</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalUsers }}</div>
            <div class="text-gray-500">Total User</div>
        </div>
    </div>
    <!-- Card: Total Kategori -->
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <span class="material-icons text-purple-500 text-4xl mr-4">category</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalCategories }}</div>
            <div class="text-gray-500">Total Kategori</div>
        </div>
    </div>
    <!-- Card: Total Pelanggan -->
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <span class="material-icons text-orange-500 text-4xl mr-4">groups</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalCustomers }}</div>
            <div class="text-gray-500">Total Pelanggan</div>
        </div>
    </div>
    <!-- Card: Total Supplier -->
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <span class="material-icons text-yellow-600 text-4xl mr-4">local_shipping</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalSuppliers }}</div>
            <div class="text-gray-500">Total Supplier</div>
        </div>
    </div>
</div>
@endsection
