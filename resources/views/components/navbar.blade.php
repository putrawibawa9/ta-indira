<nav class="bg-white shadow flex items-center justify-between px-6 py-3">
    <div class="flex items-center">
        <h2 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h2>
    </div>
    <div class="flex-1 flex justify-center">
        <form class="w-full max-w-md">
            <input type="text" placeholder="Search..." class="w-full px-4 py-2 border rounded focus:outline-none focus:ring" />
        </form>
    </div>
    <div class="flex items-center space-x-4">
        <img src="https://ui-avatars.com/api/?name=User" alt="Profile" class="w-8 h-8 rounded-full">
        <div class="relative" x-data="{ open: false }">
            <button class="focus:outline-none" @click="open = !open">▼</button>
            <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50"
                 x-show="open" @click.away="open = false" x-transition>
                <a href="{{ route('profile.edit') }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Ganti Username/Password</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
