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

    <div class="max-w-5xl mx-auto">
        {{-- Fejléc sáv és Új link gomb --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Mentett linkek</h2>
                <p class="text-sm text-gray-500">Összesen {{ $links->count() }} link található a fiókodban.</p>
            </div>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Új link rövidítése
            </a>
        </div>

        @if ($links->isEmpty())
            {{-- Üres állapot (Empty state) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Még nincsenek mentett linkjeid</h3>
                <p class="text-sm text-gray-500 mb-6">Rövidíts le egy tetszőleges URL-t, és az automatikusan meg fog jelenni ezen a listán!</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    Link készítése most
                </a>
            </div>
        @else
            {{-- Linkek táblázata --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wider text-gray-600">
                                <th class="py-3.5 px-4 sm:px-6">Eredeti URL</th>
                                <th class="py-3.5 px-4 sm:px-6">Rövidített link</th>
                                <th class="py-3.5 px-4 sm:px-6 text-center">Kattintások</th>
                                <th class="py-3.5 px-4 sm:px-6">Létrehozva</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach ($links as $link)
                                <tr class="hover:bg-gray-50/75 transition">
                                    {{-- Eredeti URL --}}
                                    <td class="py-4 px-4 sm:px-6 max-w-xs sm:max-w-sm truncate">
                                        <a href="{{ $link->original_url }}" target="_blank" rel="noopener noreferrer" 
                                           class="text-gray-900 hover:text-blue-600 font-medium truncate block" 
                                           title="{{ $link->original_url }}">
                                            {{ $link->original_url }}
                                        </a>
                                    </td>

                                    {{-- Rövidített URL + Másolás gomb --}}
                                    <td class="py-4 px-4 sm:px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ url('/' . $link->short_url) }}" target="_blank" 
                                               class="font-mono text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                                {{ url('/' . $link->short_url) }}
                                            </a>
                                            <button type="button" 
                                                    onclick="copyToClipboard('{{ url('/' . $link->short_url) }}', this)"
                                                    class="p-1.5 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-md transition" 
                                                    title="Másolás a vágólapra">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>

                                    {{-- Kattintások száma --}}
                                    <td class="py-4 px-4 sm:px-6 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $link->clicks }} megnyitás
                                        </span>
                                    </td>

                                    {{-- Dátum --}}
                                    <td class="py-4 px-4 sm:px-6 text-gray-500 whitespace-nowrap text-xs">
                                        {{ $link->created_at ? $link->created_at->format('Y.m.d H:i') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    {{-- Másolás szkript --}}
    <script>
        function copyToClipboard(text, btnElement) {
            navigator.clipboard.writeText(text).then(() => {
                const originalHtml = btnElement.innerHTML;
                btnElement.innerHTML = `
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                setTimeout(() => {
                    btnElement.innerHTML = originalHtml;
                }, 1500);
            });
        }
    </script>

</x-layout>
