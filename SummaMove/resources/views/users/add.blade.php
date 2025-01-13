<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student naar admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Terug
                        </a>
                    </div>

                    @foreach($users as $user)
                        <div class="mb-4 flex items-center justify-between">
                            <div>{{ $user->name }} - {{ $user->email }} - {{ $user->roles->pluck('name')->implode(', ') }}</div>
                            <div class="mt-2 flex space-x-2">
                                <!-- Admin maken knop -->
                                <form action="{{ route('users.promote', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        admin maken
                                    </button>
                                </form>
                                <!-- Verwijderen knop -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>