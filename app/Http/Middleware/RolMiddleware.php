<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        if (Auth::check() && Auth::user()->role === $rol) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado');
    }
}
