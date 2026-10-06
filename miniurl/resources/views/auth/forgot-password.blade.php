<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | MiniURL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans relative">

    <div class="absolute top-5 right-5">
        <x-nav-button :href="route('login')">← Back to Login</x-nav-button>
    </div>

    <div class="w-full max-w-sm">
        <form action="{{ route('magic.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
            @csrf 
            <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Reset Password</h1>
            
            <p class="text-sm text-gray-500 mb-5 text-center">
                Enter your email address and we'll send you a magic link to reset your password.
            </p>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none" 
                    placeholder="name@example.com" required />
            </div>

            <button type="submit" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-3 text-center transition duration-200">
                Send Magic Link
            </button>
        </form>
    </div>

</body>
</html>
