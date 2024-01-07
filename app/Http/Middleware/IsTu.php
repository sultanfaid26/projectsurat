<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class IsTu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(Auth::user()->role == "staff") {
        return $next($request);
       } else {
        return redirect('/dashboard')->with('failed', 'Anda bukan staff & tidak memiliki akses kehalaman tersebut');
       }
    }
}
