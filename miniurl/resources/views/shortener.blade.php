<x-layout>

    <x-slot:heading>
        Shortener Page
    </x-slot:heading>

    <form action="/shortenUrl" method="POST" class="max-w-sm mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        @csrf <div class="mb-5">
            <label for="url" class="block mb-2 text-sm font-medium text-gray-900">Original URL</label>
            <input type="url" name="url" id="url" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="https://example-link/..." required />
        </div>

        <div class="mb-5">
            <label for="custom_url" class="block mb-2 text-sm font-medium text-gray-900">Custom Link (Optional)</label>
            <input type="text" name="custom_url" id="custom_url" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="ex. custom-link" />
        </div>

        <button type="submit" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center transition duration-200">
            Shorten!
        </button>
    </form>

    <x-slot:pagetitle>
        Shortener
    </x-slot:pagetitle>

    <x-slot:idezet>
        Minek ide idézet, ha odabasz a kinézet
    </x-slot:idezet>
</x-layout>