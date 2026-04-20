<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MiniURL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans relative">

    <div class="absolute top-5 right-5">
        <x-nav-button href="/">← Home</x-nav-button>
    </div>

    <div class="w-full max-w-sm">
        <form action="/loginUser" method="POST" class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
            @csrf 
            <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Sign In</h1>

            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none" 
                    placeholder="name@example.com" required />
            </div>

            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none" 
                    placeholder="Password" required />
            </div>

            <div class="mb-6">
                <a href="#" class="text-xs font-medium text-blue-600 hover:underline block mb-1">Forgot your password?</a>
                <p class="text-xs font-medium text-gray-500">
                    Don't have an account? 
                    <a href="/register" class="text-blue-600 font-bold hover:underline">Sign up</a>
                </p>
            </div>

            <button type="submit" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-3 text-center transition duration-200">
                Sign In
            </button>
        </form>
    </div>

</body>
</html>