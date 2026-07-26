<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca Casa Ramos Sucre</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-serif antialiased bg-cover bg-center bg-no-repeat min-h-screen flex flex-col justify-between relative" 
    style="background-image: url('{{ asset('images/layout-sin-marca-de-agua.png') }}');">

    <!-- Barra Superior / Menú de Navegación -->
    <header class="w-full p-6 flex justify-between items-center z-10">
        <div class="flex items-center space-x-3 bg-[#f8f5ee]/90 px-4 py-2 rounded-lg border border-[#d6cbb5] shadow-md">
            <span class="font-bold text-[#2c2416] tracking-wide text-sm uppercase">Casa Ramos Sucre</span>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-[#4a422d] text-[#f8f5ee] rounded-lg text-xs font-bold uppercase tracking-wider shadow hover:bg-[#383222] transition">
                        Panel
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#f8f5ee]/90 border border-[#d6cbb5] text-[#2c2416] rounded-lg text-xs font-bold uppercase tracking-wider shadow hover:bg-white transition">
                        Iniciar sesión
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#4a422d] text-[#f8f5ee] rounded-lg text-xs font-bold uppercase tracking-wider shadow hover:bg-[#383222] transition">
                            Regístrate
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Tarjeta Central de Bienvenida -->
    <main class="flex-grow flex items-center justify-center p-4 z-10">
        <div class="bg-[#f8f5ee]/95 backdrop-blur-md max-w-lg w-full rounded-2xl shadow-2xl border border-[#d6cbb5] p-8 text-center text-[#2c2416]">
            <h1 class="text-2xl font-bold uppercase tracking-wide mb-2">
                Biblioteca Literaria 
            </h1>
            <p class="text-xs uppercase tracking-widest text-[#4a422d] font-semibold mb-6">
                Casa Ramos Sucre, Calle Sucre, Nº 29. Frente a la Iglesia Santa Inés.
            </p>
            <p class="text-sm leading-relaxed text-[#3b3226] mb-8 font-sans">
                Bienvenido a la biblioteca digital de la Casa Ramos Sucre. Acceda al acervo documental e histórico a través de nuestra plataforma. Explore, descubra y disfrute de la riqueza literaria que ofrecemos.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-[#4a422d] text-[#f8f5ee] text-xs font-bold uppercase tracking-widest rounded-lg shadow hover:bg-[#383222] transition">
                    Ir a la Biblioteca
                </a>
            </div>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="w-full text-center py-4 z-10 text-xs text-[#f8f5ee] drop-shadow-md">
        Casa Ramos Sucre, Calle Sucre, Nº 29. Frente a la Iglesia Santa Inés.
    </footer>

</body>
</html>