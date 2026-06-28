<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Filter kecocokan role akun
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->role !== $role) {
            abort(403, 'Akses ditolak. Halaman ini bukan untuk role Anda.');
        }

        return $next($request);
    }
}
