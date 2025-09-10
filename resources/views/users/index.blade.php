@extends('layouts.app')
@section('title', 'Data User')
@section('page-title', 'Data User')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Daftar User</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ $user->created_at->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4">Tidak ada data user.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
