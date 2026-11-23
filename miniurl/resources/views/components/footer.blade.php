<footer class="mt-auto border-t border-slate-800/80 bg-slate-950/90 text-slate-300">
    <div class="mx-auto max-w-6xl px-6 py-8 md:flex md:items-center md:justify-between lg:px-8">
        <div class="flex flex-col gap-1">
            <h3 class="text-base font-bold tracking-tight text-indigo-400">
                {{ $pagetitle ?? 'MiniURL Projekt' }}
            </h3>
            <p class="text-sm text-slate-400 italic">
                {{ $idezet ?? 'Rövidíts okosan, élj szabadon!' }}
            </p>
        </div>

        <div class="mt-6 md:mt-0 text-center md:text-right">
            <p class="text-xs text-slate-500">
                &copy; {{ date('Y') }} MiniURL Hub. Minden jog fenntartva.
            </p>
            <div class="mt-1.5 flex justify-center md:justify-end space-x-5 text-xs text-slate-500">
                <a href="#" class="hover:text-indigo-400 transition">Adatvédelem</a>
                <a href="#" class="hover:text-indigo-400 transition">Feltételek</a>
            </div>
        </div>
    </div>
</footer>
