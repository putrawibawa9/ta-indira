@extends('layouts.app')
@section('title', 'Detail Supplier')
@section('page-title', 'Detail Supplier')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Detail Supplier</h1>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $supplier->name }}
    </div>
    <div class="mb-3">
        <strong>Telepon:</strong> {{ $supplier->phone }}
    </div>
    <div class="mb-3">
        <strong>Email:</strong> {{ $supplier->email }}
    </div>
    <div class="mb-3">
        <strong>Alamat:</strong> {{ $supplier->address }}
    </div>
    <div class="mb-3">
        <strong>Deskripsi:</strong> {{ $supplier->description }}
    </div>
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
