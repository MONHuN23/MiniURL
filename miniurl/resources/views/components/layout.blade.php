<!DOCTYPE html>
<html lang="hu" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $heading ?? 'MiniURL' }} | Modern Linkrövidítő</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-slate-50 text-slate-800 antialiased">
    <div class="flex-1 flex flex-col">

        {{-- Navigációs sáv --}}
        <nav class="sticky top-0 z-50 bg-slate-900/95 backdrop-blur-md border-b border-slate-800 shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">

                    {{-- Bal oldal: Logó --}}
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold tracking-tight text-white">
                                Mini<span class="text-indigo-400">URL</span>
                            </span>
                        </a>
                    </div>

                    {{-- Jobb oldal: Auth / Profil legördülő menü --}}
                    <div class="flex items-center gap-3">
                        @auth
                            <div class="relative" id="userMenuDropdownContainer">
                                {{-- Kattintható profil gomb --}}
                                <button
                                    type="button"
                                    id="userMenuButton"
                                    onclick="toggleUserDropdown()"
                                    class="flex items-center gap-2.5 bg-slate-800/90 hover:bg-slate-800 border border-slate-700/80 hover:border-slate-600 rounded-full py-1.5 pl-1.5 pr-3 text-white shadow-sm transition duration-150 cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900"
                                >
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-indigo-600 to-indigo-500 flex items-center justify-center text-xs font-bold uppercase text-white shadow-sm">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-slate-200">
                                        {{ auth()->user()->name }}
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" id="userDropdownChevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                {{-- Legördülő menü doboz --}}
                                <div
                                    id="userDropdownMenu"
                                    class="hidden absolute right-0 mt-2 w-60 rounded-2xl bg-white shadow-xl shadow-slate-900/15 border border-slate-200/80 py-1.5 z-50 transition-all duration-150"
                                >
                                    {{-- Felhasználói infó fejléc --}}
                                    <div class="px-4 py-3 border-b border-slate-100">
                                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Bejelentkezve mint</p>
                                        <p class="text-sm font-bold text-slate-900 truncate mt-0.5">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                                    </div>

                                    {{-- Menüpontok --}}
                                    <div class="py-1">
                                        <a
                                            href="{{ route('links.index') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 font-medium transition"
                                        >
                                            <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                </svg>
                                            </div>
                                            <span>Saját linkjeim</span>
                                        </a>

                                        <a
                                            href="{{ route('home') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 font-medium transition"
                                        >
                                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </div>
                                            <span>Új link rövidítése</span>
                                        </a>
                                    </div>

                                    {{-- Kijelentkezés --}}
                                    <div class="border-t border-slate-100 pt-1">
                                        <form method="POST" action="{{ route('logout') }}" class="block w-full">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50 font-medium transition cursor-pointer text-left"
                                            >
                                                <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                    </svg>
                                                </div>
                                                <span>Kijelentkezés</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center gap-2">
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-lg px-3.5 py-1.5 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition duration-150"
                                >
                                    Sign In
                                </a>

                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-lg bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 px-3.5 py-1.5 text-sm font-medium text-white shadow-sm shadow-indigo-500/20 transition duration-150"
                                >
                                    Sign Up
                                </a>
                            </div>
                        @endauth
                    </div>

                </div>
            </div>
        </nav>

        {{-- Fejléc / Hero Cím --}}
        @isset($heading)
            <header class="pt-8 pb-4 sm:pt-10 sm:pb-6 text-center">
                <div class="mx-auto max-w-4xl px-4 sm:px-6">
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        {{ $heading }}
                    </h1>
                </div>
            </header>
        @endisset

        {{-- Tartalom --}}
        <main class="flex-1 pb-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="max-w-md mx-auto mb-6 p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 text-center flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

    </div>

    {{-- Lábléc --}}
    <x-footer>
        <x-slot:pagetitle>
            {{ $pagetitle ?? 'MiniURL' }}
        </x-slot:pagetitle>

        <x-slot:idezet>
            {{ $idezet ?? 'Rövidíts okosan, egyszerűen és villámgyorsan.' }}
        </x-slot:idezet>
    </x-footer>

    {{-- Felhasználói legördülő menü kezelő script --}}
    <script>
        function toggleUserDropdown() {
            const menu = document.getElementById('userDropdownMenu');
            const chevron = document.getElementById('userDropdownChevron');
            if (menu) {
                const isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                if (chevron) {
                    chevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            }
        }

        document.addEventListener('click', function(event) {
            const container = document.getElementById('userMenuDropdownContainer');
            const menu = document.getElementById('userDropdownMenu');
            const chevron = document.getElementById('userDropdownChevron');
            if (container && menu && !container.contains(event.target)) {
                menu.classList.add('hidden');
                if (chevron) {
                    chevron.style.transform = 'rotate(0deg)';
                }
            }
        });
    </script>

</body>
</html>