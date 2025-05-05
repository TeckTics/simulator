<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class guest
{
    public function handle(Request $request, Closure $next, $guard = 'appuser'): Response
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
