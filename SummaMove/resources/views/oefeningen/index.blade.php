<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oefeningen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Knop om een nieuwe oefening aan te maken -->
            <div class="mb-4 flex justify-end">
                <a href="{{ route('oefeningen.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Nieuwe oefening
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Oefeningen Lijst -->
                    @forelse($oefeningen as $oefening)
                        <div class="mb-6 p-4 border-b border-gray-300 flex items-center justify-between">
                            <div class="flex flex-col w-3/4">
                                <h3 class="font-bold text-xl">{{ $oefening->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $oefening->description }}</p>
                                <p class="text-sm text-gray-500 italic mt-1">English: {{ $oefening->description_en }}</p>
                            </div>
                            <div class="flex flex-col items-center justify-between w-1/4">
                                <img src="{{ asset($oefening->image) }}" alt="{{ $oefening->name }}" class="mt-4 h-24 w-auto rounded-lg">
                                <div class="flex space-x-2 mt-4">
                                    <form action="{{ route('oefeningen.edit', $oefening->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wijzigen</button>
                                    </form>

                                    <!-- Verwijderknop met modaal -->
                                    <button
                                        onclick="openModal('{{ $oefening->id }}')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Verwijderen
                                    </button>
                                </div>
                            </div>

                            <!-- Modaal -->
                            <div id="modal-{{ $oefening->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                                    <h2 class="text-lg font-bold mb-4">Weet je zeker dat je deze oefening wilt verwijderen?</h2>
                                    <p class="text-gray-600 mb-6">Naam: {{ $oefening->name }}</p>
                                    <div class="flex justify-end space-x-4">
                                        <button
                                            onclick="closeModal('{{ $oefening->id }}')"
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            Annuleren
                                        </button>
                                        <form action="{{ route('oefeningen.destroy', $oefening->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                Verwijderen
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600">Geen oefeningen gevonden.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }
    </script>
</x-app-layout>
