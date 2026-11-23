<x-layout>
    <x-slot:heading>
        Shorten Your Links
    </x-slot:heading>

    <x-slot:subtitle>
        Turn messy URLs into clean, trackable short links in one click.
    </x-slot:subtitle>

    <div class="max-w-lg mx-auto mt-4">
        <form action="/shortenUrl" method="POST"
            class="bg-slate-900/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl shadow-black/40 border border-slate-800 space-y-6">
            @csrf

            <div>
                <label for="url" class="block mb-2 text-sm font-medium text-slate-200">
                    Original URL
                </label>
                <input type="url" name="url" id="url" value="{{ old('url') }}"
                    class="w-full rounded-xl bg-slate-950/90 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-4 py-3 outline-none transition"
                    placeholder="https://example.com/very/long/url..." required />
                @error('url')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="custom_url" class="block mb-2 text-sm font-medium text-slate-200">
                    Custom Alias <span class="text-slate-500 font-normal">(Optional)</span>
                </label>
                <div class="flex rounded-xl overflow-hidden border border-slate-700 focus-within:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-500/30 bg-slate-950/90 transition">
                    <span class="inline-flex items-center px-3.5 text-xs sm:text-sm text-slate-400 bg-slate-900 border-r border-slate-800 select-none">
                        {{ url('/') }}/
                    </span>
                    <input type="text" name="custom_url" id="custom_url" value="{{ old('custom_url') }}"
                        class="flex-1 bg-transparent text-slate-100 placeholder-slate-500 text-sm px-3.5 py-3 outline-none"
                        placeholder="my-cool-link" />
                </div>
                @error('custom_url')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm py-3.5 px-5 shadow-lg shadow-indigo-600/25 hover:shadow-indigo-500/40 transition cursor-pointer">
                Shorten URL &rarr;
            </button>

            @guest
                <p class="text-center text-xs text-slate-400 pt-1">
                    Want to manage, edit &amp; track your links?
                    <a href="/register" class="text-indigo-400 hover:text-indigo-300 font-medium underline underline-offset-4">Create a free account</a>
                </p>
            @endguest
        </form>
    </div>

    <x-slot:pagetitle>
        Shortener
    </x-slot:pagetitle>

    <x-slot:idezet>
        Minek ide idézet, ha odabasz a kinézet
    </x-slot:idezet>
</x-layout>
