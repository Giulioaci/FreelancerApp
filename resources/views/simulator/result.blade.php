<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Risultato Simulazione
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow border border-gray-200 p-8 transition">
                <div class="space-y-6">
                    <!-- Risultato Mensile -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Guadagno mensile stimato
                        </label>
                        <p class="text-xl font-semibold text-gray-900">€ {{ $monthly }}</p>
                    </div>

                    <!-- Risultato Annuale -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Guadagno annuale stimato
                        </label>
                        <p class="text-xl font-semibold text-gray-900">€ {{ $annual }}</p>
                    </div>

                    <!-- Torna indietro -->
                    <div class="flex justify-start pt-4 w-full">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-white
                                  border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                  hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                            ❌ Torna indietro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



