@extends('layouts.app')
@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Detail Kategori</h1>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $category->name }}
    </div>
    <div class="mb-3">
        <strong>Deskripsi:</strong> {{ $category->description }}
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
