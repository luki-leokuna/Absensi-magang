<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        //cek apakah role user sesuai dengan yang diminta
        //user role kita simpan di kolom role pada tabel users
        if (Auth::user()->role != $role){
            // jika admin mencoba akses halaman mentor atau sebaliknya
            // kembalikan ke dashboard default masing-masing
            if(Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
            if(Auth::user()->role === 'mentor') return redirect()->route('mentor.dashboard');
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
