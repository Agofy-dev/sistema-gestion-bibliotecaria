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
                                            // Obtiene el texto del rol ya sea un objeto de relación o un string directo
                                            $roleText = is_object($user->role) 
                                                ? ($user->role->name ?? $user->role->key ?? 'Lector') 
                                                : ($user->role ?? 'Lector');

                                            $roleSlug = strtolower($roleText);
                                        @endphp

                                        @if(str_contains($roleSlug, 'super') || str_contains($roleSlug, 'director'))
                                            <!-- SuperAdmin (Director): Estilo dorado / ámbar imponente con estrella -->
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-extrabold text-[#78350f] bg-[#fef3c7] border border-[#f59e0b] rounded-full shadow-sm tracking-wide">
                                                <svg class="w-3.5 h-3.5 me-1 text-[#d97706]" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                                {{ $roleText }}
                                            </span>
                                        @elseif(str_contains($roleSlug, 'admin') || str_contains($roleSlug, 'bibliotecario'))
                                            <!-- Admin (Bibliotecario): Estilo azul profesional -->
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-[#1e3a8a] bg-[#dbeafe] border border-[#3b82f6] rounded-full shadow-sm">
                                                {{ $roleText }}
                                            </span>
                                        @else
                                            <!-- Lector / Normal: Estilo neutro sobrio -->
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-[#4b5563] bg-[#f3f4f6] border border-[#d1d5db] rounded-full shadow-sm">
                                                {{ $roleText }}
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

                <!-- Paginación -->
                @if(method_exists($users, 'links'))
                    <div class="p-4 bg-[#f7f5f0] border-t border-[#e2dcce]">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>