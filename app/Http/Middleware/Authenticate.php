<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Gunakan session biasa untuk menjamin flash ter-set
            Session::flash('error', 'Silakan login terlebih dahulu.');
            return route('login');
        }
    }
}
