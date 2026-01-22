<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full font-semibold text-2xl text-gray-800 leading-tight">
            👤 Clienti
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stato piano utente --}}
            @if($user->plan === 'free')
                <div class="mb-4 p-4 rounded-xl bg-yellow-50 border border-yellow-200 text-yellow-800 flex items-center justify-between">
                    <span>
                        📌 Piano gratuito: {{ $user->clients()->count() }}/5 clienti utilizzati.
                        @if($user->hasReachedClientLimit())
                            <span class="font-semibold">Hai raggiunto il limite di clienti!</span>
                        @endif
                    </span>

                    {{-- Link GET alla pagina upgrade --}}
                    <a href="{{ route('upgrade') }}"
                       class="px-3 py-1 bg-yellow-200 text-yellow-900 rounded hover:bg-yellow-300 transition ml-2">
                        Passa a PRO
                    </a>
                </div>
            @elseif($user->plan === 'pro')
                <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800">
                    ✅ Sei un utente PRO: clienti illimitati!
                </div>
            @endif

            {{-- Header lista clienti --}}
            <div class="flex items-center justify-between mb-6">
                <p class="text-gray-600">Gestisci i tuoi clienti</p>

                <a
                    href="{{ $user->hasReachedClientLimit() ? '#' : route('clients.create') }}"
                    class="inline-block mt-3 px-4 py-2 rounded-md
                           bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                           hover:bg-gray-100 hover:shadow-md transition duration-200 ease-in-out
                           {{ $user->hasReachedClientLimit() ? 'opacity-50 cursor-not-allowed' : '' }}"
                >
                    ➕ Nuovo Cliente
                </a>
            </div>

            {{-- Lista clienti --}}
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
                                    <th class="px-2 py-2 text-right">Azioni</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($clients as $client)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ $client->name }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $client->email }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $client->phone ?? '-' }}</td>
                                        <td class="px-2 py-2">
                                            <div class="flex justify-end items-center gap-4">
                                                <a href="{{ route('clients.edit', $client) }}"
                                                   class="text-yellow-600 hover:text-yellow-700"
                                                   title="Modifica">✏️</a>
                                                <form action="{{ route('clients.destroy', $client) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Sei sicuro di voler eliminare questo cliente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-700"
                                                            title="Elimina">🗑️
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












