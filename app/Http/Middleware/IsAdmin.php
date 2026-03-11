<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
{
    // Kant-akkdou wach l-user m-connecti w wach 3ndou role 'admin'
    if (auth()->check() && auth()->user()->role == 'admin') {
        return $next($request);
    }

    // Ila machi admin, rj3ou l-page d'accueil b message d'erreur
    return redirect('/')->with('error', "M3ndekch l-7aq t-dkhol l-hadi l-blasa!");
}
}
