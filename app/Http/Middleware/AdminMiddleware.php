<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')->withErrors(['login' => 'Необходима авторизация.']);
        }

        if (! Auth::user()->is_admin) {
            return redirect()->route('home')->withErrors(['auth' => 'Недостаточно прав для доступа в админ-панель.']);
        }

        return $next($request);
    }
}
