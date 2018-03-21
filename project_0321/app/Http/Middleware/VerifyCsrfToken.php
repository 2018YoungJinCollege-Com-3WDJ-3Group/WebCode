<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'http://52.78.122.145/*',
        'http://52.78.122.145/duplication',
        'http://52.78.122.145/main/*',
        'http://52.78.122.145/login'
    ];
}
