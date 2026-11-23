<x-layout>
    <x-slot:heading>
        Welcome Back
    </x-slot:heading>

    <x-slot:subtitle>
        Sign in to manage your links and track clicks.
    </x-slot:subtitle>

    <div class="max-w-md mx-auto mt-4">
        <form action="{{ route('login.store') }}" method="POST"
            class="bg-slate-900/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl shadow-black/40 border border-slate-800 space-y-5">
            @csrf

            @error('credentials')
                <div class="rounded-xl bg-rose-500/10 border border-rose-500/30 px-4 py-3 text-sm text-rose-300">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-slate-200">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-xl bg-slate-950/90 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-4 py-3 outline-none transition"
                    placeholder="you@example.com" />
                @error('email')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-slate-200">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-xl bg-slate-950/90 border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-slate-100 placeholder-slate-500 text-sm px-4 py-3 outline-none transition"
                    placeholder="••••••••" />
                @error('password')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm py-3.5 px-5 shadow-lg shadow-indigo-600/25 transition cursor-pointer">
                Sign In
            </button>

            <p class="text-center text-xs text-slate-400 pt-1">
                Don't have an account yet?
                <a href="/register" class="text-indigo-400 hover:text-indigo-300 font-medium underline underline-offset-4">Register</a>
            </p>
        </form>
    </div>

    <x-slot:pagetitle>
        Login
    </x-slot:pagetitle>
</x-layout>
