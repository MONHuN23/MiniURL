<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $heading ?? 'MiniURL' }} — MiniURL Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white">

    {{-- Subtle background glow --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden -z-10">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[48rem] h-[24rem] rounded-full bg-indigo-600/20 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[30rem] h-[20rem] rounded-full bg-violet-600/10 blur-3xl"></div>
    </div>

    {{-- Navigation --}}
    <nav class="sticky top-0 z-30 border-b border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="/" class="flex items-center gap-2.5 group">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/25 text-white font-bold text-lg group-hover:scale-105 transition">
                            M
                        </span>
                        <span class="text-lg font-bold tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                            MiniURL
                        </span>
                    </a>

                    <div class="flex items-center gap-1">
                        <x-nav-link href="/" :active="request()->is('/')">Shortener</x-nav-link>
                        @auth
                            <x-nav-link href="/links" :active="request()->is('links')">My Links</x-nav-link>
                            <x-nav-link href="/passwords" :active="request()->is('passwords')">Passwords</x-nav-link>
                        @endauth
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white px-3 py-2 transition">
                            Login
                        </a>
                        <x-nav-button href="/register">Register</x-nav-button>
                    @endguest

                    @auth
                        <a href="/profile"
                            class="inline-flex items-center gap-2 text-sm px-2.5 py-1.5 rounded-full border transition {{ request()->is('profile') ? 'bg-indigo-500/15 border-indigo-500/40 text-white' : 'bg-slate-900 border-slate-800 hover:border-slate-600 text-slate-300 hover:text-white' }}">
                            @if (auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                    alt="{{ auth()->user()->name }}"
                                    class="h-6 w-6 rounded-full object-cover border border-indigo-400/40" />
                            @else
                                <span class="h-6 w-6 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-xs font-bold text-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            @endif
                            <span class="hidden sm:inline pr-1">{{ auth()->user()->name }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="rounded-lg border border-slate-700 bg-slate-900 hover:bg-slate-800 hover:border-slate-600 text-slate-200 px-3.5 py-2 text-sm font-medium transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Optional Page Header --}}
    @isset($heading)
        <header class="pt-12 pb-4 text-center px-4">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-white via-indigo-100 to-violet-300 bg-clip-text text-transparent">
                {{ $heading }}
            </h1>
            @isset($subtitle)
                <p class="mt-3 text-slate-400 max-w-xl mx-auto text-base">
                    {{ $subtitle }}
                </p>
            @endisset
        </header>
    @endisset

    {{-- Main Content --}}
    <main class="flex-1 mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8 py-8">
        {{-- Flash Messages --}}
        @if (session('success'))
            <div id="flash-banner"
                class="mb-6 rounded-2xl border border-emerald-500/30 bg-emerald-950/50 backdrop-blur-md px-5 py-4 text-emerald-100 shadow-lg shadow-emerald-950/40">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-emerald-300 flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                            {{ session('success') }}
                        </p>

                        @if (session('short_url'))
                            <div class="flex flex-wrap items-center gap-2 pt-1">
                                <a href="{{ session('short_url') }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center rounded-lg bg-slate-950/80 border border-emerald-500/30 px-3 py-1.5 text-sm font-mono text-indigo-300 hover:text-indigo-200 underline underline-offset-4 transition">
                                    {{ session('short_url') }}
                                </a>
                                <button type="button"
                                    onclick="navigator.clipboard.writeText('{{ session('short_url') }}'); this.textContent='Copied!'; setTimeout(() => this.textContent='Copy', 1500)"
                                    class="rounded-lg border border-emerald-500/30 bg-emerald-500/10 hover:bg-emerald-500/20 px-3 py-1.5 text-xs font-medium text-emerald-200 transition cursor-pointer">
                                    Copy
                                </button>
                            </div>
                        @endif

                        @if (session('changes') && count(session('changes')) > 0)
                            <ul class="mt-1 space-y-1 text-xs text-emerald-200/90 list-disc list-inside">
                                @foreach (session('changes') as $change)
                                    <li>{{ $change }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <button type="button" onclick="document.getElementById('flash-banner').remove()"
                        class="text-emerald-300/70 hover:text-emerald-200 text-lg leading-none cursor-pointer"
                        aria-label="Dismiss">
                        &times;
                    </button>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer>
        <x-slot:pagetitle>{{ $pagetitle ?? 'MiniURL' }}</x-slot:pagetitle>
        <x-slot:idezet>{{ $idezet ?? 'Rövidíts okosan, élj szabadon!' }}</x-slot:idezet>
    </x-footer>

</body>
</html>
