<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        '/panier/store',
        '/cart/store',
        '/admin/login',
        '/admin/create',
        '/admin/1',
        '/admin/2',
        '/admin/3',
        '/admin/5',
        '/admin/8',
        '/admin/9',
        '/admin/reservations/12',
        '/admin/reservations/15',
        'login',
        'register',
        'admin/7',
    ];
}
