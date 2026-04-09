<footer class="bg-gray-900 text-white mt-auto border-t border-gray-700">
    <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
        
        <div class="flex flex-col gap-2 md:order-1 md:mt-0">
            <h3 class="text-xl font-bold tracking-tight text-indigo-400">
                {{ $pagetitle ?? 'MiniURL Projekt' }}
            </h3>
            <p class="text-sm text-gray-400 italic">
                {{ $idezet ?? 'Rövidíts okosan, élj szabadon!' }}
            </p>
        </div>

        <div class="mt-8 md:order-2 md:mt-0">
            <p class="text-center text-xs leading-5 text-gray-400">
                &copy; {{ date('Y') }} MiniURL Inc. Minden jog fenntartva.
            </p>
            <div class="mt-2 flex justify-center space-x-6 text-xs text-gray-500">
                <a href="#" class="hover:text-indigo-400">Adatvédelem</a>
                <a href="#" class="hover:text-indigo-400">Feltételek</a>
            </div>
        </div>
    </div>
</footer>