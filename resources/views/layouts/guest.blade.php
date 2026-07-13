<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Archivo Ramos Sucre') }}</title>

        <!-- Fuentes -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts y Estilos (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#2c2825] bg-[#c3b8a4]">
        <!-- Fondo con la Fachada de la Casa Ramos Sucre -->
        <div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center bg-no-repeat p-4"
            style="background-image: url('{{ asset('images/layout-sin-marca-de-agua.png') }}');">

            <!-- Tarjeta Principal (Fondo #f3edd9 uniforme con el logo) -->
            <div class="w-full max-w-[420px] bg-[#f3edd9] rounded-2xl shadow-2xl p-6 sm:p-7 border border-[#e2d6be]">
                
                <!-- ENCABEZADO INSTITUCIONAL -->
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-[#e2d6be]">
                    <!-- Escudo UDO -->
                    <img src="{{ asset('images/Escudo-UDO.png') }}" 
                        alt="Escudo UDO" 
                        class="h-12 w-auto object-contain mix-blend-multiply">

                    <!-- Logo Casa Ramos Sucre (Fusionado perfectamente con el fondo) -->
                    <div class="flex justify-center items-center px-1 flex-1">
                        <img src="{{ asset('images/LOGO-CASA-RAMOS-SUCRE.png') }}" 
                            alt="Casa Ramos Sucre" 
                            class="h-16 sm:h-20 w-auto object-contain mix-blend-multiply">
                    </div>

                    <!-- Retrato Ramos Sucre -->
                    <img src="{{ asset('images/Fotografia-Ramos-Sucre.jpg') }}" 
                        alt="José Antonio Ramos Sucre" 
                        class="h-12 w-10 object-cover rounded border border-[#c8bead] shadow-xs">
                </div>

                <!-- TEXTO DE BIENVENIDA -->
                <div class="text-center mb-4 mt-1">
                    <h2 class="font-serif font-bold text-xs sm:text-sm uppercase tracking-widest text-[#4a4237]">
                        Biblioteca Literaria Casa Ramos Sucre
                    </h2>
                </div>

                <!-- CONTENIDO DINÁMICO (LOGIN / REGISTRO) -->
                <div>
                    {{ $slot }}
                </div>

                <!-- DIRECCIÓN PIE DE PÁGINA -->
                <div class="mt-6 pt-3 border-t border-[#e2d6be] text-center">
                    <p class="text-[10px] text-[#70685c] leading-tight font-serif">
                        Casa Ramos Sucre, Calle Sucre, Nº 29. Frente a la Iglesia Santa Inés.
                    </p>
                </div>

            </div>
        </div>
    </body>
</html>