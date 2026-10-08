<footer class="bg-slate-900 text-white mt-auto border-t border-slate-800">
    <div class="mx-auto max-w-7xl px-6 py-10 md:flex md:items-center md:justify-between lg:px-8">
        
        <div class="flex flex-col gap-1.5 md:order-1 md:mt-0">
            <div class="flex items-center gap-2">
                <span class="text-base font-bold tracking-tight text-white">
                    Mini<span class="text-indigo-400">URL</span>
                </span>
                <span class="text-xs px-2 py-0.5 rounded-full bg-slate-800 text-slate-400 border border-slate-700">v1.0</span>
            </div>
            <p class="text-xs text-slate-400 italic">
                {{ $idezet ?? 'Rövidíts okosan, egyszerűen és villámgyorsan.' }}
            </p>
        </div>

        <div class="mt-6 md:order-2 md:mt-0 flex flex-col md:items-end gap-1.5">
            <p class="text-xs text-slate-400">
                &copy; {{ date('Y') }} MiniURL. Minden jog fenntartva.
            </p>
            <div class="flex space-x-4 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-indigo-400 transition">Főoldal</a>
                @auth
                    <a href="{{ route('links.index') }}" class="hover:text-indigo-400 transition">Saját linkjeim</a>
                @endauth
            </div>
        </div>
    </div>
</footer>