<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>

    <body>
        <x-guest-layout>

            {{-- 🔔 Messaggi di stato --}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                <x-alert />
            </div>

            <!-- Immagine centrale -->
            <div class="flex justify-center mt-8">
                <img
                    src="{{ asset('storage/images/images.png') }}"
                    alt="Immagine centrale"
                    class="max-w-xs md:max-w-xl lg:max-w-2xl h-auto"
                >
            </div>

            <!-- Titolo sotto l'immagine -->
            <div class="text-center mt-6">
                <h1 class="text-2xl font-semibold text-gray-900">
                    Benvenuto
                </h1>
                <p class="text-gray-600 mt-2">
                    Accedi o registrati per continuare
                </p>
            </div>

            <!-- Bottoni Login/Register -->
            <div class="flex justify-center gap-4 mt-6">
                @if (Route::has('login'))
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-6 py-2 bg-white text-blue-900 border border-blue-900 rounded-md text-sm font-medium hover:bg-blue-50"
                    >
                        Accedi
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-6 py-2 bg-white text-blue-900 border border-blue-900 rounded-md text-sm font-medium hover:bg-blue-50"
                        >
                            Registrati
                        </a>
                    @endif
                @endif
            </div>

        </x-guest-layout>
    </body>
</html>


