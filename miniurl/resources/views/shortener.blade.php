<x-layout>

    <x-slot:heading>
        Villámgyors URL Rövidítő
    </x-slot:heading>

    <div class="max-w-xl mx-auto">

        {{-- Sikeres link generálás kártya --}}
        @if (session('short_url'))
            <div class="mb-8 bg-white p-6 rounded-2xl shadow-lg shadow-emerald-500/5 border border-emerald-200/80 ring-1 ring-emerald-500/10">
                <div class="flex items-center justify-between gap-2 mb-3">
                    <div class="flex items-center gap-2.5 text-emerald-700 font-semibold text-sm">
                        <span class="flex h-6 w-6 rounded-full bg-emerald-100 items-center justify-center text-emerald-600 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span>A rövidített linked sikeresen elkészült!</span>
                    </div>
                    @if (session('name'))
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 truncate max-w-[150px]" title="{{ session('name') }}">
                            {{ session('name') }}
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Kattints a másoláshoz vagy teszteld:</label>
                    <div class="flex items-center gap-2">
                        <input type="text" id="generatedShortUrl" readonly value="{{ session('short_url') }}"
                            class="bg-slate-50 border border-slate-200 text-indigo-600 font-mono font-semibold text-sm rounded-xl focus:ring-2 focus:ring-indigo-500 block w-full px-3.5 py-2.5 select-all outline-none" />
                        
                        <button type="button" onclick="copyShortUrl(this)"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow-md shadow-indigo-500/20 transition duration-150 shrink-0 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Másolás</span>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between pt-3 border-t border-slate-100 text-xs text-slate-500 gap-2">
                    <span class="truncate max-w-xs" title="{{ session('original_url') }}">
                        Eredeti: <span class="text-slate-700 font-mono">{{ session('original_url') }}</span>
                    </span>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ session('short_url') }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-semibold hover:underline inline-flex items-center gap-1">
                            Megnyitás
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                        @auth
                            <a href="{{ route('links.index') }}" class="text-slate-600 hover:text-indigo-600 font-medium hover:underline">
                                Saját linkekhez →
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endif

        {{-- Fő űrlap kártya --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 mb-8">
            <form action="{{ route('shortenUrl') }}" method="POST">
                @csrf 

                {{-- Eredeti URL mező --}}
                <div class="mb-5">
                    <label for="original_url" class="block mb-2 text-sm font-semibold text-slate-700">
                        Hosszú URL cím <span class="text-indigo-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                        <input type="url" name="original_url" id="original_url" value="{{ old('original_url') }}"
                            class="bg-slate-50 border @error('original_url') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-100 @enderror text-slate-900 text-sm rounded-xl focus:ring-4 block w-full pl-10 pr-3.5 py-3 transition outline-none" 
                            placeholder="https://nagyon-hosszu-es-bonyolult-webcim.hu/..." required />
                    </div>
                    @error('original_url')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Link elnevezése (opcionális) --}}
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-2">
                        <label for="name" class="text-sm font-semibold text-slate-700">Link elnevezése</label>
                        <span class="text-xs text-slate-400">Opcionális (3-30 karakter)</span>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="bg-slate-50 border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-100 @enderror text-slate-900 text-sm rounded-xl focus:ring-4 block w-full pl-10 pr-3.5 py-3 transition outline-none" 
                            placeholder="pl. GitHub profilom vagy Projekt dokumentáció" />
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Egyedi link (short_url) mező --}}
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <label for="short_url" class="text-sm font-semibold text-slate-700">Egyedi link végződés</label>
                        <span class="text-xs text-slate-400">Opcionális (3-50 karakter)</span>
                    </div>
                    <div class="flex rounded-xl shadow-sm overflow-hidden">
                        <span class="inline-flex items-center px-3.5 bg-slate-100 border border-r-0 border-slate-300 text-slate-500 text-xs sm:text-sm font-mono select-none">
                            {{ url('/') }}/
                        </span>
                        <input type="text" name="short_url" id="short_url" value="{{ old('short_url') }}"
                            class="bg-slate-50 border @error('short_url') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-100 @enderror text-slate-900 text-sm rounded-r-xl focus:ring-4 block w-full px-3.5 py-3 transition outline-none font-mono" 
                            placeholder="egyedi-link" />
                    </div>
                    @error('short_url')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit gomb --}}
                <button type="submit" 
                    class="w-full py-3.5 px-6 text-white font-semibold text-sm rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-700 to-blue-600 hover:from-indigo-500 hover:to-blue-500 focus:ring-4 focus:ring-indigo-100 shadow-lg shadow-indigo-500/25 transition duration-200 flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span>Rövidítés most!</span>
                </button>
            </form>
        </div>

        {{-- Bejelentkezési állapot infó --}}
        <div class="mb-10 text-center">
            @auth
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-full text-xs font-medium border border-indigo-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Bejelentkezve mint <strong class="font-semibold">{{ auth()->user()->name }}</strong>. 
                    <a href="{{ route('links.index') }}" class="underline hover:text-indigo-900 font-bold ml-1">Megnézem a linkjeimet &rarr;</a>
                </div>
            @else
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 rounded-full text-xs font-medium border border-slate-200">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Szeretnéd nyomon követni a kattintásokat? 
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Jelentkezz be</a> 
                    vagy 
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Regisztrálj ingyen</a>!
                </div>
            @endauth
        </div>

        {{-- Funkció kártyák --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm text-center">
                <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Villámgyors</h3>
                <p class="text-xs text-slate-500">Azonnali átirányítás a legkisebb késleltetés nélkül.</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm text-center">
                <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Statisztika</h3>
                <p class="text-xs text-slate-500">Kattintások számlálása valós időben minden linknél.</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm text-center">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Biztonságos</h3>
                <p class="text-xs text-slate-500">Egyedi, privát linkek közvetlenül a saját fiókodban.</p>
            </div>
        </div>

    </div>

    {{-- Másolás Script --}}
    <script>
        function copyShortUrl(btn) {
            const input = document.getElementById('generatedShortUrl');
            if (!input) return;

            navigator.clipboard.writeText(input.value).then(() => {
                const originalHtml = btn.innerHTML;
                btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                btn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                btn.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Másolva!</span>
                `;
                setTimeout(() => {
                    btn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                    btn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                    btn.innerHTML = originalHtml;
                }, 2000);
            });
        }
    </script>

    <x-slot:pagetitle>
        Shortener
    </x-slot:pagetitle>

    <x-slot:idezet>
        Minek ide idézet, ha odabasz a kinézet
    </x-slot:idezet>
</x-layout>