<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $userRole = Auth::user()->role;

        $isAuthorized = collect($roles)->contains(function ($role) use ($userRole) {
            return strcasecmp($userRole, $role) === 0;
        });

        if (!$isAuthorized) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}