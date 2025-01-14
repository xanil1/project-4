<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bewerk gebruiker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Naam veld -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Naam
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-input mt-1 block w-full" 
                                value="{{ old('name', $user->name) }}" 
                                required
                            >
                        </div>

                        <!-- E-mail veld -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                E-mail
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-input mt-1 block w-full" 
                                value="{{ old('email', $user->email) }}" 
                                required
                            >
                        </div>

                        <!-- Wachtwoord veld -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Nieuw wachtwoord
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-input mt-1 block w-full"
                            >
                            <p class="text-gray-500 text-sm mt-1">
                                Laat leeg als je het wachtwoord niet wilt wijzigen.
                            </p>
                        </div>

                        <!-- Wachtwoord bevestigen veld -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                                Bevestig wachtwoord
                            </label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="form-input mt-1 block w-full"
                            >
                        </div>

                        <!-- Rol veld -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                                Rol
                            </label>
                            <select name="role_id" id="role" class="form-select mt-1 block w-full">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Opslaan en Terug knoppen -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Opslaan
                            </button>
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Terug
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>