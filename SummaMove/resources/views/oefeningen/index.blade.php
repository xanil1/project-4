<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oefeningen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse($oefeningen as $oefening)
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-lg">{{ $oefening->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $oefening->description }}</p>
                                <img src="{{ asset($oefening->image) }}" alt="{{ $oefening->name }}" class="mt-2 h-16">
                            </div>
                            <div class="flex space-x-2 mt-2">
                                <form action="{{ route('oefeningen.edit', $oefening->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wijzigen</button>
                                </form>
                                <form action="{{ route('oefeningen.destroy', $oefening->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Weet je zeker dat je deze oefening wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600">Geen oefeningen gevonden.</p>
                    @endforelse

                    <!-- Centered Button to navigate to create.blade.php -->
                    <div class="mt-8 flex justify-center">
                        <a href="{{ route('oefeningen.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Nieuwe Oefening Aanmaken
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
