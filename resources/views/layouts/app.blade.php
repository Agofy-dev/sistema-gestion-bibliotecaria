<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Biblioteca Casa Ramos Sucre') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|playfair-display:600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f7f5f0] text-[#373222]">
        <div class="min-h-screen bg-[#f7f5f0]">
            @include('layouts.navigation')

            <!-- Encabezado de Página (Sepia Cálido) -->
            @if (isset($header))
                <header class="bg-[#f0ebe1] border-b border-[#e2dcce] shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 font-serif text-[#373222]">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Contenido Principal -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>