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
                        <span class="hidden sm:inline-flex items-center gap-2 text-sm text-slate-300 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-800">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                            {{ auth()->user()->name }}
                        </span>
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
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer>
        <x-slot:pagetitle>{{ $pagetitle ?? 'MiniURL' }}</x-slot:pagetitle>
        <x-slot:idezet>{{ $idezet ?? 'Rövidíts okosan, élj szabadon!' }}</x-slot:idezet>
    </x-footer>

</body>
</html>
