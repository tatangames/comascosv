<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCookiesAccepted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Comprobar si la cookie está presente
        if ($request->cookie('cookiesAccepted')) {
            // El usuario ha aceptado las cookies
        } else {
            // El usuario no ha aceptado las cookies
            // Puedes redirigirlo o tomar otra acción
        }

        return $next($request);
    }
}
