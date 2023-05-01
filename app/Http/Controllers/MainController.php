<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    //
    const AUTH_PREFIX = 'Auth';
    const ADMIN_PREFIX = 'Admin';

    function __construct()
    {
//        $this->middleware(['throllet']);
    }

    function index() {
        return Inertia::render('Home');
    }
    function login_page() {
        return Inertia::render(self::AUTH_PREFIX . '/Login', [
            'title' => 'Авторизация'
        ]);
    }
    function register_page() {
        return Inertia::render(self::AUTH_PREFIX .  '/Register', [
            'title' => 'Регистрация'
        ]);
    }

    function admin_page() {
        return Inertia::render(self::ADMIN_PREFIX . '/Index', [
            'title' => "Админ панель",
            'breadcrumbs' => [
                ['label' => 'Админ', 'url' => route('admin')],
            ],
        ]);
    }
    function dishes_page() {
        return Inertia::render(self::ADMIN_PREFIX. '/Menu/Dishes', [
            'title' => "Блюда",
            'breadcrumbs' => [
                ['label' => 'Меню', 'url' => route('admin')],
                ['label' => 'Блюда', 'url' => route('admin.dishes')],
            ],
        ]);
    }
}
