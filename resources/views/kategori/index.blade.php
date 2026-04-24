<x-app-layout>
    <style>
        .anime-panel { border: 4px solid #1a1a1a; box-shadow: 8px 8px 0px #1a1a1a; }
        .anime-btn-primary { border: 3px solid #1a1a1a; box-shadow: 4px 4px 0px #1a1a1a; transition: all 0.1s; }
        .anime-btn-primary:active { transform: translate(2px, 2px); box-shadow: 0px 0px 0px #1a1a1a; }
        .anime-table-head { border-bottom: 4px solid #1a1a1a; }
    </style>

    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight flex items-center tracking-tight uppercase italic">
            <span class="bg-indigo-500 text-white p-2 border-2 border-gray-900 rounded-lg mr-3 shadow-[3px_3px_0px_#000]">📂</span> 
            Kategori Buku
        </h2>
    </x-slot>

    <div class="py-8 bg-[#fff5f5]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white anime-panel overflow-hidden sm:rounded-[2rem]">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-xl font-black text-gray-900 uppercase tracking-widest italic">✨ Daftar Kategori</h3>
                        <a href="{{ route('kategori.create') }}" class="anime-btn-primary inline-flex items-center px-6 py-3 bg-yellow-400 rounded-xl text-sm font-black text-gray-900 hover:bg-yellow-300 transition uppercase">
                            <svg class="w-5 h-5 mr-2 stroke-[3px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Kategori
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-400 border-4 border-gray-900 p-4 mb-8 rounded-xl shadow-[4px_4px_0px_#000]">
                            <p class="text-gray-900 font-black italic">✅ {{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto border-4 border-gray-900 rounded-[1.5rem]">
                        <table class="min-w-full divide-y-4 divide-gray-900">
                            <thead class="bg-indigo-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-tighter">Nama Kategori</th>
                                    <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-tighter">Deskripsi</th>
                                    <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-tighter">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y-2 divide-gray-900">
                                @forelse($kategoris as $kategori)
                                <tr class="hover:bg-pink-50 transition duration-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-black text-gray-900 text-lg uppercase italic">{{ $kategori->nama }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-gray-700 font-bold leading-relaxed">{{ $kategori->deskripsi ?? '---' }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('kategori.show', $kategori) }}" class="anime-btn-primary px-3 py-1 bg-blue-400 rounded-lg font-black text-white text-xs uppercase">Detail</a>
                                            <a href="{{ route('kategori.edit', $kategori) }}" class="anime-btn-primary px-3 py-1 bg-emerald-400 rounded-lg font-black text-white text-xs uppercase">Edit</a>
                                            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="anime-btn-primary px-3 py-1 bg-red-500 rounded-lg font-black text-white text-xs uppercase" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <p class="text-gray-400 font-black italic text-xl uppercase tracking-widest">Gomen! Belum ada data.. 🌸</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-8 font-black">
                        {{ $kategoris->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>