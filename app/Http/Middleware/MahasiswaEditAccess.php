<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaEditAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        if ($mahasiswa && !$mahasiswa->edit) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk mengedit data.');
        }

        return $next($request);
    }
}
