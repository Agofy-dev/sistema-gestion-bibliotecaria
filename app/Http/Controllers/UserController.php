<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Read: getAll() -> Lista de usuarios
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    // Formulario de creación
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Create: create($datos) -> Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name'             => $request->name,
            'second_name'      => $request->second_name ?? '',      // Evita el null violation
            'last_name'        => $request->last_name,
            'second_last_name' => $request->second_last_name ?? '', // Protege el segundo apellido
            'cedula'           => $request->cedula,
            'telefono'         => $request->telefono ?? '',         // Protege el teléfono
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'role_id'          => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Formulario de edición: getById($id)
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Update: update($id, $datos) -> Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->only(['name', 'second_name', 'last_name', 'second_last_name', 'cedula', 'telefono', 'email', 'role_id']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Delete: delete($id) -> Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
