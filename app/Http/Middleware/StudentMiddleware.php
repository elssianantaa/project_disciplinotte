<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna yang login adalah siswa
        if (Auth::check() && Auth::user()->role != 'student') {
            return redirect()->route('loginSiswa'); // Redirect ke halaman login jika bukan siswa
        }

        return $next($request);
    }
    
}