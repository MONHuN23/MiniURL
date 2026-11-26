<x-layout>
    <x-slot:heading>
        Your Profile
    </x-slot:heading>

    <x-slot:subtitle>
        Manage your account details, avatar, and security settings.
    </x-slot:subtitle>

    <div class="max-w-2xl mx-auto space-y-8">
        {{-- Validation Errors Banner --}}
        @if ($errors->any())
            <div class="rounded-2xl bg-rose-500/10 border border-rose-500/30 p-4 text-sm text-rose-300">
                <p class="font-semibold mb-1">Please fix the following:</p>
                <ul class="list-disc list-inside space-y-0.5 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Profile Edit Form --}}
        <div class="rounded-2xl bg-slate-900/80 backdrop-blur-md border border-slate-800 p-6 sm:p-8 shadow-2xl shadow-black/40">
            <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Avatar Preview & Upload --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-5 pb-6 border-b border-slate-800">
                    <div class="shrink-0">
                        @if ($user->avatar)
                            <img id="avatar-preview"
                                src="{{ asset('storage/' . $user->avatar) }}"
                                alt="{{ $user->name }}'s avatar"
                                class="h-20 w-20 rounded-2xl object-cover border-2 border-indigo-500/40 shadow-lg shadow-indigo-500/15" />
                        @else
                            <div id="avatar-fallback"
                                class="h-20 w-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-2xl font-bold border-2 border-indigo-400/30 shadow-lg shadow-indigo-500/20">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <img id="avatar-preview"
                                src=""
                                alt="Avatar preview"
                                class="hidden h-20 w-20 rounded-2xl object-cover border-2 border-indigo-500/40 shadow-lg shadow-indigo-500/15" />
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <label for="avatar" class="block text-sm font-medium text-slate-200 mb-1.5">
                            Profile Photo
                        </label>
                        <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/jpg,image/webp"
                            onchange="previewAvatar(event)"
                            class="block w-full text-xs text-slate-400
                                file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border file:border-slate-700
                                file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200
                                hover:file:bg-slate-700 file:transition file:cursor-pointer cursor-pointer" />
                        <p class="mt-1.5 text-xs text-slate-500">
                            JPEG, PNG, or WEBP. Max 2MB. Leave empty to keep your current photo.
                        </p>
                        @error('avatar')
                            <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-slate-200">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-xl bg-slate-950/90 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-4 py-3 outline-none transition" />
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-slate-200">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-xl bg-slate-950/90 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-4 py-3 outline-none transition" />
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-slate-200">
                        New Password <span class="text-slate-500 font-normal">(Leave blank to keep current password)</span>
                    </label>
                    <input type="password" name="password" id="password" placeholder="••••••••••••"
                        class="w-full rounded-xl bg-slate-950/90 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-4 py-3 outline-none transition" />
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm py-3.5 px-5 shadow-lg shadow-indigo-600/25 hover:shadow-indigo-500/40 transition cursor-pointer">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Danger Zone: Delete Account --}}
        <div class="rounded-2xl bg-rose-950/20 border border-rose-500/30 p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-semibold text-rose-300">Danger Zone</h2>
                    <p class="mt-1 text-xs text-slate-400 max-w-md">
                        Permanently delete your account, avatar, shortened links, and saved passwords. This action cannot be undone.
                    </p>
                </div>

                <form action="/profile" method="POST"
                    onsubmit="return confirm('Are you sure you want to permanently delete your account and all your data? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="shrink-0 rounded-xl bg-rose-500/15 hover:bg-rose-500/25 text-rose-300 border border-rose-500/40 px-4 py-2.5 text-sm font-semibold transition cursor-pointer">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            const preview = document.getElementById('avatar-preview');
            const fallback = document.getElementById('avatar-fallback');

            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            if (fallback) {
                fallback.classList.add('hidden');
            }
        }
    </script>

    <x-slot:pagetitle>
        Profile
    </x-slot:pagetitle>
</x-layout>
