@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">🧾 Detail Transaksi #{{ $transaction->id }}</h1>

    <p><strong>Tanggal:</strong> {{ $transaction->date }}</p>
    <p><strong>Customer:</strong> {{ $transaction->customer->name ?? '-' }}</p>
    <p><strong>Metode:</strong> {{ ucfirst($transaction->payment_method) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
    <p><strong>DP:</strong> Rp {{ number_format($transaction->dp, 0, ',', '.') }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>

    <h2 class="mt-4 text-xl font-semibold">Produk</h2>
    <table class="w-full border-collapse border mt-2">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">Produk</th>
                <th class="border px-3 py-2">Qty</th>
                <th class="border px-3 py-2">Harga</th>
                <th class="border px-3 py-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td class="border px-3 py-2">{{ $item->product->name }}</td>
                <td class="border px-3 py-2">{{ $item->quantity }}</td>
                <td class="border px-3 py-2">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="border px-3 py-2">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-end">
        <a href="{{ route('transactions.index') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Kembali</a>
    </div>
</div>
@endsection
