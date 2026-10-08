<x-layout>

    <x-slot:heading>
        MiniURL
    </x-slot:heading>

    {{-- Sikeres link generálás kártya --}}
    @if (session('short_url'))
        <div class="max-w-md mx-auto mb-6 bg-white p-6 rounded-xl shadow-sm border border-green-200">
            <div class="flex items-center gap-2 mb-3 text-green-700 font-semibold">
                <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>A rövidített linked elkészült!</span>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Kattints a másoláshoz vagy használd közvetlenül:</label>
                <div class="flex items-center gap-2">
                    <input type="text" id="generatedShortUrl" readonly value="{{ session('short_url') }}"
                        class="bg-gray-50 border border-gray-300 text-blue-600 font-mono font-semibold text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-inner select-all" />
                    
                    <button type="button" onclick="copyShortUrl(this)"
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <span>Másolás</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-3 border-t border-gray-100 text-xs text-gray-500">
                <span class="truncate max-w-[220px]" title="{{ session('original_url') }}">
                    Eredeti: {{ session('original_url') }}
                </span>
                <a href="{{ session('short_url') }}" target="_blank" class="text-blue-600 hover:underline font-medium inline-flex items-center gap-1">
                    Megnyitás
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        </div>
    @endif

    <form action="{{ route('shortenUrl') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        @csrf 
        <div class="mb-5">
            <label for="url" class="block mb-2 text-sm font-medium text-gray-900">Original URL</label>
            <input type="url" name="url" id="url" value="{{ old('url') }}"
                class="bg-gray-50 border @error('url') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="https://example-link/..." required />
            @error('url')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="custom_url" class="block mb-2 text-sm font-medium text-gray-900">Custom Link (Optional)</label>
            <input type="text" name="custom_url" id="custom_url" value="{{ old('custom_url') }}"
                class="bg-gray-50 border @error('custom_url') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="ex. custom-link" />
            @error('custom_url')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center transition duration-200">
            Shorten!
        </button>
    </form>

    <script>
        function copyShortUrl(btn) {
            const input = document.getElementById('generatedShortUrl');
            if (!input) return;

            navigator.clipboard.writeText(input.value).then(() => {
                const originalHtml = btn.innerHTML;
                btn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                btn.classList.add('bg-green-600', 'hover:bg-green-700');
                btn.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Másolva!</span>
                `;
                setTimeout(() => {
                    btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                    btn.classList.add('bg-blue-600', 'hover:bg-blue-700');
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