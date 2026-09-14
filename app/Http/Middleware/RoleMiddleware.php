<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Periksa apakah user yang login memiliki role yang diizinkan.
     *
     * Cara penggunaan di route:
     *   ->middleware('role:admin')
     *   ->middleware('role:instructor')
     *   ->middleware('role:student')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!in_array($user->role, $roles)) {
            // Redirect ke dashboard sesuai role user yang aktif
            return redirect()->route($user->role . '.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
