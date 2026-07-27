<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesa la solicitud de registro.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Convertir el correo a minúsculas internamente ANTES de validar
        if ($request->has('email')) {
            $request->merge([
                'email' => strtolower(trim($request->email)),
            ]);
        }

        // 2. Validación estándar de Laravel (sin la regla 'lowercase')
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Busca el rol 'lector' dinámicamente para obtener su ID exacto
        $lectorRole = Role::where('key', 'lector')->first();

        $user = User::create([
            'name' => $request->name,
            'second_name' => $request->second_name ?? '',
            'last_name' => $request->last_name ?? $request->apellido ?? '',
            'second_last_name' => $request->second_last_name ?? '',
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $lectorRole ? $lectorRole->id : 3,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}