<x-layout>
    <x-slot:heading>
        My Links
    </x-slot:heading>

    <x-slot:subtitle>
        Manage, edit, and track performance for all your shortened URLs.
    </x-slot:subtitle>

    {{-- Stats Bar --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="rounded-2xl bg-slate-900/80 border border-slate-800 p-5">
            <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Total Links</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $links->count() }}</p>
        </div>
        <div class="rounded-2xl bg-slate-900/80 border border-slate-800 p-5">
            <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Total Clicks</p>
            <p class="mt-2 text-3xl font-bold text-indigo-400">{{ $links->sum('clicks') }}</p>
        </div>
        <div class="rounded-2xl bg-slate-900/80 border border-slate-800 p-5 flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Quick Action</p>
                <p class="mt-1 text-sm text-slate-300">Need another short link?</p>
            </div>
            <x-nav-button href="/">+ New Link</x-nav-button>
        </div>
    </div>

    {{-- Validation Errors Banner (for Update) --}}
    @if ($errors->any())
        <div class="mb-6 rounded-2xl bg-rose-500/10 border border-rose-500/30 p-4 text-sm text-rose-300">
            <p class="font-semibold mb-1">Couldn't update link:</p>
            <ul class="list-disc list-inside space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Links List --}}
    @if ($links->isEmpty())
        <div class="rounded-2xl bg-slate-900/70 border border-slate-800 border-dashed p-14 text-center">
            <p class="text-lg font-semibold text-slate-200">No links yet</p>
            <p class="mt-1 text-sm text-slate-400">Create your first shortened link and it will appear right here.</p>
            <div class="mt-6">
                <x-nav-button href="/">Shorten a URL &rarr;</x-nav-button>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($links as $link)
                @php $fullShortUrl = url('/' . $link->short_url); @endphp
                <div class="rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-slate-700 p-5 transition">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <a href="{{ $fullShortUrl }}" target="_blank"
                                    class="text-base font-semibold text-indigo-400 hover:text-indigo-300 transition truncate">
                                    {{ $fullShortUrl }}
                                </a>
                                <button type="button"
                                    onclick="copyLink(this, '{{ $fullShortUrl }}')"
                                    class="text-xs px-2.5 py-1 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 transition cursor-pointer">
                                    Copy
                                </button>
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-indigo-500/15 text-indigo-300 border border-indigo-500/25">
                                    {{ $link->clicks }} {{ Str::plural('click', $link->clicks) }}
                                </span>
                            </div>
                            <p class="mt-1.5 text-sm text-slate-400 truncate" title="{{ $link->original_url }}">
                                &rarr; {{ $link->original_url }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <button type="button"
                                onclick="document.getElementById('edit-form-{{ $link->id }}').classList.toggle('hidden')"
                                class="rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 px-3.5 py-2 text-xs font-semibold transition cursor-pointer">
                                Edit
                            </button>

                            <form action="/links/{{ $link->id }}" method="POST"
                                onsubmit="return confirm('Delete this link permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 px-3.5 py-2 text-xs font-semibold transition cursor-pointer">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Inline Edit Form (hidden by default) --}}
                    <form id="edit-form-{{ $link->id }}" action="/links/{{ $link->id }}" method="POST"
                        class="hidden mt-5 pt-5 border-t border-slate-800 grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                        @csrf
                        @method('PUT')

                        <div class="md:col-span-6">
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">Original URL</label>
                            <input type="url" name="original_url" value="{{ $link->original_url }}" required
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 text-slate-100 text-sm px-3.5 py-2.5 outline-none" />
                        </div>

                        <div class="md:col-span-4">
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">
                                Short Alias <span class="text-slate-500">(blank = random)</span>
                            </label>
                            <input type="text" name="short_url" value="{{ $link->short_url }}"
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 text-slate-100 text-sm px-3.5 py-2.5 outline-none" />
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold py-2.5 px-4 transition cursor-pointer">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <script>
        function copyLink(btn, text) {
            navigator.clipboard.writeText(text).then(() => {
                const original = btn.textContent;
                btn.textContent = 'Copied!';
                btn.classList.add('text-emerald-300', 'border-emerald-500/40');
                setTimeout(() => {
                    btn.textContent = original;
                    btn.classList.remove('text-emerald-300', 'border-emerald-500/40');
                }, 1500);
            });
        }
    </script>

    <x-slot:pagetitle>
        My Links
    </x-slot:pagetitle>
</x-layout>
