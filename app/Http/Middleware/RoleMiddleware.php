<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/'); // Belum login
        }

        if (!in_array(Auth::user()->role, $roles)) {
            return redirect()->back()->with('error', 'Tidak boleh mengakses halaman ini!');
        }

        return $next($request);
    }
}
