@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-6 gap-6">

    <!-- Card: Total Produk -->
    <a href="{{ route('products.index') }}" class="bg-white rounded-lg shadow p-6 flex items-center hover:shadow-lg transition">
        <span class="material-icons text-blue-500 text-4xl mr-4">inventory_2</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalProducts }}</div>
            <div class="text-gray-500">Total Produk</div>
        </div>
    </a>

    <!-- Card: Total Transaksi -->
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('transactions.index') }}" class="bg-white rounded-lg shadow p-6 flex items-center hover:shadow-lg transition">
        <span class="material-icons text-green-500 text-4xl mr-4">receipt_long</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalTransactions }}</div>
            <div class="text-gray-500">Total Transaksi</div>
        </div>
    </a>
    @endif

    <!-- Card: Total User (hanya admin) -->
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('users.index') }}" class="bg-white rounded-lg shadow p-6 flex items-center hover:shadow-lg transition">
        <span class="material-icons text-gray-700 text-4xl mr-4">person</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalUsers }}</div>
            <div class="text-gray-500">Total User</div>
        </div>
    </a>
    @endif

    <!-- Card: Total Pelanggan -->
    <a href="{{ route('customers.index') }}" class="bg-white rounded-lg shadow p-6 flex items-center hover:shadow-lg transition">
        <span class="material-icons text-orange-500 text-4xl mr-4">groups</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalCustomers }}</div>
            <div class="text-gray-500">Total Pelanggan</div>
        </div>
    </a>

    <!-- Card: Total Supplier (hanya admin) -->
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('suppliers.index') }}" class="bg-white rounded-lg shadow p-6 flex items-center hover:shadow-lg transition">
        <span class="material-icons text-yellow-600 text-4xl mr-4">local_shipping</span>
        <div>
            <div class="text-2xl font-bold">{{ $totalSuppliers }}</div>
            <div class="text-gray-500">Total Supplier</div>
        </div>
    </a>
    @endif
</div>
@endsection
