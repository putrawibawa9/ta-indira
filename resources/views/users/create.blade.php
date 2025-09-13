@extends('layouts.app')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah User</h1>

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="pegawai">Pegawai</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
