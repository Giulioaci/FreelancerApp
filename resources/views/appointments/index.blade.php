<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full font-semibold text-2xl text-gray-800 leading-tight">
            📅 Appuntamenti
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <p class="text-gray-600">
                    Gestisci i tuoi appuntamenti
                </p>

                <a
                    href="{{ route('appointments.create') }}"
                    class="inline-block mt-3 px-4 py-2 rounded-md
                    bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                    hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                    ➕ Nuovo Appuntamento
                </a>
            </div>

            @if($appointments->isEmpty())
                <div class="bg-white rounded-2xl shadow p-8 text-center text-gray-500 border border-gray-200">
                    <p class="text-lg mb-2">😕 Nessun appuntamento trovato</p>
                    <p class="text-sm">Crea il tuo primo appuntamento</p>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left">Titolo</th>
                                    <th class="px-4 py-3 text-left">Cliente</th>
                                    <th class="px-4 py-3 text-left">Luogo</th>
                                    <th class="px-4 py-3 text-left">Descrizione</th>
                                    <th class="px-4 py-3 text-left">Inizio</th>
                                    <th class="px-4 py-3 text-left">Fine</th>
                                    <th class="px-4 py-3 text-right">Azioni</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach($appointments as $appointment)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-medium text-gray-800">
                                            {{ $appointment->title }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $appointment->client->name ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $appointment->location ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $appointment->description ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ \Carbon\Carbon::parse($appointment->start_datetime)->format('d/m/Y H:i') }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ \Carbon\Carbon::parse($appointment->end_datetime)->format('d/m/Y H:i') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex justify-end items-center gap-4">
                                                <a
                                                    href="{{ route('appointments.edit', $appointment) }}"
                                                    class="text-yellow-600 hover:text-yellow-700"
                                                    title="Modifica"
                                                >
                                                    ✏️
                                                </a>

                                                <form
                                                    action="{{ route('appointments.destroy', $appointment) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Sei sicuro di voler eliminare questo appuntamento?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="text-red-600 hover:text-red-700"
                                                        title="Elimina"
                                                    >
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>









