<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si no es admin (o role_id != 1), lo rebota al dashboard con un mensaje de error
        if (auth()->check() && (auth()->user()->role?->name === 'admin' || auth()->user()->role_id === 1)) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Acceso Denegado. Se requieren permisos de administrador.');
    }
}