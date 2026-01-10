<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl sm:text-2xl text-gray-800 leading-tight">
            👥 Chi Siamo
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">

            {{-- Sezione Mission --}}
            <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg border border-gray-200 p-8 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">La nostra mission</h3>
                <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                    La nostra missione è semplificare la gestione degli appuntamenti e rendere
                    l’esperienza dei nostri clienti più efficiente e piacevole. Crediamo
                    nella trasparenza, nella professionalità e nell’innovazione continua.
                </p>
            </div>
   
            {{-- Sezione Contatti --}}
            <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg border border-gray-200 p-8 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Contattaci</h3>
                <p class="text-gray-700 text-base sm:text-lg mb-2">
                    Email: <a href="mailto:info@tuosito.com" class="text-green-600 hover:underline">giulioacitorio@yahoo.it</a>
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
