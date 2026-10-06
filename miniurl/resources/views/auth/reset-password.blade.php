<x-layout>
    <x-slot:heading>
        Új jelszó megadása
    </x-slot:heading>

    <div class="max-w-md mx-auto mt-10">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Új jelszó megadása</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                
                <!-- A rejtett input tartalmazza a linket, amivel validáljuk a felhasználót -->
                <input type="hidden" name="link" value="{{ $link }}">

                <div class="mb-4">
                    <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">Új jelszó</label>
                    <input type="password" name="new_password" id="new_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-6">
                    <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Új jelszó megerősítése</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Jelszó frissítése
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
