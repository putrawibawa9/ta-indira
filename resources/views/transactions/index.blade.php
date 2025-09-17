@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('page-title', 'Daftar Transaksi')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">📑 Daftar Transaksi</h1>
            <p class="text-gray-500 text-sm">Data transaksi yang tercatat di sistem</p>
        </div>
        <a href="{{ route('transactions.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            ➕ Tambah Transaksi
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & per page -->
    <div class="flex items-center justify-between mb-4">
        <form method="GET" action="{{ route('transactions.index') }}" class="flex items-center space-x-2">
            <label for="perPage" class="text-sm">Show</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()"
                    class="border rounded px-2 py-1 text-sm">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span class="text-sm">entries</span>

            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="🔍 Cari transaksi..."
                   class="border rounded px-3 py-1 text-sm focus:ring focus:border-blue-300">

            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('transactions.index') }}"
                   class="px-3 py-1 bg-gray-300 text-black rounded text-sm hover:bg-gray-400">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr class="text-left text-gray-700">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Tanggal Transaksi</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Metode</th>
                    <th class="px-4 py-2 border">Dp</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $index => $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $transactions->firstItem() + $index }}</td>
                        <td class="px-4 py-2 border">{{ $transaction->date }}</td>
                        <td class="px-4 py-2 border">{{ $transaction->customer->name ?? '-' }}</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($transaction->payment_method) }}</td>
                         <td class="px-4 py-2 border">{{ $transaction->dp ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            @if($transaction->status == 'lunas')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">Lunas</span>
                            @elseif($transaction->status == 'belum_lunas')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-sm">Belum Lunas</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">Batal</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center space-x-1">
                            <a href="{{ route('transactions.show', $transaction->id) }}"
                               class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700 text-sm">
                                👁 Detail
                            </a>
                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada transaksi ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transactions->appends(['search' => request('search'), 'perPage' => request('perPage')])->links() }}
    </div>
</div>
@endsection
