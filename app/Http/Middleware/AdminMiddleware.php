<?php

namespace app\Http\Middleware\AdminMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        // Cek apakah role user adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.home')->with('error', 'Akses ditolak! Anda bukan admin');
        }
        
        return $next($request);
    }
}