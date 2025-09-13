@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit User</h1>

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
    </div>

    <div class="mb-3">
        <label>Password (opsional)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="pegawai" {{ $user->role === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
