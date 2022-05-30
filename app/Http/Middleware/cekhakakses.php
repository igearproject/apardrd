<?php

namespace App\Http\Middleware;

use Closure;

class cekhakakses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$hak_akses)
    {
        if (in_array($request->user()->hak_akses, $hak_akses)) {
            return $next($request);
        }elseif ($request->user()->hak_akses=='nonaktif') {
            return redirect('/login')->with('danger','User anda sudah di nonaktif kan dengan alasan keamanan');
        }
        return redirect('/');
    }
}
