<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pengawas
{
    /**
     * Handle an incoming request.
     *SSS
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->akses == 'pengawas') {
            return $next($request);
        }
        abort(403, 'Akses Khusus Pengawas');
        
    }
}
