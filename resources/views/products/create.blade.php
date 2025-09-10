
@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
  <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>
  @if ($errors->any())
    <div class="alert alert-danger mb-4">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="sku" class="form-label">SKU</label>
      <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}" required>
      @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Nama</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">Kategori</label>
      <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="unit" class="form-label">Unit</label>
      <select name="unit" class="form-control @error('unit') is-invalid @enderror">
        @php $units = ['pcs','set','unit','cm','m']; @endphp
        @foreach($units as $u)
          <option value="{{ $u }}" {{ old('unit','pcs')===$u?'selected':'' }}>{{ $u }}</option>
        @endforeach
      </select>
      @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="purchase_price" class="form-label">Harga Beli</label>
      <input type="number" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price') }}" min="0" step="0.01">
      @error('purchase_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="sell_price" class="form-label">Harga Jual</label>
      <input type="number" name="sell_price" class="form-control @error('sell_price') is-invalid @enderror" value="{{ old('sell_price') }}" min="0" step="0.01">
      @error('sell_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="min_stock" class="form-label">Stok Minimum</label>
      <input type="number" name="min_stock" class="form-control @error('min_stock') is-invalid @enderror" value="{{ old('min_stock') }}" min="0" step="1">
      @error('min_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
