<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alerta de Error (Acceso Denegado) --}}
            @if (session('error'))
                <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Alerta de Éxito --}}
            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 mb-4">
                    {{ __("¡Has iniciado sesión exitosamente!") }}
                </div>

                {{-- Botón visible SOLO si es Administrador --}}
                @if (auth()->user()->role?->name === 'admin' || auth()->user()->role_id === 1)
                    <div class="mt-4">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                            Gestionar Usuarios
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>