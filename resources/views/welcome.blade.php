<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perpustakaan Anime') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=quicksand:500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Quicksand', sans-serif; }
        .anime-border { border: 3px solid #2d3436; }
        .anime-shadow { shadow-offset: 4px 4px 0px #2d3436; box-shadow: 6px 6px 0px #2d3436; }
        .anime-shadow-hover:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0px #2d3436; transition: all 0.2s ease; }
    </style>
</head>
<body class="font-sans antialiased bg-[#e0f7fa]">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white border-b-4 border-gray-800 sticky top-0 z-50 py-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <span class="text-3xl font-black text-gray-800 tracking-tighter">
                            <span class="bg-yellow-400 px-2 py-1 anime-border rounded-lg mr-1">読書</span> JULIAN-KUN
                        </span>
                    </div>
                    <div class="flex items-center space-x-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-pink-500 font-bold transition text-lg">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-800 hover:text-pink-500 font-bold transition text-lg">Log in</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2 bg-pink-400 anime-border anime-shadow rounded-full font-bold text-sm text-white hover:bg-pink-500 transition active:translate-y-1">
                                JOIN US!
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid md:grid-cols-2 gap-12 items-center bg-white/60 p-10 rounded-[3rem] anime-border">
                    <div>
                        <span class="inline-block px-4 py-1 bg-indigo-500 text-white font-bold rounded-full text-xs mb-4">NEW ADVENTURE!</span>
                        <h1 class="text-5xl md:text-6xl font-black text-gray-800 leading-[1.1]">
                            Ayo <span class="text-pink-500 italic">Membaca</span> & Temukan Dunia Baru!
                        </h1>
                        <p class="text-xl text-gray-700 mt-6 font-medium leading-relaxed">
                            Kelola koleksi bukumu seolah sedang menyusun strategi kemenangan! Cepat, efisien, dan penuh semangat! ✨
                        </p>
                        <div class="mt-10 flex flex-wrap gap-6">
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-yellow-400 text-gray-800 font-black text-lg rounded-2xl anime-border anime-shadow anime-shadow-hover">
                                    KE DASHBOARD →
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-500 text-white font-black text-lg rounded-2xl anime-border anime-shadow anime-shadow-hover">
                                    MULAI PETUALANGAN
                                </a>
                                <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-gray-800 font-black text-lg rounded-2xl anime-border hover:bg-gray-100 transition">
                                    MASUK
                                </a>
                            @endauth
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-300 rounded-full blur-3xl opacity-50"></div>
                        <img src="https://illustrations.popsy.co/amber/reading-book.svg" alt="Anime Style Reading" class="w-full max-w-md mx-auto drop-shadow-2xl animate-bounce-slow">
                    </div>
                </div>
            </div>

            <div class="py-20 bg-indigo-50 border-t-4 border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-black text-gray-800 uppercase tracking-widest">Power-Ups Kami!</h2>
                        <div class="h-2 w-24 bg-pink-500 mx-auto mt-4 rounded-full"></div>
                    </div>
                    <div class="grid md:grid-cols-3 gap-10">
                        <div class="bg-white p-8 rounded-3xl anime-border anime-shadow hover:-translate-y-2 transition-all duration-300">
                            <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center text-4xl mb-6 anime-border">📖</div>
                            <h3 class="text-2xl font-black mb-3 text-gray-800">Katalog Sakti</h3>
                            <p class="text-gray-600 font-medium">Susun ribuan buku sihir dan pengetahuanmu dalam satu rak digital yang rapi!</p>
                        </div>
                        <div class="bg-white p-8 rounded-3xl anime-border anime-shadow hover:-translate-y-2 transition-all duration-300">
                            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-4xl mb-6 anime-border">🎎</div>
                            <h3 class="text-2xl font-black mb-3 text-gray-800">Aliansi Anggota</h3>
                            <p class="text-gray-600 font-medium">Pantau siapa saja kawanmu yang sedang meminjam buku dengan riwayat yang jelas.</p>
                        </div>
                        <div class="bg-white p-8 rounded-3xl anime-border anime-shadow hover:-translate-y-2 transition-all duration-300">
                            <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center text-4xl mb-6 anime-border">⚡</div>
                            <h3 class="text-2xl font-black mb-3 text-gray-800">Kilat Transaksi</h3>
                            <p class="text-gray-600 font-medium">Pinjam dan kembalikan secepat kilat tanpa drama denda yang membingungkan!</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white border-t-4 border-gray-800 py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-800 font-bold text-lg italic">
                    Dibuat dengan ❤️ oleh <span class="text-pink-500">Andrian-Sama</span> &copy; {{ date('Y') }}
                </p>
                <p class="text-sm text-gray-500 mt-2">Ganbatte Kudasai! Semangat belajarnya!</p>
            </div>
        </footer>
    </div>
</body>
</html>