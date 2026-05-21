<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
<div>
    <x-input-label for="name" :value="__('Nombre y Apellido')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Nombre y Apellido" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="cedula" :value="__('Cédula')" />
    <x-text-input id="cedula" class="block mt-1 w-full" type="text" name="cedula" :value="old('cedula')" required placeholder="Número de Cédula" />
    <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="telefono" :value="__('Teléfono')" />
    <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" placeholder="Número de Telefono" />
    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="email" :value="__('Correo Electrónico')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Correo Electronico" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="password" :value="__('Contraseña')" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Ingresar Contraseña" />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required placeholder="Confirmar Contraseña" />
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
    {{ __('¿Ya estás registrado?') }}
</a>

    <x-primary-button class="ms-4">
        {{ __('Registrar') }}
    </x-primary-button>
</div>
    </form>
</x-guest-layout>
