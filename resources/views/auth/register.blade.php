<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre y Apellido')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Cédula -->
        <div class="mt-4">
            <x-input-label for="cedula" :value="__('Cédula')" />
            <x-text-input id="cedula" class="block mt-1 w-full" type="text" name="cedula" :value="old('cedula')" required />
            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Teléfono')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Acciones: Botón a ancho completo y enlace marrón abajo a la derecha -->
        <div class="mt-6 flex flex-col space-y-3">
            {{-- Botón Registrar de ancho completo con color marrón --}}
            <x-primary-button class="w-full justify-center py-3 !bg-[#4a432e] hover:!bg-[#373222] focus:!bg-[#373222] text-white uppercase tracking-wider font-bold">
                {{ __('REGISTRAR') }}
            </x-primary-button>

            {{-- Enlace 'Ya estás registrado?' alineado a la derecha en tono marrón sepia --}}
            <div class="text-right">
                <a class="underline text-sm text-[#5c3e21] hover:text-[#373222] font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5c3e21]" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>