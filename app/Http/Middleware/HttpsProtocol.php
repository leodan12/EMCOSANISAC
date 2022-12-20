<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class HttpsProtocol
{
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && app()->environment() != 'local') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}

