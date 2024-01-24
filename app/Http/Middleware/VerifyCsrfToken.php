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
        'v1/pelis/demo',
        'v1/pelis/create',
        'v1/pelis/getById/**',
        'v1/pelis/update/**',
        'v1/pelis/delete/**'
    ];
}
