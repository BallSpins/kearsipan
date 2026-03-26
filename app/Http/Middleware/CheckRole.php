<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRoleValue = auth()->user()->role->value;

        if (!in_array($userRoleValue, $roles)) {
            abort(403, 'Akses ditolak: Peran Anda tidak diizinkan.');
        }

        return $next($request);
    }
}
