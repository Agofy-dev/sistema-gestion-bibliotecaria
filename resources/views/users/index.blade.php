<x-app-layout>
    <div class="py-10 bg-[#f7f5f0] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Encabezado de la página -->
            <div class="flex flex-col sm:flex-row justify-between items-center bg-white p-6 rounded-lg shadow-sm border border-[#e2dcce]">
                <div>
                    <h2 class="text-2xl font-bold text-[#373222] tracking-wide">
                        Gestión de Usuarios
                    </h2>
                    <p class="text-sm text-[#6b634b] mt-1">
                        Administre las cuentas, roles y accesos del personal y lectores de la biblioteca.
                    </p>
                </div>
                
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('users.create') }}" 
                       class="inline-flex items-center px-5 py-2.5 bg-[#4a432e] hover:bg-[#373222] text-white font-semibold text-xs uppercase tracking-widest rounded-md shadow transition ease-in-out duration-150">
                        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nuevo Usuario
                    </a>
                </div>
            </div>

            <!-- Tabla de Usuarios -->
            <div class="bg-white rounded-lg shadow-sm border border-[#e2dcce] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-[#373222]">
                        <thead class="text-xs uppercase bg-[#e3ded1] text-[#4a432e] font-bold border-b border-[#d1c9b8]">
                            <tr>
                                <th scope="col" class="px-6 py-4">ID</th>
                                <th scope="col" class="px-6 py-4">Usuario</th>
                                <th scope="col" class="px-6 py-4">Cédula / Teléfono</th>
                                <th scope="col" class="px-6 py-4">Rol</th>
                                <th scope="col" class="px-6 py-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eee9de]">
                            @forelse ($users as $user)
                                <tr class="hover:bg-[#faf8f5] transition duration-150">
                                    <td class="px-6 py-4 font-bold text-[#5c3e21]">
                                        #{{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-[#2c281d]">
                                            {{ $user->name }} {{ $user->last_name ?? '' }}
                                        </div>
                                        <div class="text-xs text-[#7c735a]">
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-[#5c3e21]">
                                        <div><span class="font-semibold">V-</span>{{ $user->cedula ?? 'N/A' }}</div>
                                        <div class="text-[#7c735a]">{{ $user->telefono ?? 'Sin teléfono' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $roleName = $user->role->name ?? $user->role->key ?? 'Lector';
                                            $roleKey = strtolower($user->role->key ?? 'lector');
                                        @endphp

                                        @if(in_array($roleKey, ['superadmin', 'director']))
                                            <span class="px-3 py-1 text-xs font-bold text-[#4a3200] bg-[#fef3c7] border border-[#f59e0b] rounded-full shadow-sm">
                                                {{ $roleName }}
                                            </span>
                                        @elseif(in_array($roleKey, ['admin', 'bibliotecario']))
                                            <span class="px-3 py-1 text-xs font-bold text-[#1e3a8a] bg-[#dbeafe] border border-[#3b82f6] rounded-full shadow-sm">
                                                {{ $roleName }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold text-[#374151] bg-[#f3f4f6] border border-[#d1d5db] rounded-full shadow-sm">
                                                {{ $roleName }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center space-x-3">
                                            <!-- Botón Editar -->
                                            <a href="{{ route('users.edit', $user->id) }}" 
                                               class="text-[#5c3e21] hover:text-[#373222] font-semibold text-xs uppercase tracking-wider underline hover:no-underline transition">
                                                Editar
                                            </a>

                                            <span class="text-[#d1c9b8]">|</span>

                                            <!-- Botón Eliminar -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este usuario?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-700 hover:text-red-900 font-semibold text-xs uppercase tracking-wider underline hover:no-underline transition">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-[#7c735a]">
                                        No se encontraron usuarios registrados en la base de datos.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación (si aplica) -->
                @if(method_exists($users, 'links'))
                    <div class="p-4 bg-[#f7f5f0] border-t border-[#e2dcce]">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>