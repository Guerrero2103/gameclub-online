<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        dd('Reached Authenticate middleware'); // Temporary debugging line
        $this->authenticate($request, $guards);

        return $next($request);
    }
} 