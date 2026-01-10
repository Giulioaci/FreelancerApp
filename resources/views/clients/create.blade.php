<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ➕ Nuovo Cliente
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white rounded-2xl shadow border border-gray-200
                       p-8 transition"
            >
                <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Nome --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nome e Cognome <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full rounded-xl border-gray-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   @error('name') border-red-500 @enderror"
                        >

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-xl border-gray-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   @error('email') border-red-500 @enderror"
                        >

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Telefono --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Telefono
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-xl border-gray-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   @error('phone') border-red-500 @enderror"
                        >

                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Azioni --}}
                    <div class="flex flex-wrap justify-between pt-4 gap-2 w-full">
                        <!-- Pulsante Salva Cliente -->
                        <button
                            type="submit"
                            class="inline-block px-6 py-2 rounded-md
                                   bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                   hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out"
                        >
                            💾 Salva Cliente
                        </button>

                        <!-- Pulsante Annulla -->
                        <a
                            href="{{ route('clients.index') }}"
                            class="inline-block px-6 py-2 rounded-md
                                   bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                   hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out"
                        >
                            ❌ Annulla
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
``





