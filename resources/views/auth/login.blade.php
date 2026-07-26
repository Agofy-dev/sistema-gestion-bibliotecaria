<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Por favor, rellene este campo.' : 'Por favor, incluya un signo @ en la dirección de correo electrónico.')" oninput="this.setCustomValidity('')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" 
                        placeholder="Contraseña"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <!-- Acciones: Botón full-width y enlace en tono marrón personalizado -->
        <div class="mt-6 flex flex-col space-y-3">
            {{-- Botón con el marrón sepia de welcome.php --}}
            <x-primary-button class="w-full justify-center py-3 !bg-[#4a432e] hover:!bg-[#373222] focus:!bg-[#373222] text-white uppercase tracking-wider font-bold">
                {{ __('Iniciar sesión') }}
            </x-primary-button>

            {{-- Enlace alineado a la derecha con tono marrón sepia --}}
            @if (Route::has('password.request'))
                <div class="text-right">
                    <a class="underline text-sm text-[#5c3e21] hover:text-[#373222] font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5c3e21]" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>