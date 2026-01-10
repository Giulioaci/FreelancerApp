<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full font-semibold text-2xl text-gray-800 leading-tight">
            👤 Clienti
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <p class="text-gray-600">
                    Gestisci i tuoi clienti
                </p>

                <a
                    href="{{ route('clients.create') }}"
                    class="inline-block mt-3 px-4 py-2 rounded-md
                           bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                           hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out"
                >
                    ➕ Nuovo Cliente
                </a>
            </div>

            @if($clients->isEmpty())
                <div class="bg-white rounded-2xl shadow p-8 text-center text-gray-500 border border-gray-200">
                    <p class="text-lg mb-2">😕 Nessun cliente trovato</p>
                    <p class="text-sm">Aggiungi il tuo primo cliente</p>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left">Nome e Cognome</th>
                                    <th class="px-4 py-3 text-left">Email</th>
                                    <th class="px-4 py-3 text-left">Telefono</th>
                                    <th class="px-2 py-2 text-right">Azioni</th> <!-- padding ridotto -->
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach($clients as $client)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-medium text-gray-800">
                                            {{ $client->name }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $client->email }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $client->phone ?? '-' }}
                                        </td>

                                        <td class="px-2 py-2">
                                            <div class="flex justify-end items-center gap-4">
                                                <a
                                                    href="{{ route('clients.edit', $client) }}"
                                                    class="text-yellow-600 hover:text-yellow-700"
                                                    title="Modifica"
                                                >
                                                    ✏️
                                                </a>

                                                <form
                                                    action="{{ route('clients.destroy', $client) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Sei sicuro di voler eliminare questo cliente?')"
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







