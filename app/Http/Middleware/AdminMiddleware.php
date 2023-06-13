<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminController;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!AdminController::isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
