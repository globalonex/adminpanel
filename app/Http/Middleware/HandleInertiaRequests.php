<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $isAdmin = false; // По умолчанию не является администратором
        if ($request->user()) {
            // Ваша логика определения администратора, например, на основе ролей или прав
            // Пример: $isAdmin = $request->user()->isAdmin();
        }

        // Проверяем, является ли текущий путь (URI) роутера начинающимся с '/admin'
        if (Route::is('admin*')) {
            $isAdminRoute = true;
        } else {
            $isAdminRoute = false;
        }

        return array_merge(parent::share($request), [
            'csrf_token' => csrf_token(),
            'flash' => [
                'success' => fn () => $request->session()->get('success')
            ],
            'auth.user' => fn () => $request->user() ? $request->user()->only('id', 'name', 'email') : null,
            'isAdmin' => $isAdmin, // Добавляем флаг 'isAdmin' в данные, передаваемые во Vue.js
            'isAdminRoute' => $isAdminRoute // Добавляем флаг 'isAdminRoute' в данные, передаваемые во Vue.js
        ]);
    }

}
