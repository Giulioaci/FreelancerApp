<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ✏️ Modifica Preventivo: {{ $quote->numero }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow border border-gray-200 p-8 transition">

                {{-- Form principale del preventivo --}}
                <form action="{{ route('quotes.update', $quote->id) }}" method="POST" class="space-y-6 mb-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data Emissione</label>
                        <input type="date" name="data_emissione"
                               value="{{ old('data_emissione', $quote->data_emissione->format('Y-m-d')) }}"
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500
                                      @error('data_emissione') border-red-500 @enderror">
                        @error('data_emissione')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data Scadenza</label>
                        <input type="date" name="data_scadenza"
                               value="{{ old('data_scadenza', $quote->data_scadenza->format('Y-m-d')) }}"
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500
                                      @error('data_scadenza') border-red-500 @enderror">
                        @error('data_scadenza')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                        <textarea name="note" rows="4"
                                  class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500
                                         @error('note') border-red-500 @enderror">{{ old('note', $quote->note) }}</textarea>
                        @error('note')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pulsanti Aggiorna / Annulla --}}
                    <div class="flex gap-2 flex-wrap">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md
                                       bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                       hover:bg-gray-100 transition duration-200 ease-in-out">
                            💾 Aggiorna Preventivo
                        </button>

                        <a href="{{ route('quotes.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md
                                  bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                  hover:bg-gray-100 transition duration-200 ease-in-out">
                            ❌ Annulla
                        </a>
                    </div>
                </form>

                <hr class="my-6">

                {{-- Lista righe preventivo --}}
                <h3 class="font-semibold text-lg mb-4">Righe Preventivo</h3>
                <div class="overflow-x-auto mb-6">
                    <table class="w-full border-collapse text-sm text-gray-700">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-3 py-2 text-left">Descrizione</th>
                                <th class="border px-3 py-2 text-left">Quantità</th>
                                <th class="border px-3 py-2 text-left">Prezzo Unitario</th>
                                <th class="border px-3 py-2 text-left">Totale</th>
                                <th class="border px-3 py-2 text-left">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quote->items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-3 py-2">{{ $item->descrizione }}</td>
                                    <td class="border px-3 py-2">{{ $item->quantita }}</td>
                                    <td class="border px-3 py-2">{{ number_format($item->prezzo_unitario,2,',','.') }} €</td>
                                    <td class="border px-3 py-2">{{ number_format($item->totale,2,',','.') }} €</td>
                                    <td class="border px-3 py-2 flex flex-wrap gap-2">
                                        <form action="{{ route('quotes.items.remove', [$quote->id, $item->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa riga?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-md
                                                           bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                                           hover:bg-gray-100 transition duration-200 ease-in-out">
                                                🗑️ Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="my-6">

                {{-- Aggiungi nuova riga --}}
                <h3 class="font-semibold text-lg mb-4">Aggiungi Riga</h3>
                <form action="{{ route('quotes.items.add', $quote->id) }}" method="POST" class="space-y-4 mb-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrizione</label>
                        <input type="text" name="descrizione" required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantità</label>
                        <input type="number" step="0.01" name="quantita" required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prezzo Unitario</label>
                        <input type="number" step="0.01" name="prezzo_unitario" required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md
                                   bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                   hover:bg-gray-100 transition duration-200 ease-in-out">
                        ➕ Aggiungi Riga
                    </button>
                </form>

                <hr class="my-6">

                {{-- Totali --}}
                <div class="space-y-1">
                    <h4 class="font-semibold">Subtotale: {{ number_format($quote->subtotale,2,',','.') }} €</h4>
                    <h4 class="font-semibold">Sconto: {{ number_format($quote->sconto,2,',','.') }} €</h4>
                    <h4 class="font-semibold">Totale: {{ number_format($quote->totale,2,',','.') }} €</h4>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>




