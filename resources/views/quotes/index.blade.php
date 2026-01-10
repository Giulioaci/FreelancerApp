<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            📄 Lista Preventivi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow border border-gray-200 p-8 transition">

                {{-- Titolo + pulsante --}}
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-600 font-medium">
                        Gestisci i tuoi preventivi
                    </p>

                    <a href="{{ route('quotes.create') }}"
                       class="inline-block px-4 py-2 bg-white border-2 border-gray-500
                              text-gray-800 text-sm font-medium rounded-md shadow-sm
                              hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out">
                        ➕ Nuovo Preventivo
                    </a>
                </div>

                {{-- Tabella preventivi --}}
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm text-gray-700">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-3 py-2 text-left">Numero</th>
                                <th class="border px-3 py-2 text-left">Cliente</th>
                                <th class="border px-3 py-2 text-left">Data Emissione</th>
                                <th class="border px-3 py-2 text-left">Data Scadenza</th>
                                <th class="border px-3 py-2 text-left">Totale</th>
                                <th class="border px-3 py-2 text-left">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quotes as $quote)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-3 py-2">{{ $quote->numero }}</td>
                                    <td class="border px-3 py-2">{{ $quote->client->name ?? '-' }}</td>
                                    <td class="border px-3 py-2">{{ $quote->data_emissione->format('d/m/Y') }}</td>
                                    <td class="border px-3 py-2">{{ $quote->data_scadenza->format('d/m/Y') }}</td>
                                    <td class="border px-3 py-2">{{ number_format($quote->totale, 2, ',', '.') }} €</td>
                                    <td class="border px-3 py-2 flex gap-2">

                                        {{-- Modifica --}}
                                        <a href="{{ route('quotes.edit', $quote->id) }}"
                                           class="text-yellow-600 hover:text-yellow-700">
                                            ✏️
                                        </a>

                                        {{-- Elimina --}}
                                        <form action="{{ route('quotes.destroy', $quote->id) }}" method="POST"
                                              onsubmit="return confirm('Sei sicuro di voler eliminare questo preventivo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-yellow-600 hover:text-yellow-700">
                                                🗑️
                                            </button>
                                        </form>

                                        {{-- Genera PDF --}}
                                        <a href="{{ route('quotes.downloadPdf', $quote->id) }}" target="_blank"
                                           class="text-yellow-600 hover:text-yellow-700">
                                            📄 PDF
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-3 py-2 text-center text-gray-500">
                                        Nessun preventivo trovato
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>








