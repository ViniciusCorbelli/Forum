<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        if (Auth::user()->access == "Administrador" || $request->users == NULL || $request->user->id == Auth::user()->id) {
            return $next($request);
        }
        return redirect()->route('profile.users.index')->withMessage('Você não possui acesso à está página!');
    }
}
