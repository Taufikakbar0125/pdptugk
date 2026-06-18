<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            if ($role === 'admin') {
                return redirect()->route('admin.login')->withErrors(['email' => 'Silakan login sebagai Admin terlebih dahulu.']);
            }
            return redirect('/validasi-data/login')->withErrors(['login_key' => 'Silakan login sebagai Mahasiswa terlebih dahulu.']);
        }

        return $next($request);
    }
}
