<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ✏️ Modifica Appuntamento
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Errori --}}
            @if ($errors->any())
                <div
                    class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700
                           animate-fade-in"
                >
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card --}}
            <div
                class="bg-white/90 backdrop-blur rounded-2xl shadow-lg border border-gray-200
                       p-6 transition duration-300 hover:shadow-xl"
            >
                <form
                    action="{{ route('appointments.update', $appointment) }}"
                    method="POST"
                    class="space-y-5"
                >
                    @csrf
                    @method('PUT')

                    {{-- Titolo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Titolo
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $appointment->title) }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 transition"
                        >
                    </div>

                    {{-- Cliente --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Cliente
                        </label>
                        <select
                            name="client_id"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 transition"
                        >
                            <option value="">Seleziona un cliente</option>
                            @foreach($clients as $client)
                                <option
                                    value="{{ $client->id }}"
                                    @selected(old('client_id', $appointment->client_id) == $client->id)
                                >
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Descrizione --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Descrizione
                        </label>
                        <textarea
                            name="description"
                            rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 transition"
                        >{{ old('description', $appointment->description) }}</textarea>
                    </div>

                    {{-- Date --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Inizio
                            </label>
                            <input
                                type="datetime-local"
                                name="start_datetime"
                                value="{{ old('start_datetime', \Carbon\Carbon::parse($appointment->start_datetime)->format('Y-m-d\TH:i')) }}"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 transition"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fine
                            </label>
                            <input
                                type="datetime-local"
                                name="end_datetime"
                                value="{{ old('end_datetime', \Carbon\Carbon::parse($appointment->end_datetime)->format('Y-m-d\TH:i')) }}"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 transition"
                            >
                        </div>
                    </div>

                    {{-- Location --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Location
                        </label>
                        <input
                            type="text"
                            name="location"
                            value="{{ old('location', $appointment->location) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 transition"
                        >
                    </div>

                    {{-- Azioni --}}
                    <div class="flex flex-wrap items-center justify-between pt-4 gap-2">
                        <!-- Pulsante Aggiorna -->
                        <button
                            type="submit"
                            class="inline-block px-6 py-2 rounded-md
                                   bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                   hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out w-full md:w-auto text-center"
                        >
                            🔄 Aggiorna
                        </button>

                        <!-- Pulsante Annulla -->
                        <a
                            href="{{ route('appointments.index') }}"
                            class="inline-block px-6 py-2 rounded-md
                                   bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                   hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out w-full md:w-auto text-center"
                        >
                            ❌ Annulla
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>












