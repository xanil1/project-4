<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @auth
                    <div class="flex justify-between">
                        <div>
                            Welkom, {{ Auth::user()->name }}!
                        </div>
                        <div>
                            <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Beheer Gebruikers</a>
                        </div>
                    </div>
                @else
                    <div>
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Inloggen</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>