<x-app-layout>
    <style>
        .anime-card { border: 4px solid #1a1a1a; box-shadow: 10px 10px 0px #1a1a1a; }
        .anime-border { border: 3px solid #1a1a1a; }
        .btn-anime { border: 2px solid #1a1a1a; box-shadow: 3px 3px 0px #1a1a1a; transition: all 0.1s; font-family: 'Courier New', Courier, monospace; }
        .btn-anime:active { transform: translate(2px, 2px); box-shadow: 0px 0px 0px #1a1a1a; }
        .alert-anime { border: 4px solid #1a1a1a; box-shadow: 6px 6px 0px #1a1a1a; }
        .token-tag { background: #1a1a1a; color: #00ff00; padding: 2px 8px; border-radius: 4px; font-family: 'monospace'; border: 1px solid #333; }
    </style>

    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 leading-tight flex items-center italic uppercase tracking-tighter">
            <span class="bg-indigo-400 p-2 anime-border rounded-lg mr-3 shadow-[3px_3px_0px_#000]">🔄</span> 
            Log Peminjaman Buku
        </h2>
    </x-slot>

    <div class="py-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="bg-green-400 alert-anime p-4 mb-6 rounded-xl">
                    <p class="text-gray-900 font-black italic uppercase text-sm">✨ MISSION SUCCESS: {{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500 alert-anime p-4 mb-6 rounded-xl">
                    <p class="text-white font-black italic uppercase text-sm">🚨 SYSTEM ERROR: {{ session('error') }}</p>
                </div>
            @endif

            {{-- Section: Menunggu Validasi (Admin Only) --}}
            @if(auth()->user()->isAdmin())
                @php $menunggu = $peminjamans->getCollection()->where('status','menunggu'); @endphp
                @if($menunggu->count() > 0)
                <div class="bg-yellow-300 anime-card sm:rounded-[2rem] overflow-hidden mb-10">
                    <div class="px-6 py-4 border-b-4 border-gray-900 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-4 h-4 rounded-full bg-red-600 animate-ping border-2 border-gray-900"></span>
                            <h3 class="font-black text-gray-900 uppercase italic tracking-widest text-lg">⚠️ PERLU VALIDASI ({{ $menunggu->count() }})</h3>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-4 divide-gray-900">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-black text-gray-900 uppercase">Anggota</th>
                                    <th class="px-4 py-3 text-left text-xs font-black text-gray-900 uppercase">Buku</th>
                                    <th class="px-4 py-3 text-left text-xs font-black text-gray-900 uppercase">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y-2 divide-gray-900 bg-white">
                                @foreach($menunggu as $p)
                                <tr class="hover:bg-yellow-50 transition">
                                    <td class="px-4 py-4 font-black text-indigo-600 uppercase italic">{{ $p->anggota->nama }}</td>
                                    <td class="px-4 py-4 font-bold text-gray-700">{{ $p->buku->judul }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <form action="{{ route('peminjaman.setujui', $p) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" onclick="return confirm('Setujui?')" class="btn-anime bg-green-400 px-4 py-1 rounded-lg font-black text-xs uppercase">SETUJU</button>
                                            </form>
                                            <button onclick="document.getElementById('modal-tolak-{{ $p->id }}').classList.remove('hidden')" class="btn-anime bg-red-500 px-4 py-1 rounded-lg font-black text-white text-xs uppercase">TOLAK</button>
                                        </div>
                                        
                                        {{-- Modal Tolak Anime Style --}}
                                        <div id="modal-tolak-{{ $p->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50 p-4">
                                            <div class="bg-white anime-card p-8 w-full max-w-md rounded-[2rem]">
                                                <h4 class="font-black text-xl text-gray-900 mb-4 uppercase italic">Alasan Penolakan 🚫</h4>
                                                <form action="{{ route('peminjaman.tolak', $p) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <textarea name="catatan_admin" rows="3" placeholder="Sebutkan alasannya..." class="w-full anime-border rounded-xl p-3 font-bold focus:ring-red-500"></textarea>
                                                    <div class="flex gap-4 mt-6 font-black uppercase text-xs">
                                                        <button type="submit" class="flex-1 py-3 bg-red-500 text-white btn-anime rounded-xl">Konfirmasi</button>
                                                        <button type="button" onclick="document.getElementById('modal-tolak-{{ $p->id }}').classList.add('hidden')" class="flex-1 py-3 bg-gray-200 btn-anime rounded-xl text-gray-700">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endif

            {{-- Main Table --}}
            <div class="bg-white anime-card sm:rounded-[2.5rem] overflow-hidden">
                <div class="p-8 flex justify-between items-center border-b-4 border-gray-900 bg-indigo-50">
                    <h3 class="font-black text-xl text-gray-900 uppercase italic tracking-widest">📜 Riwayat Aktivitas</h3>
                    <a href="{{ route('peminjaman.create') }}" class="btn-anime inline-flex items-center px-6 py-3 bg-white text-gray-900 rounded-xl text-xs font-black uppercase tracking-widest">
                        + Pinjam Buku Baru
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-4 divide-gray-900">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Member</th>
                                <th class="px-4 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Judul Buku</th>
                                <th class="px-4 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Status</th>
                                <th class="px-4 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Access Token</th>
                                <th class="px-4 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Menu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-gray-900 bg-white">
                            @forelse($peminjamans as $p)
                            <tr class="hover:bg-indigo-50 transition duration-75">
                                <td class="px-4 py-4 font-black text-gray-900 italic uppercase">{{ $p->anggota->nama }}</td>
                                <td class="px-4 py-4 font-bold text-gray-600">{{ $p->buku->judul }}</td>
                                <td class="px-4 py-4">
                                    <span class="px-3 py-1 text-[10px] font-black rounded-full border-2 border-gray-900 shadow-[2px_2px_0px_#000] uppercase {{ $p->badgeStatus() }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @if($p->token)
                                        <span class="token-tag">#{{ $p->token }}</span>
                                    @else
                                        <span class="text-gray-400 font-bold italic text-xs">NO-TOKEN</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('peminjaman.show', $p) }}" class="btn-anime px-3 py-1 bg-white text-xs font-black uppercase rounded-lg">View</a>

                                        @if(auth()->user()->isAdmin())
                                            @if($p->status === 'disetujui')
                                                <form action="{{ route('peminjaman.ambil', $p) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="btn-anime px-3 py-1 bg-blue-400 text-white text-[10px] font-black uppercase rounded-lg">Ambil</button>
                                                </form>
                                            @endif
                                            @if($p->status === 'dipinjam')
                                                <form action="{{ route('peminjaman.kembalikan', $p) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="btn-anime px-3 py-1 bg-green-500 text-white text-[10px] font-black uppercase rounded-lg">Balik</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('peminjaman.destroy', $p) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button class="btn-anime px-3 py-1 bg-red-600 text-white text-[10px] font-black uppercase rounded-lg" onclick="return confirm('Hapus record?')">Del</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center">
                                    <p class="text-gray-400 font-black italic text-xl uppercase tracking-widest opacity-50">Empty Archive Data... 🌫️</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-gray-50 border-t-4 border-gray-900 font-black">
                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>