<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class AuthCheckerReverse
{
    public function handle(Request $request, Closure $next): mixed
    {
         // Если пользователь не авторизован и пытается попасть на панель администратора, редиректим на страницу авторизации
        if ($request->is('panel*') && !Auth::check()) {  
            return redirect()->route('authorization');
        }

         // Если пользователь авторизован и пытается попасть авторизацию, редиректим на панель администратора
         if (($request->is('authorization*') || ($request->is('registration*'))) && Auth::check()) {  
            return redirect()->route('admin.panel');
        }

        // Если пользователь авторизован
        if (Auth::check() && Auth::user()->Role_ID != 3) {
            return redirect()->route('main.page');
        }




        return $next($request);
    }
}

