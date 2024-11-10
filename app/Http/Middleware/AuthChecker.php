<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AuthChecker
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::check()) {
            // Перенаправить на страницу авторизации, если пользователь не авторизован
            return redirect()->route('authorization');
        }

        // Если пользователь авторизован, запрос идет дальше
        return $next($request);
    }
}

