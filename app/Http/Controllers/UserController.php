<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Middleware de protección usando el estándar moderno de Laravel (HasMiddleware).
     * Restringe el acceso completo al módulo si el usuario tiene rol de 'lector'.
     */
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                $user = auth()->user();

                if (!$user || $user->hasRole('lector')) {
                    abort(403, 'No tiene permisos para acceder al Módulo de Usuarios.');
                }

                return $next($request);
            }
        ];
    }

    /**
     * Muestra la lista general de usuarios.
     */
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Registra un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Si no es SuperAdmin, el rol asignado por defecto siempre será Lector
        if (!auth()->user()->hasRole('super_admin')) {
            $lectorRole = Role::where('key', 'lector')->first() ?? Role::where('name', 'Lector')->first();
            $request->merge(['role_id' => $lectorRole->id ?? 3]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'second_last_name' => ['nullable', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:20', 'unique:users,cedula'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        User::create([
            'name' => $request->name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'second_last_name' => $request->second_last_name,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => $request->password, // Hashed automáticamente por el cast del modelo User
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza los datos del usuario especificado.
     */
    public function update(Request $request, User $user)
    {
        // Si no es SuperAdmin, se preserva el rol que ya tenía el usuario
        if (!auth()->user()->hasRole('super_admin')) {
            $request->merge(['role_id' => $user->role_id]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'second_last_name' => ['nullable', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $data = [
            'name' => $request->name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'second_last_name' => $request->second_last_name,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina a un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}