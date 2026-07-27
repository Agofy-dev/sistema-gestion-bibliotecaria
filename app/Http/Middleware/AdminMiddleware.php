<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Permite el acceso si el usuario es SuperAdmin o Admin
        if ($user && ($user->role_id === 1 || in_array($user->role?->key, ['super_admin', 'admin']))) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Acceso Denegado. Se requieren permisos de administrador.');
    }
}