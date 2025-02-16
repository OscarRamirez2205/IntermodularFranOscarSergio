<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRol
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!session()->has('rol') || $role != session('rol')) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
