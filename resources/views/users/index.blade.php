@extends('layouts.app')

@section('title', 'Data User')
@section('page-title', 'Data User')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">👥 Data User</h1>
            <p class="text-gray-500 text-sm">Daftar semua user dalam sistem</p>
        </div>
        <a href="{{ route('users.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            ➕ Tambah User
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
        <form method="GET" action="{{ route('users.index') }}" class="flex items-center space-x-2">
            <label for="perPage" class="text-sm">Show</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()"
                    class="border rounded px-2 py-1 text-sm">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span class="text-sm">entries</span>

            <input type="text" name="search" value="{{ $search ?? '' }}"
                   placeholder="🔍 Cari user..."
                   class="border rounded px-3 py-1 text-sm focus:ring focus:border-blue-300">

            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                Cari
            </button>

            @if($search)
                <a href="{{ route('users.index') }}"
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
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                        <td class="px-4 py-2 border font-semibold">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border text-center space-x-1">
                            <a href="{{ route('users.show', $user->id) }}"
                               class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                                👁 Lihat
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada user ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->appends(['search' => $search, 'perPage' => $perPage])->links() }}
    </div>
</div>
@endsection
