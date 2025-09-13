@extends('layouts.app')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('content')
<h1 class="text-2xl font-bold mb-4">Detail User</h1>

<ul class="list-group mb-3">
    <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
    <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
    <li class="list-group-item"><strong>Role:</strong> <span class="badge bg-info">{{ $user->role }}</span></li>
</ul>

<a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
