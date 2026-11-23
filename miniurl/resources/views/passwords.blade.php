<x-layout>
    <x-slot:heading>
        Password Vault
    </x-slot:heading>

    <x-slot:subtitle>
        Encrypted credentials stored safely in your personal Hub.
    </x-slot:subtitle>

    {{-- Validation Errors Banner --}}
    @if ($errors->any())
        <div class="mb-6 rounded-2xl bg-rose-500/10 border border-rose-500/30 p-4 text-sm text-rose-300">
            <p class="font-semibold mb-1">Please fix the following:</p>
            <ul class="list-disc list-inside space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add New Password Form --}}
    <div class="mb-10 rounded-2xl bg-slate-900/80 backdrop-blur-md border border-slate-800 p-6 shadow-xl shadow-black/30">
        <h2 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-400 text-xs font-bold">+</span>
            Add New Credential
        </h2>

        <form action="/passwords" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            @csrf

            <div class="md:col-span-3">
                <label for="name" class="block text-xs font-medium text-slate-400 mb-1.5">App / Site Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    placeholder="e.g. GitHub"
                    class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-3.5 py-2.5 outline-none transition" />
            </div>

            <div class="md:col-span-3">
                <label for="account_name" class="block text-xs font-medium text-slate-400 mb-1.5">
                    Account / Email <span class="text-slate-500">(Optional)</span>
                </label>
                <input type="text" name="account_name" id="account_name" value="{{ old('account_name') }}"
                    placeholder="e.g. work@email.com"
                    class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-3.5 py-2.5 outline-none transition" />
            </div>

            <div class="md:col-span-4">
                <label for="password" class="block text-xs font-medium text-slate-400 mb-1.5">
                    Password <span class="text-slate-500">(Leave blank to auto-generate)</span>
                </label>
                <input type="password" name="password" id="password"
                    placeholder="••••••••••••"
                    class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-3.5 py-2.5 outline-none transition" />
            </div>

            <div class="md:col-span-2">
                <button type="submit"
                    class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold py-2.5 px-4 shadow-lg shadow-indigo-600/25 transition cursor-pointer">
                    Save
                </button>
            </div>
        </form>
    </div>

    {{-- Saved Passwords List --}}
    @if ($passwords->isEmpty())
        <div class="rounded-2xl bg-slate-900/70 border border-slate-800 border-dashed p-14 text-center">
            <p class="text-lg font-semibold text-slate-200">Your vault is empty</p>
            <p class="mt-1 text-sm text-slate-400">Add your first credential above — leave the password blank to auto-generate a strong 12-character password.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($passwords as $entry)
                <div class="rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-slate-700 p-5 transition">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-base font-semibold text-white">{{ $entry->name }}</span>
                                @if ($entry->account_name)
                                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-300 border border-slate-700">
                                        {{ $entry->account_name }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-2.5 flex items-center gap-2 flex-wrap">
                                <code id="pw-display-{{ $entry->id }}"
                                    data-secret="{{ $entry->password }}"
                                    data-visible="false"
                                    class="text-sm font-mono bg-slate-950 border border-slate-800 text-indigo-300 px-3 py-1 rounded-lg select-all">••••••••••••</code>

                                <button type="button"
                                    onclick="togglePassword(this, {{ $entry->id }})"
                                    class="text-xs px-2.5 py-1 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 transition cursor-pointer">
                                    Show
                                </button>

                                <button type="button"
                                    onclick="copySecret(this, {{ $entry->id }})"
                                    class="text-xs px-2.5 py-1 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 transition cursor-pointer">
                                    Copy
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <button type="button"
                                onclick="document.getElementById('edit-pw-{{ $entry->id }}').classList.toggle('hidden')"
                                class="rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 px-3.5 py-2 text-xs font-semibold transition cursor-pointer">
                                Edit
                            </button>

                            <form action="/passwords/{{ $entry->id }}" method="POST"
                                onsubmit="return confirm('Delete this saved password permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 px-3.5 py-2 text-xs font-semibold transition cursor-pointer">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Inline Edit Form --}}
                    <form id="edit-pw-{{ $entry->id }}" action="/passwords/{{ $entry->id }}" method="POST"
                        class="hidden mt-5 pt-5 border-t border-slate-800 grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                        @csrf
                        @method('PUT')

                        <div class="md:col-span-3">
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">App / Site Name</label>
                            <input type="text" name="name" value="{{ $entry->name }}" required
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 text-slate-100 text-sm px-3.5 py-2.5 outline-none" />
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">Account / Email</label>
                            <input type="text" name="account_name" value="{{ $entry->account_name }}"
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 text-slate-100 text-sm px-3.5 py-2.5 outline-none" />
                        </div>

                        <div class="md:col-span-4">
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">
                                New Password <span class="text-slate-500">(blank = auto-generate)</span>
                            </label>
                            <input type="text" name="password" value="{{ $entry->password }}"
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 focus:border-indigo-500 text-slate-100 text-sm px-3.5 py-2.5 outline-none" />
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold py-2.5 px-4 transition cursor-pointer">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <script>
        function togglePassword(btn, id) {
            const el = document.getElementById('pw-display-' + id);
            const isVisible = el.dataset.visible === 'true';
            if (isVisible) {
                el.textContent = '••••••••••••';
                el.dataset.visible = 'false';
                btn.textContent = 'Show';
            } else {
                el.textContent = el.dataset.secret;
                el.dataset.visible = 'true';
                btn.textContent = 'Hide';
            }
        }

        function copySecret(btn, id) {
            const el = document.getElementById('pw-display-' + id);
            navigator.clipboard.writeText(el.dataset.secret).then(() => {
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
        Password Vault
    </x-slot:pagetitle>
</x-layout>
