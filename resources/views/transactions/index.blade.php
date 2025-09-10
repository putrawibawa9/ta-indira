@extends('layouts.app')
@section('title', 'Transaksi')
@section('page-title', 'Transaksi')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Daftar Transaksi</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="overflow-x-auto">
    <table class="table table-striped w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->customer->name ?? '-' }}</td>
                <td>{{ $transaction->date }}</td>
                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Tidak ada transaksi ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
