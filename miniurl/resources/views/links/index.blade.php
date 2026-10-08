<x-layout>

    <x-slot:heading>
        Saját linkjeim
    </x-slot:heading>

    <x-slot:pagetitle>
        Saját linkjeim | MiniURL
    </x-slot:pagetitle>

    <x-slot:idezet>
        Itt találod az eddig létrehozott rövidített linkjeidet és a kattintási statisztikákat.
    </x-slot:idezet>

    <div class="w-full">
        {{-- Fejléc sáv és Új link gomb --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Mentett linkek</h2>
                <p class="text-sm text-slate-500">Összesen {{ $links->count() }} rövidített link a fiókodban.</p>
            </div>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 transition duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Új link rövidítése
            </a>
        </div>

        @if ($links->isEmpty())
            {{-- Üres állapot (Empty state) --}}
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 p-12 text-center">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">Még nincsenek mentett linkjeid</h3>
                <p class="text-sm text-slate-500 mb-6 max-w-sm mx-auto">Rövidíts le egy tetszőleges URL-t, és az automatikusan meg fog jelenni ezen a listán!</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Link készítése most
                </a>
            </div>
        @else
            {{-- Linkek táblázata --}}
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto min-h-[220px]">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-600">
                                <th class="py-3.5 px-4 sm:px-6">Link neve & Cél URL</th>
                                <th class="py-3.5 px-4 sm:px-6">Rövidített link</th>
                                <th class="py-3.5 px-4 sm:px-6 text-center">Kattintások</th>
                                <th class="py-3.5 px-4 sm:px-6">Létrehozva</th>
                                <th class="py-3.5 px-4 sm:px-6 text-right w-20">Műveletek</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach ($links as $link)
                                <tr class="hover:bg-slate-50/75 transition">
                                    {{-- Név & Cél URL --}}
                                    <td class="py-4 px-4 sm:px-6 max-w-xs sm:max-w-md lg:max-w-xl">
                                        @if ($link->name)
                                            <div class="font-bold text-slate-900 truncate mb-0.5" title="{{ $link->name }}">
                                                {{ $link->name }}
                                            </div>
                                            <a href="{{ $link->original_url }}" target="_blank" rel="noopener noreferrer" 
                                               class="text-xs text-slate-500 hover:text-indigo-600 font-normal truncate block transition" 
                                               title="{{ $link->original_url }}">
                                                {{ $link->original_url }}
                                            </a>
                                        @else
                                            <a href="{{ $link->original_url }}" target="_blank" rel="noopener noreferrer" 
                                               class="text-slate-900 hover:text-indigo-600 font-medium truncate block transition" 
                                               title="{{ $link->original_url }}">
                                                {{ $link->original_url }}
                                            </a>
                                        @endif
                                    </td>

                                    {{-- Rövidített URL + Másolás gomb --}}
                                    <td class="py-4 px-4 sm:px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ url('/' . $link->short_url) }}" target="_blank" 
                                               class="font-mono text-indigo-600 hover:text-indigo-800 font-semibold hover:underline">
                                                {{ url('/' . $link->short_url) }}
                                            </a>
                                            <button type="button" 
                                                    onclick="copyToClipboard('{{ url('/' . $link->short_url) }}', this)"
                                                    class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition cursor-pointer" 
                                                    title="Másolás a vágólapra">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>

                                    {{-- Kattintások száma --}}
                                    <td class="py-4 px-4 sm:px-6 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            {{ $link->clicks }} megnyitás
                                        </span>
                                    </td>

                                    {{-- Dátum --}}
                                    <td class="py-4 px-4 sm:px-6 text-slate-500 whitespace-nowrap text-xs">
                                        {{ $link->created_at ? $link->created_at->format('Y.m.d H:i') : '-' }}
                                    </td>

                                    {{-- Három pont menü (Műveletek) --}}
                                    <td class="py-4 px-4 sm:px-6 text-right whitespace-nowrap">
                                        <div class="inline-block text-left relative" id="action-dropdown-{{ $link->id }}">
                                            <button type="button" 
                                                    onclick="toggleRowMenu({{ $link->id }})"
                                                    class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition cursor-pointer"
                                                    title="Műveletek">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                </svg>
                                            </button>

                                            {{-- Legördülő műveleti menü --}}
                                            <div id="row-menu-{{ $link->id }}" 
                                                 class="hidden absolute right-0 mt-1 w-36 bg-white rounded-xl shadow-lg shadow-slate-900/10 border border-slate-200 py-1 z-30 text-left">
                                                
                                                {{-- Szerkesztés --}}
                                                <button type="button"
                                                        onclick="openEditModal({{ $link->id }}, '{{ addslashes($link->name ?? '') }}', '{{ addslashes($link->original_url) }}', '{{ addslashes($link->short_url) }}')"
                                                        class="w-full flex items-center gap-2 px-3.5 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition cursor-pointer">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Szerkesztés
                                                </button>

                                                {{-- Törlés --}}
                                                <form action="{{ route('links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Biztosan törölni szeretnéd ezt a linket?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full flex items-center gap-2 px-3.5 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50 transition cursor-pointer">
                                                        <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Törlés
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    {{-- Szerkesztés Modális Ablak (Edit Modal) --}}
    <div id="editModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4" onclick="closeEditModal()">
        <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-7 relative transition-all" onclick="event.stopPropagation()">
            
            {{-- Modal fejléc --}}
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Link szerkesztése</h3>
                </div>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Modal Form --}}
            <form id="editLinkForm" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="edit_name" class="block mb-1.5 text-xs font-semibold text-slate-700">Link elnevezése (opcionális)</label>
                    <input type="text" name="name" id="edit_name"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3.5 py-2.5 outline-none transition" 
                        placeholder="pl. Saját portfólió" />
                </div>

                <div class="mb-4">
                    <label for="edit_original_url" class="block mb-1.5 text-xs font-semibold text-slate-700">Cél URL cím <span class="text-indigo-500">*</span></label>
                    <input type="url" name="original_url" id="edit_original_url" required
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3.5 py-2.5 outline-none transition" 
                        placeholder="https://example.com/..." />
                </div>

                <div class="mb-6">
                    <label for="edit_short_url" class="block mb-1.5 text-xs font-semibold text-slate-700">Rövidített link végződés</label>
                    <div class="flex rounded-xl shadow-sm overflow-hidden">
                        <span class="inline-flex items-center px-3 bg-slate-100 border border-r-0 border-slate-300 text-slate-500 text-xs font-mono select-none">
                            {{ url('/') }}/
                        </span>
                        <input type="text" name="short_url" id="edit_short_url"
                            class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-r-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3 py-2.5 outline-none font-mono" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition cursor-pointer">
                        Mégse
                    </button>
                    <button type="submit" 
                        class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-md shadow-indigo-500/20 transition cursor-pointer">
                        Mentés
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Szkriptek: Másolás, Menü, Modal --}}
    <script>
        function copyToClipboard(text, btnElement) {
            navigator.clipboard.writeText(text).then(() => {
                const originalHtml = btnElement.innerHTML;
                btnElement.innerHTML = `
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                setTimeout(() => {
                    btnElement.innerHTML = originalHtml;
                }, 1500);
            });
        }

        // Három pont menü lenyitása / bezárása
        function toggleRowMenu(id) {
            const menu = document.getElementById(`row-menu-${id}`);
            const isHidden = menu.classList.contains('hidden');
            
            // Más nyitott menük bezárása
            document.querySelectorAll('[id^="row-menu-"]').forEach(el => el.classList.add('hidden'));

            if (isHidden) {
                menu.classList.remove('hidden');
            }
        }

        // Kívülre kattintás bezárja a sor menüjét
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="action-dropdown-"]')) {
                document.querySelectorAll('[id^="row-menu-"]').forEach(el => el.classList.add('hidden'));
            }
        });

        // Szerkesztés Modal megnyitása adatokkal feltöltve
        function openEditModal(id, name, originalUrl, shortUrl) {
            document.querySelectorAll('[id^="row-menu-"]').forEach(el => el.classList.add('hidden'));
            
            document.getElementById('editLinkForm').action = `{{ url('/links') }}/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_original_url').value = originalUrl;
            document.getElementById('edit_short_url').value = shortUrl;
            
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

</x-layout>
