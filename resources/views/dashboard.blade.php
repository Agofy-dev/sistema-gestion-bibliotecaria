<x-app-layout>
    <div class="py-10 bg-[#f7f5f0] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @php
                $user = Auth::user();
                $isLector = $user->hasRole('lector');
            @endphp

            <!-- Alerta de Acceso Denegado / Error de Sesión -->
            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-700 p-4 rounded-r-lg shadow-sm border border-red-200/60 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-red-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-red-900 font-sans">
                            {{ session('error') }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Alerta de Éxito / Estado de Sesión -->
            @if (session('status') || session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-700 p-4 rounded-r-lg shadow-sm border border-emerald-200/60 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-sm font-semibold text-emerald-900 font-sans">
                            {{ session('status') ?? session('success') }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Banner de Bienvenida -->
            <div class="bg-[#faf6ee] p-8 rounded-lg shadow-sm border border-[#e2dcce]">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#7c735a]">
                            Biblioteca José Antonio Ramos Sucre
                        </span>
                        <h2 class="text-2xl font-bold text-[#373222] mt-1 font-serif">
                            ¡Bienvenido al sistema, {{ $user->name }}!
                        </h2>
                        <p class="text-sm text-[#6b634b] mt-2 max-w-2xl">
                            @if(!$isLector)
                                Ha iniciado sesión correctamente. Desde este panel principal puede administrar el catálogo de libros, gestionar solicitudes y administrar los usuarios del sistema.
                            @else
                                Ha iniciado sesión correctamente. Desde este panel puede explorar el catálogo de libros, realizar solicitudes de préstamos y consultar su perfil personal.
                            @endif
                        </p>
                    </div>

                    <!-- Botón "Gestionar Usuarios" visible para roles administrativos -->
                    @if(!$isLector)
                        <div class="shrink-0">
                            <a href="{{ route('users.index') }}" 
                               class="inline-flex items-center px-5 py-2.5 bg-[#4a432e] hover:bg-[#373222] text-white font-semibold text-xs uppercase tracking-widest rounded-md shadow transition ease-in-out duration-150">
                                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Gestionar Usuarios
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Accesos Rápidos -->
            <div class="grid grid-cols-1 {{ !$isLector ? 'md:grid-cols-3' : 'md:grid-cols-2' }} gap-6">
                
                <!-- Tarjeta Módulo de Usuarios (Oculta únicamente para Lectores) -->
                @if(!$isLector)
                    <div class="bg-[#faf6ee] p-6 rounded-lg shadow-sm border border-[#e2dcce] flex flex-col justify-between">
                        <div>
                            <div class="text-[#5c3e21] font-bold text-base mb-1 font-serif">Módulo de Usuarios</div>
                            <p class="text-xs text-[#7c735a]">
                                @if($user->hasRole('super_admin'))
                                    Administre lectores, bibliotecarios, datos de contacto y asignación de permisos.
                                @else
                                    Administre lectores y sus datos de contacto en el sistema.
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('users.index') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-[#5c3e21] hover:text-[#373222] underline">
                            Ir a Gestión de Usuarios &rarr;
                        </a>
                    </div>
                @endif

                <!-- Tarjeta Mi Cuenta -->
                <div class="bg-[#faf6ee] p-6 rounded-lg shadow-sm border border-[#e2dcce] flex flex-col justify-between">
                    <div>
                        <div class="text-[#5c3e21] font-bold text-base mb-1 font-serif">Mi Cuenta</div>
                        <p class="text-xs text-[#7c735a]">Actualice sus nombres, contraseña y preferences personales.</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-[#5c3e21] hover:text-[#373222] underline">
                        Editar mi Perfil &rarr;
                    </a>
                </div>

                <!-- Tarjeta Estado de Conexión -->
                <div class="bg-[#faf6ee] p-6 rounded-lg shadow-sm border border-[#e2dcce] flex flex-col justify-between">
                    <div>
                        <div class="text-[#5c3e21] font-bold text-base mb-1 font-serif">Estado de Conexión</div>
                        <p class="text-xs text-[#7c735a]">Base de datos PostgreSQL sincronizada y activa.</p>
                    </div>
                    <div class="mt-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#e7f0e3] text-[#2d5227] border border-[#b8d8b0]">
                            ● Sistema Operativo
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>