<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $heading ?? 'Alapértelmezett Cím' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <div class="min-h-full">

        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">

                    {{-- Bal oldal --}}
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img
                                class="size-8"
                                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Logo"
                            >
                        </div>

                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-nav-link
                                :href="route('home')"
                                :active="request()->routeIs('home')"
                            >
                                Shortener
                            </x-nav-link>

                            @auth
                                <x-nav-link
                                    :href="route('links.index')"
                                    :active="request()->routeIs('links.index')"
                                >
                                    My Links
                                </x-nav-link>
                            @endauth
                        </div>
                    </div>

                    {{-- Jobb oldal: bejelentkezés / regisztráció / kijelentkezés --}}
                    <div class="flex items-center gap-3">
                        @auth
                            <div class="flex items-center gap-2 bg-gray-900/60 border border-gray-700 rounded-full py-1 px-3 text-white">
                                <div class="w-6 h-6 rounded-full bg-indigo-600 flex items-center justify-center text-xs font-bold uppercase text-white shadow-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-200">
                                    {{ auth()->user()->name }}
                                </span>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf

                                <button
                                    type="submit"
                                    class="rounded-md bg-gray-700/50 hover:bg-gray-700 px-3 py-1.5 text-sm font-medium text-gray-300 hover:text-white transition duration-150"
                                >
                                    Logout
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Sign In
                            </a>

                            <a
                                href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500"
                            >
                                Sign Up
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </nav>

        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    {{ $heading }}
                </h1>
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="max-w-sm mx-auto mb-6 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

    </div>

    <x-footer>
        <x-slot:pagetitle>
            {{ $pagetitle ?? 'MiniURL' }}
        </x-slot:pagetitle>

        <x-slot:idezet>
            {{ $idezet ?? 'Alapértelmezett idézet' }}
        </x-slot:idezet>
    </x-footer>

</body>
</html>