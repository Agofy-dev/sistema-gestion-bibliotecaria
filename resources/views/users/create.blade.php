<x-app-layout>
    <div class="py-10 bg-[#f7f5f0] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-[#faf6ee] p-8 rounded-lg shadow-sm border border-[#e2dcce]">
                <div class="mb-6 border-b border-[#e2dcce] pb-4">
                    <h2 class="text-2xl font-bold text-[#373222] font-serif">
                        Crear Nuevo Usuario
                    </h2>
                    <p class="text-sm text-[#6b634b] mt-1">
                        Complete los campos requeridos para registrar un nuevo usuario en la plataforma.
                    </p>
                </div>

                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf

                    <!-- Nombres -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Primer Nombre *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="second_name" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Segundo Nombre</label>
                            <input type="text" name="second_name" id="second_name" value="{{ old('second_name') }}"
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('second_name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Apellidos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="last_name" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Primer Apellido *</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="second_last_name" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Segundo Apellido</label>
                            <input type="text" name="second_last_name" id="second_last_name" value="{{ old('second_last_name') }}"
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('second_last_name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Cédula y Teléfono -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="cedula" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Cédula *</label>
                            <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}" required
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                        </div>

                        <div>
                            <label for="telefono" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Correo Electrónico y Contraseña -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Correo Electrónico *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Contraseña *</label>
                            <input type="password" name="password" id="password" required
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Rol de Usuario (Selector solo para SuperAdmin) -->
                    @if(Auth::user()->hasRole('superadmin'))
                        <div>
                            <label for="role_id" class="block text-xs font-bold uppercase tracking-wider text-[#4a432e]">Rol de Usuario *</label>
                            <select id="role_id" name="role_id" required
                                class="mt-1 block w-full bg-[#fcfbfa] border-[#d1c9b8] rounded-md shadow-sm focus:border-[#5c3e21] focus:ring-[#5c3e21] text-[#373222] text-sm">
                                <option value="" disabled selected>Seleccione un rol...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }} ({{ $role->key }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>
                    @else
                        @php
                            $lectorRole = $roles->firstWhere('key', 'lector') ?? $roles->firstWhere('name', 'Lector');
                        @endphp
                        <input type="hidden" name="role_id" value="{{ $lectorRole->id ?? 3 }}">
                        <div class="p-3 bg-[#f0ebe1] rounded-md border border-[#e2dcce] text-xs text-[#6b634b]">
                            ℹ️ El usuario será registrado automáticamente con el rol de <strong>Lector</strong>. Solamente el SuperAdmin del sistema posee privilegios para otorgar otros roles.
                        </div>
                    @endif

                    <!-- Botones -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-[#e2dcce]">
                        <a href="{{ route('users.index') }}" 
                            class="px-4 py-2 bg-[#e6e0d2] hover:bg-[#ded7c5] text-[#4a432e] font-semibold text-xs uppercase tracking-wider rounded-md border border-[#d1c9b8] transition">
                            Cancelar
                        </a>

                        <button type="submit" 
                                class="px-5 py-2.5 bg-[#4a432e] hover:bg-[#373222] text-white font-semibold text-xs uppercase tracking-widest rounded-md shadow transition">
                            Guardar Usuario
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>