<x-app-layout>
    <style>
        .anime-card { border: 4px solid #1a1a1a; box-shadow: 10px 10px 0px #1a1a1a; }
        .btn-anime { border: 3px solid #1a1a1a; box-shadow: 4px 4px 0px #1a1a1a; transition: all 0.1s; }
        .btn-anime:active { transform: translate(2px, 2px); box-shadow: 0px 0px 0px #1a1a1a; }
        .status-badge { border: 2px solid #1a1a1a; box-shadow: 2px 2px 0px #1a1a1a; }
        .table-container { border: 4px solid #1a1a1a; }
    </style>

    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight flex items-center italic tracking-tighter uppercase">
            <span class="bg-yellow-400 p-2 border-2 border-gray-900 rounded-lg mr-3 shadow-[3px_3px_0px_#000]">📚</span> 
            Koleksi Buku Perpustakaan
        </h2>
    </x-slot>

    <div class="py-8 bg-[#fdf2f8]"> <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white anime-card sm:rounded-[2.5rem] overflow-hidden">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 uppercase italic">📖 Daftar Buku</h3>
                            <div class="h-1.5 w-20 bg-indigo-500 mt-1 border border-gray-900"></div>
                        </div>
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('buku.create') }}" class="btn-anime inline-flex items-center px-6 py-3 bg-indigo-500 text-white rounded-xl text-sm font-black uppercase tracking-widest hover:bg-indigo-600 transition">
                                <svg class="w-5 h-5 mr-2 stroke-[3px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                Tambah Buku Baru
                            </a>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="bg-blue-400 border-4 border-gray-900 p-4 mb-8 rounded-xl shadow-[4px_4px_0px_#000]">
                            <p class="text-white font-black italic uppercase tracking-tight">✨ Sugoi! {{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto table-container rounded-[1.5rem]">
                        <table class="min-w-full divide-y-4 divide-gray-900">
                            <thead class="bg-pink-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic tracking-widest">Judul Buku</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic tracking-widest">Penulis</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic tracking-widest">Kategori</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic tracking-widest text-center">Stok</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic tracking-widest">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y-2 divide-gray-900">
                                @forelse($bukus as $buku)
                                <tr class="hover:bg-yellow-50 transition-colors duration-75">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-black text-gray-900 text-lg uppercase">{{ $buku->judul }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-600 italic">
                                        {{ $buku->penulis }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-purple-100 border-2 border-gray-900 rounded-md text-xs font-black uppercase text-purple-700">
                                            {{ $buku->kategori->nama }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="status-badge px-4 py-1 text-sm font-black rounded-full inline-block {{ $buku->stok > 0 ? 'bg-green-400 text-gray-900' : 'bg-red-500 text-white' }}">
                                            {{ $buku->stok }} Qty
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('buku.show', $buku) }}" class="btn-anime px-3 py-1 bg-white text-gray-900 font-black text-[10px] uppercase rounded-lg">Info</a>
                                            
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('buku.edit', $buku) }}" class="btn-anime px-3 py-1 bg-amber-400 text-gray-900 font-black text-[10px] uppercase rounded-lg">Edit</a>
                                                <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn-anime px-3 py-1 bg-red-500 text-white font-black text-[10px] uppercase rounded-lg" onclick="return confirm('Hapus buku ini dari perpustakaan?')">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-6xl mb-4">🙊</span>
                                            <p class="text-gray-400 font-black italic text-2xl uppercase tracking-tighter">Rak buku masih kosong!</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-8 font-black uppercase italic">
                        {{ $bukus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>