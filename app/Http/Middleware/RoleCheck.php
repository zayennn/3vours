<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user udah login
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Login dulu bro 😅');
        }

        // Ambil role user
        $userRole = auth()->user()->role;

        // Cek apakah role user ada di daftar yang diperbolehkan
        if (! in_array($userRole, $roles)) {
            abort(403, 'Akses ditolak ❌');
        }

        return $next($request);
    }
}
