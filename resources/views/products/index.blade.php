
@extends('layouts.app')
@section('title', 'Produk')
@section('page-title', 'Produk')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold">Daftar Produk</h1>
  <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
</div>
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="overflow-x-auto">
  <table class="table table-striped w-full">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $product)
      <tr>
        <td>#{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
        <td class="muted">{{ \Illuminate\Support\Str::limit($product->description, 120) }}</td>
        <td>
          <div class="flex gap-2">
            <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Lihat</a>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus produk?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="muted text-center py-4">Tidak ada produk ditemukan.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@if(method_exists($products, 'links'))
  <div class="mt-4">
    {{ $products->links() }}
  </div>
@endif
@endsection
