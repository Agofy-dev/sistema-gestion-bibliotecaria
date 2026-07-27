<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre Completo -->
        <div>
            <x-input-label for="name" :value="__('Nombre y Apellido')" />
            <x-text-input 
                id="name" 
                class="block mt-1 w-full" 
                type="text" 
                name="name" 
                :value="old('name')" 
                placeholder="Ej: Ángel Ocque"
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Cédula de Identidad -->
        <div class="mt-4">
            <x-input-label for="cedula" :value="__('Cédula')" />
            <x-text-input 
                id="cedula" 
                class="block mt-1 w-full" 
                type="text" 
                name="cedula" 
                :value="old('cedula')" 
                placeholder="Ej: V-30143976"
                required 
            />
            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
        </div>

        <!-- Teléfono de Contacto -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input 
                id="telefono" 
                class="block mt-1 w-full" 
                type="text" 
                name="telefono" 
                :value="old('telefono')" 
                placeholder="Ej: 0424-8471775"
                required 
            />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Correo Electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                placeholder="usuario@ejemplo.com"
                required 
                autocomplete="username" 
                inputmode="email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                placeholder="••••••••"
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation" 
                placeholder="••••••••"
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botones y Acciones -->
        <div class="mt-6 flex flex-col space-y-3">
            <x-primary-button class="w-full justify-center py-3 !bg-[#4a432e] hover:!bg-[#373222] focus:!bg-[#373222] text-white uppercase tracking-wider font-bold">
                {{ __('REGISTRAR') }}
            </x-primary-button>

            <div class="text-right">
                <a class="underline text-sm text-[#5c3e21] hover:text-[#373222] font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5c3e21]" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>