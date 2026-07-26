<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Valida si está autenticado y si su relación 'role' es administrador
        if (auth()->check() && auth()->user()->role && auth()->user()->role->name === 'admin') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Acceso Denegado');
    }
}