<x-guest-layout>
    <div class="mb-4 text-sm text-[#5c3e21] font-medium leading-relaxed">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo haznos saber tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Acciones: Botón de ancho completo en tono marrón -->
        <div class="mt-6 flex flex-col space-y-3">
            <x-primary-button class="w-full justify-center py-3 !bg-[#4a432e] hover:!bg-[#373222] focus:!bg-[#373222] text-white uppercase tracking-wider font-bold">
                {{ __('Enviar enlace de recuperación') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>