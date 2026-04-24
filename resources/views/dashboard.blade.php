<x-app-layout>
    <style>
        .anime-card { border: 3px solid #2d3436; box-shadow: 6px 6px 0px #2d3436; transition: all 0.2s ease; }
        .anime-card:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0px #2d3436; }
        .anime-header { border-bottom: 4px solid #2d3436; }
        .stat-icon { border: 2px solid #2d3436; }
    </style>

    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight tracking-tight uppercase">
            <span class="bg-yellow-400 px-3 py-1 border-2 border-gray-800 rounded-lg">📊 DASHBOARD</span>
        </h2>
    </x-slot>

    <div class="py-8 bg-[#f0f9ff] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-indigo-500 overflow-hidden anime-card rounded-[2rem] text-white p-8 relative">
                <div class="relative z-10">
                    <h3 class="text-3xl font-black italic">Okaeri, {{ Auth::user()->name }}! ✨</h3>
                    <p class="text-indigo-100 mt-2 font-bold text-lg">
                        @if(auth()->user()->isAdmin())
                            Siap mengelola perpustakaan hari ini? Semangat!
                        @else
                            Ayo temukan petualangan barumu di antara rak buku!
                        @endif
                    </p>
                </div>
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/20 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white anime-card rounded-2xl p-6">
                    <div class="flex items-center gap-5">
                        <div class="bg-blue-400 stat-icon rounded-xl p-3 text-white text-2xl">
                            📖
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-500 uppercase tracking-widest">Total Buku</p>
                            <p class="text-4xl font-black text-gray-900">{{ \App\Models\Buku::count() }}</p>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->isAdmin())
                <div class="bg-white anime-card rounded-2xl p-6">
                    <div class="flex items-center gap-5">
                        <div class="bg-green-400 stat-icon rounded-xl p-3 text-white text-2xl">
                            👥
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-500 uppercase tracking-widest">Total Anggota</p>
                            <p class="text-4xl font-black text-gray-900">{{ \App\Models\Anggota::count() }}</p>
                        </div>
                    </div>
                </div>
                @else
                @php
                    $anggotaLogin = \App\Models\Anggota::where('email', auth()->user()->email)->first();
                    $pinjamAktif = $anggotaLogin ? \App\Models\Peminjaman::where('anggota_id', $anggotaLogin->id)->whereIn('status',['menunggu','disetujui','dipinjam'])->count() : 0;
                @endphp
                <div class="bg-white anime-card rounded-2xl p-6">
                    <div class="flex items-center gap-5">
                        <div class="bg-green-400 stat-icon rounded-xl p-3 text-white text-2xl">
                            🎒
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-500 uppercase tracking-widest">Pinjaman Aktif</p>
                            <p class="text-4xl font-black text-gray-900">{{ $pinjamAktif }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="bg-white anime-card rounded-2xl p-6">
                    <div class="flex items-center gap-5">
                        <div class="bg-yellow-400 stat-icon rounded-xl p-3 text-white text-2xl">
                            ⚡
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-500 uppercase tracking-widest">
                                @if(auth()->user()->isAdmin()) Dipinjam @else Menunggu @endif
                            </p>
                            <p class="text-4xl font-black text-gray-900">
                                @if(auth()->user()->isAdmin())
                                    {{ \App\Models\Peminjaman::where('status','dipinjam')->count() }}
                                @else
                                    {{ $anggotaLogin ? \App\Models\Peminjaman::where('anggota_id', $anggotaLogin->id)->where('status','menunggu')->count() : 0 }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white anime-card rounded-[2rem] p-8">
                <h3 class="text-xl font-black text-gray-800 mb-6 uppercase italic">Quick Skills! ⚡</h3>
                <div class="flex flex-wrap gap-4">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('buku.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-500 border-2 border-gray-800 rounded-xl text-white font-bold hover:bg-indigo-600 transition shadow-[4px_4px_0px_#2d3436] active:translate-y-1 active:shadow-none">
                            + Tambah Buku
                        </a>
                        <a href="{{ route('anggota.create') }}" class="inline-flex items-center px-6 py-3 bg-green-500 border-2 border-gray-800 rounded-xl text-white font-bold hover:bg-green-600 transition shadow-[4px_4px_0px_#2d3436] active:translate-y-1 active:shadow-none">
                            + Tambah Anggota
                        </a>
                    @else
                        <a href="{{ route('buku.index') }}" class="inline-flex items-center px-6 py-3 bg-pink-400 border-2 border-gray-800 rounded-xl text-white font-bold hover:bg-pink-500 transition shadow-[4px_4px_0px_#2d3436] active:translate-y-1 active:shadow-none">
                            🔍 Cari Buku
                        </a>
                        <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center px-6 py-3 bg-yellow-400 border-2 border-gray-800 rounded-xl text-gray-800 font-bold hover:bg-yellow-500 transition shadow-[4px_4px_0px_#2d3436] active:translate-y-1 active:shadow-none">
                            📖 Pinjam Sekarang
                        </a>
                    @endif
                </div>
            </div>

            <div class="bg-white anime-card rounded-[2rem] p-8 overflow-hidden">
                <h3 class="text-xl font-black text-gray-800 mb-6 uppercase">
                    @if(auth()->user()->isAdmin()) 📜 Log Peminjaman @else 📜 Riwayat Kamu @endif
                </h3>
                <div class="overflow-x-auto border-2 border-gray-800 rounded-2xl">
                    <table class="min-w-full bg-white divide-y-2 divide-gray-800">
                        <thead class="bg-gray-50 text-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-black uppercase">Anggota</th>
                                <th class="px-6 py-4 text-left text-sm font-black uppercase">Buku</th>
                                <th class="px-6 py-4 text-left text-sm font-black uppercase">Tgl Pinjam</th>
                                <th class="px-6 py-4 text-left text-sm font-black uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-gray-800 font-medium">
                            @php
                                $recentPinjam = auth()->user()->isAdmin() 
                                    ? \App\Models\Peminjaman::with(['anggota','buku'])->latest()->take(5)->get()
                                    : ($anggotaLogin ? \App\Models\Peminjaman::with(['anggota','buku'])->where('anggota_id', $anggotaLogin->id)->latest()->take(5)->get() : collect());
                            @endphp
                            @forelse($recentPinjam as $p)
                            <tr class="hover:bg-yellow-50 transition">
                                <td class="px-6 py-4 text-sm">{{ $p->anggota->nama }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-indigo-600">{{ $p->buku->judul }}</td>
                                <td class="px-6 py-4 text-sm">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 border-2 border-gray-800 font-black text-xs rounded-full inline-block shadow-[2px_2px_0px_#2d3436] {{ $p->badgeStatus() }}">
                                        {{ strtoupper($p->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Data masih kosong, desu! 🌸</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>