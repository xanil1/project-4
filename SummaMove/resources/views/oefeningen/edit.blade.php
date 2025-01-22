<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oefening Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('oefeningen.update', $oefening->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Naam -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Naam:</label>
                            <input type="text" id="name" name="name" value="{{ $oefening->name }}"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Beschrijving -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Beschrijving:</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                required>{{ $oefening->description }}</textarea>
                        </div>

                        <!-- Nieuwe Afbeelding -->
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 font-bold mb-2">Nieuwe Afbeelding (optioneel):</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500">
                        </div>

                        <!-- Huidige Afbeelding -->
                        @if($oefening->image)
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Huidige Afbeelding:</label>
                                <img src="{{ asset($oefening->image) }}" alt="{{ $oefening->name }}" class="h-32 rounded-lg">
                            </div>
                        @endif

                        <!-- Opslaan knop -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
