<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Post
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
        if ($request->post == NULL && Auth::user()->access == "Leitor") {
            return redirect()->route('profile.users.show', Auth::user()->id)->withMessage('Você não possui acesso à está página!');
        }
        if (Auth::user()->access == "Administrador" || $request->post == NULL || $request->post->user_id == Auth::user()->id) {
            return $next($request);
        }
        return redirect()->route('profile.posts.index')->withMessage('Você não possui acesso à está página!');
    }
}
