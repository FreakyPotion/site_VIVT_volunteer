<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class AuthChecker
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::check()) {
            // Перенаправить на страницу авторизации, если пользователь не авторизован
            return redirect()->route('authorization');
        }

        // Если у пользователя роль 3 (например, администратор), редиректим на панель администратора
        if (Auth::check() && Auth::user()->Role_ID == 3) { 
            return redirect()->route('admin.panel');
        }

        // Если пользователь авторизован, запрос идет дальше
        return $next($request);
    }
}

