<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->profile->role->roleName === $role) {
            return $next($request);
        }else {
            return redirect('/masuk')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
}
