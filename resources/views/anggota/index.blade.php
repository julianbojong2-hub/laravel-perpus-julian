<x-app-layout>
    <style>
        .anime-border { border: 4px solid #1a1a1a; }
        .anime-shadow { box-shadow: 8px 8px 0px #1a1a1a; }
        .btn-action { border: 2px solid #1a1a1a; box-shadow: 3px 3px 0px #1a1a1a; transition: all 0.1s; }
        .btn-action:active { transform: translate(2px, 2px); box-shadow: 0px 0px 0px #1a1a1a; }
        .neo-label { border: 2px solid #1a1a1a; box-shadow: 2px 2px 0px #1a1a1a; }
    </style>

    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 leading-tight flex items-center italic uppercase tracking-tighter">
            <span class="bg-green-400 p-2 anime-border rounded-lg mr-3 shadow-[3px_3px_0px_#000]">👥</span> 
            Manajemen Anggota
        </h2>
    </x-slot>

    <div class="py-8 bg-[#f0f9ff]"> <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white anime-border anime-shadow sm:rounded-[2rem] overflow-hidden">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 uppercase italic tracking-widest">📋 Database Member</h3>
                            <div class="h-1 w-full bg-green-400 mt-1 anime-border"></div>
                        </div>
                        
                        <a href="{{ route('anggota.create') }}" class="btn-action inline-flex items-center px-6 py-3 bg-yellow-300 text-gray-900 rounded-xl text-sm font-black uppercase tracking-widest hover:bg-yellow-200 transition">
                            <svg class="w-5 h-5 mr-2 stroke-[3px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Registrasi Anggota
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-indigo-500 anime-border p-4 mb-8 rounded-xl shadow-[4px_4px_0px_#000]">
                            <p class="text-white font-black italic">🌟 INFO: {{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto anime-border rounded-[1.5rem]">
                        <table class="min-w-full divide-y-4 divide-gray-900">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Identitas</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Kontak Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic">No. Telepon</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic">Lokasi/Alamat</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-gray-800 uppercase italic text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y-2 divide-gray-900">
                                @forelse($anggotas as $anggota)
                                <tr class="hover:bg-green-50 transition duration-75">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-indigo-100 anime-border rounded-full flex items-center justify-center font-black text-indigo-600 mr-3">
                                                {{ substr($anggota->nama, 0, 1) }}
                                            </div>
                                            <div class="font-black text-gray-900 uppercase italic text-md">{{ $anggota->nama }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-gray-600 bg-gray-100 px-2 py-1 rounded border border-gray-300 italic">{{ $anggota->email }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-black text-gray-800">
                                        {{ $anggota->telepon }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 font-medium max-w-xs truncate italic">
                                        📍 {{ $anggota->alamat }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('anggota.show', $anggota) }}" class="btn-action px-4 py-1 bg-blue-400 text-white font-black text-[10px] uppercase rounded-lg">View</a>
                                            <a href="{{ route('anggota.edit', $anggota) }}" class="btn-action px-4 py-1 bg-emerald-400 text-white font-black text-[10px] uppercase rounded-lg">Edit</a>
                                            <form action="{{ route('anggota.destroy', $anggota) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action px-4 py-1 bg-red-500 text-white font-black text-[10px] uppercase rounded-lg" onclick="return confirm('Hapus data anggota?')">Del</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-5xl mb-4">🛸</span>
                                            <p class="text-gray-400 font-black italic text-xl uppercase tracking-widest">Tidak ada anggota terdeteksi!</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-8">
                        {{ $anggotas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>