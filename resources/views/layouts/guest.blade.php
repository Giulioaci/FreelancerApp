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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-200 text-gray-900">
    <div class="min-h-screen flex flex-col justify-center items-center py-6 sm:py-0">


        {{-- Flash Messages --}}
        @if (session('success'))
            <div
                class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm
                       transition duration-300 ease-in-out animate-fade-in max-w-md w-full"
            >
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div
                class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm
                       transition duration-300 ease-in-out animate-fade-in max-w-md w-full"
            >
                {{ session('error') }}
            </div>
        @endif

        {{-- Card principale --}}
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    {{-- Animazione semplice fade-in --}}
    <style>
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-5px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</body>
</html>

