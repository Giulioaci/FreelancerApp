<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-200">
    <div class="min-h-screen flex flex-col">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white/90 backdrop-blur shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="flex-grow w-full px-6 sm:px-10 lg:px-16 py-8">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm animate-fade-in">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-gray-200">
            <div class="flex flex-col md:flex-row items-center md:items-start md:justify-between gap-4 md:gap-0 px-6 sm:px-10 lg:px-16 py-8">

                {{-- Left --}}
                <div class="text-sm text-gray-500 text-center md:text-left w-full md:w-auto">
                    © Freelance. Tutti i diritti riservati.
                </div>

                {{-- Center (Icona agendina) --}}
                <div class="flex justify-center w-full md:w-auto my-2 md:my-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-10 4h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                {{-- Right (Links) --}}
                <div class="flex gap-8 text-sm text-gray-600 flex-wrap justify-center md:justify-end w-full md:w-auto">
                    <a href="{{ route('chi-siamo') }}" class="hover:text-gray-900 transition">Chi siamo</a>
                    <a href="{{ route('privacy') }}" class="hover:text-gray-900 transition">Privacy e Termini</a>
                </div>

            </div>
        </footer>

    </div>
</body>
</html>






