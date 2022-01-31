<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() != null && Auth::user()->verified == 0) {
            $message = "Sua conta ainda não foi verificada.";
            auth()->logout();
            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
