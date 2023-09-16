<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminKlinikMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::User()->role === 1) {
            return $next($request);
        }
        else if (Auth::User()->role === 2) {
            return $next($request);
        }
        else {
            abort(403, 'Anda Tidak berhak Mengakses Halaman Ini.');
        }
    }
}
