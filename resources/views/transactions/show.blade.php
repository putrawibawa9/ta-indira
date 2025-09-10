@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Detail Transaksi</h1>
    <div class="mb-3">
        <strong>Pelanggan:</strong> {{ $transaction->customer->name ?? '-' }}
    </div>
    <div class="mb-3">
        <strong>Tanggal:</strong> {{ $transaction->date }}
    </div>
    <div class="mb-3">
        <strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}
    </div>
    <div class="mb-3">
        <strong>Catatan:</strong> {{ $transaction->notes }}
    </div>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
