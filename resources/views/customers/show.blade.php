@extends('layouts.app')
@section('title', 'Detail Pelanggan')
@section('page-title', 'Detail Pelanggan')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Detail Pelanggan</h1>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $customer->name }}
    </div>
    <div class="mb-3">
        <strong>Telepon:</strong> {{ $customer->phone }}
    </div>
    <div class="mb-3">
        <strong>Email:</strong> {{ $customer->email }}
    </div>
    <div class="mb-3">
        <strong>Alamat:</strong> {{ $customer->address }}
    </div>
    <div class="mb-3">
        <strong>Deskripsi:</strong> {{ $customer->description }}
    </div>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
