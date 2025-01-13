<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach($users as $user)
                        <div class="mb-4 flex items-center justify-between">
                            <div>{{ $user->name }} - {{ $user->email }} - {{ $user->roles->pluck('name')->implode(', ') }}</div>
                            <div class="flex space-x-2 mt-2">
                                <form action="{{ route('users.edit', $user->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wijzigen</button>
                                </form>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <!-- Centered Button to navigate to add.blade.php -->
                    <div class="mt-8 flex justify-center">
                        <a href="{{ route('users.add') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        studenten Beheren
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

