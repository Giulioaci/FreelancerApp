<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🧮 Simulatore di reddito
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow border border-gray-200 p-8 transition">
                <form method="POST" action="/simulator" class="space-y-6">
                    @csrf

                    <!-- Numero clienti -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Numero clienti <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="clients" required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('clients') border-red-500 @enderror">
                        @error('clients')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ore per cliente -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Ore per cliente <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="hours_per_client" required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('hours_per_client') border-red-500 @enderror">
                        @error('hours_per_client')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tariffa oraria -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tariffa oraria (€) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" name="hourly_rate" required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('hourly_rate') border-red-500 @enderror">
                        @error('hourly_rate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Azioni -->
                    <div class="flex justify-between pt-4 w-full">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white
                                       border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                       hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                            💾 Calcola
                        </button>

                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white
                                  border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                  hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                            ❌ Annulla
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>


