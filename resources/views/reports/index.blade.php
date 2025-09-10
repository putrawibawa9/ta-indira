@extends('layouts.app')
@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Cetak Laporan Transaksi</h2>
    <form action="{{ route('reports.export') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Cetak PDF</button>
    </form>
</div>
@endsection
