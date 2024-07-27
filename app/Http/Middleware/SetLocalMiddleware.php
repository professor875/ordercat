<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocalMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->user()->locale ?? config('app.locale');
        app()->setLocale($locale);

        return $next($request);
    }
}
