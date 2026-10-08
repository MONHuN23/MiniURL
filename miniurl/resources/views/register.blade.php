<!DOCTYPE html>
<html lang="hu" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció | MiniURL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans relative p-4">

    <div class="absolute top-5 right-5">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-sm font-medium text-slate-600 bg-white hover:bg-slate-100 border border-slate-200 shadow-sm transition">
            ← Főoldal
        </a>
    </div>

    <div class="w-full max-w-sm">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-slate-900">
                    Mini<span class="text-indigo-600">URL</span>
                </span>
            </a>
            <h1 class="text-xl font-bold text-slate-800">Fiók létrehozása</h1>
            <p class="text-xs text-slate-500">Mentsd el és kövesd nyomon az összes linkedet.</p>
        </div>

        <form action="{{ route('registerUser') }}" method="POST" class="bg-white p-7 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80">
            @csrf 

            <div class="mb-4">
                <label for="name" class="block mb-1.5 text-xs font-semibold text-slate-700">Felhasználónév</label>
                <input type="text" name="name" id="name" 
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3.5 py-2.5 outline-none transition" 
                    placeholder="Kovács János" required />
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1.5 text-xs font-semibold text-slate-700">Email cím</label>
                <input type="email" name="email" id="email" 
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3.5 py-2.5 outline-none transition" 
                    placeholder="pelda@email.hu" required />
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1.5 text-xs font-semibold text-slate-700">Jelszó</label>
                <input type="password" name="password" id="password" 
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3.5 py-2.5 outline-none transition" 
                    placeholder="••••••••" required />
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block mb-1.5 text-xs font-semibold text-slate-700">Jelszó megerősítése</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 block w-full px-3.5 py-2.5 outline-none transition" 
                    placeholder="••••••••" required />
            </div>

            <div class="mb-5 text-center text-xs text-slate-500">
                Már van fiókod? 
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline">Jelentkezz be</a>
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 text-white font-semibold text-sm rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 focus:ring-4 focus:ring-indigo-100 shadow-md shadow-indigo-500/20 transition duration-150 cursor-pointer">
                Regisztráció
            </button>
        </form>
    </div>

</body>
</html>