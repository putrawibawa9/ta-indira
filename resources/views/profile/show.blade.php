@extends('layouts.app')
@section('title', 'Profile Saya')
@section('page-title', 'Profile Saya')

@section('content')
<div class="bg-white shadow rounded p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Profile Saya</h1>
        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">⚙️ Pengaturan (edit profile)</a>
    </div>

    <div class="flex items-center space-x-6">
        <div>
            <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                 alt="Profile" class="w-32 h-32 rounded-lg border">
        </div>
        <div>
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Kontak:</strong> {{ $user->contact ?? '-' }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        </div>
    </div>
</div>
@endsection
