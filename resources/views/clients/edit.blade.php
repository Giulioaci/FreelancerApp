<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">

        <h1 class="text-2xl font-bold mb-6">Modifica Cliente</h1>

        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nome -->
            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                              :value="old('name', $client->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                              :value="old('email', $client->email)" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Telefono -->
            <div>
                <x-input-label for="phone" :value="__('Telefono')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" 
                              :value="old('phone', $client->phone)" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Pulsanti -->
            <div class="flex flex-wrap items-center justify-between pt-4 gap-2">
                <!-- Pulsante Aggiorna -->
                <button type="submit" 
                        class="inline-block px-6 py-2 rounded-md
                               bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                               hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                    🔄 Aggiorna Cliente
                </button>

                <!-- Pulsante Annulla -->
                <a href="{{ route('clients.index') }}"
                   class="inline-block px-6 py-2 rounded-md
                          bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                          hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                   ❌ Annulla
                </a>
            </div>

        </form>
    </div>
</x-app-layout>








