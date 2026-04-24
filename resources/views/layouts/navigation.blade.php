<nav x-data="{ open: false }" class="bg-white border-b-4 border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-black tracking-tighter">
                        <span class="bg-yellow-400 px-3 py-1 border-2 border-gray-800 rounded-lg shadow-[3px_3px_0px_#2d3436] hover:bg-yellow-300 transition">
                            📚 BOOK-KUN
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold text-gray-800 uppercase italic">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')" class="font-bold text-gray-800 uppercase italic">
                            {{ __('Kategori') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')" class="font-bold text-gray-800 uppercase italic">
                        {{ __('Buku') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')" class="font-bold text-gray-800 uppercase italic">
                            {{ __('Anggota') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')" class="font-bold text-gray-800 uppercase italic">
                        {{ __('Peminjaman') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border-2 border-gray-800 text-sm font-black rounded-xl text-gray-800 bg-white hover:bg-pink-50 shadow-[4px_4px_0px_#2d3436] active:translate-y-1 active:shadow-none transition-all duration-150">
                            <div class="flex items-center">
                                <span class="mr-2 text-xl">👤</span>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b-2 border-gray-800 bg-indigo-50">
                            <p class="text-[10px] font-black text-indigo-400 uppercase">Status Member</p>
                            <span class="inline-block mt-1 px-3 py-0.5 text-xs font-black border-2 border-gray-800 rounded-full shadow-[2px_2px_0px_#2d3436] {{ auth()->user()->isAdmin() ? 'bg-yellow-300 text-gray-800' : 'bg-green-300 text-gray-800' }}">
                                {{ strtoupper(auth()->user()->role) }}
                            </span>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="font-bold hover:bg-pink-50 transition">
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="font-bold text-red-500 hover:bg-red-50 transition">
                                {{ __('Sign Out 🚪') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 border-2 border-gray-800 rounded-lg text-gray-800 bg-yellow-400 hover:bg-yellow-300 shadow-[2px_2px_0px_#2d3436] focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 20h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-pink-50 border-t-4 border-gray-800">
        <div class="pt-2 pb-3 space-y-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-black italic uppercase">
                Dashboard
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')" class="font-black italic uppercase">
                    Kategori
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')" class="font-black italic uppercase">
                Buku
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')" class="font-black italic uppercase">
                    Anggota
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')" class="font-black italic uppercase">
                Peminjaman
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t-4 border-gray-800 bg-white">
            <div class="px-4 mb-4">
                <div class="font-black text-lg text-gray-800 italic uppercase">👤 {{ Auth::user()->name }}</div>
                <div class="font-bold text-sm text-gray-500 mb-2">{{ Auth::user()->email }}</div>
                <span class="inline-block px-3 py-0.5 text-xs font-black border-2 border-gray-800 rounded-full shadow-[2px_2px_0px_#2d3436] {{ auth()->user()->isAdmin() ? 'bg-yellow-300' : 'bg-green-300' }}">
                    {{ strtoupper(auth()->user()->role) }}
                </span>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="font-bold">
                    {{ __('Profile Settings') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="font-bold text-red-500">
                        {{ __('Log Out 🚪') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>