<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class Authenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Если пользователь авторизован, то продолжаем выполнение запроса
            return $next($request);
        } else {
            // Если пользователь не авторизован, то перенаправляем на страницу авторизации
            return Inertia::location(route('login'));
        }
    }
}
