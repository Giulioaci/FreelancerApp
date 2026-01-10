<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ➕ Nuovo Preventivo
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow border border-gray-200 p-8 transition">

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('quotes.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Cliente --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Cliente <span class="text-red-500">*</span>
                        </label>
                        <select name="client_id" required
                                class="w-full rounded-xl border-gray-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       @error('client_id') border-red-500 @enderror">
                            <option value="">Seleziona Cliente</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Data Emissione --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Data Emissione <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="data_emissione" value="{{ old('data_emissione', date('Y-m-d')) }}" required
                               class="w-full rounded-xl border-gray-300
                                      focus:border-blue-500 focus:ring-blue-500
                                      @error('data_emissione') border-red-500 @enderror">
                        @error('data_emissione')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Data Scadenza --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Data Scadenza <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="data_scadenza" value="{{ old('data_scadenza', date('Y-m-d', strtotime('+30 days'))) }}" required
                               class="w-full rounded-xl border-gray-300
                                      focus:border-blue-500 focus:ring-blue-500
                                      @error('data_scadenza') border-red-500 @enderror">
                        @error('data_scadenza')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Note --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Note
                        </label>
                        <textarea name="note" rows="4"
                                  class="w-full rounded-xl border-gray-300
                                         focus:border-blue-500 focus:ring-blue-500
                                         @error('note') border-red-500 @enderror">{{ old('note') }}</textarea>
                        @error('note')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Azioni --}}
                    <div class="flex flex-wrap justify-between pt-4 gap-2 w-full">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md
                                       bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                       hover:bg-gray-100 transition duration-200 ease-in-out">
                            💾 Crea Preventivo
                        </button>

                        <a href="{{ route('quotes.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-md
                                  bg-white border-2 border-gray-500 text-gray-800 font-medium shadow-sm
                                  hover:bg-gray-100 transition duration-200 ease-in-out">
                            ❌ Annulla
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>


