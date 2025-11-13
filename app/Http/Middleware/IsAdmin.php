<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !optional($user->rol)->nombre || optional($user->rol)->nombre !== 'admin') {
            abort(403, 'No tienes permisos de administrador');
        }

        return $next($request);
    }
}
