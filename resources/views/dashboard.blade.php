<x-app-layout>
    <x-slot name="header">
        <h1 class="w-full font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Ciao, :name!   Benvenuto nella tua dashboard freelancer.', ['name' => Auth::user()->name]) }}

        </h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Link gestione clienti -->
            <div class="bg-white/90 backdrop-blur shadow-sm sm:rounded-lg p-6 
                        transition duration-300 hover:shadow-md text-center">
                <h4 class="text-md font-semibold text-gray-800">
                    Gestione Clienti
                </h4>
                <p class="text-gray-600 mt-1">
                    Visualizza, aggiungi e modifica i tuoi clienti.
                </p>
                <a href="{{ route('clients.index') }}"
                   class="inline-block mt-3 px-4 py-2 bg-white border-2 border-gray-500
                          text-gray-800 text-sm font-medium rounded-md shadow-sm
                          hover:bg-gray-100 hover:shadow-md
                          transition duration-200 ease-in-out">
                    Vai ai Clienti
                </a>
            </div>

            <!-- Gestione appuntamenti -->
            <div class="bg-white/90 backdrop-blur shadow-sm sm:rounded-lg p-6 
                        transition duration-300 hover:shadow-md text-center">
                <h4 class="text-md font-semibold text-gray-800">
                    Gestione Appuntamenti
                </h4>
                <p class="text-gray-600 mt-1">
                    Visualizza e pianifica i tuoi appuntamenti con i clienti.
                </p>
                <a href="{{ route('appointments.index') }}"
                   class="inline-block mt-3 px-4 py-2 bg-white border-2 border-gray-500
                          text-gray-800 text-sm font-medium rounded-md shadow-sm
                          hover:bg-gray-100 hover:shadow-md
                          transition duration-200 ease-in-out">
                    Vai agli Appuntamenti
                </a>
            </div>

            <!-- Simulatore di reddito -->
            <div class="bg-white/90 backdrop-blur shadow-sm sm:rounded-lg p-6 
                        transition duration-300 hover:shadow-md text-center">
                <h4 class="text-md font-semibold text-gray-800">
                    Simulatore di reddito
                </h4>
                <p class="text-gray-600 mt-1">
                    Calcola rapidamente il tuo guadagno mensile e annuale.
                </p>
                <a href="{{ route('simulator.form') }}"
                   class="inline-block mt-3 px-4 py-2 bg-white border-2 border-gray-500
                          text-gray-800 text-sm font-medium rounded-md shadow-sm
                          hover:bg-gray-100 hover:shadow-md
                          transition duration-200 ease-in-out">
                    Apri Simulatore
                </a>
            </div>

            <!-- Gestione Preventivi -->
            <div class="bg-white/90 backdrop-blur shadow-sm sm:rounded-lg p-6 
                        transition duration-300 hover:shadow-md text-center">
                <h4 class="text-md font-semibold text-gray-800">
                    Gestione Preventivi
                </h4>
                <p class="text-gray-600 mt-1">
                    Visualizza, crea e modifica i tuoi preventivi in modo semplice.
                </p>
                <a href="{{ route('quotes.index') }}"
                   class="inline-block mt-3 px-4 py-2 bg-white border-2 border-gray-500
                          text-gray-800 text-sm font-medium rounded-md shadow-sm
                          hover:bg-gray-100 hover:shadow-md
                          transition duration-200 ease-in-out">
                    Vai ai Preventivi
                </a>
            </div>

        </div>
    </div>
</x-app-layout>









