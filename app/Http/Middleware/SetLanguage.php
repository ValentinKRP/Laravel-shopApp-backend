<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $locale = request()->server('HTTP_ACCEPT_LANGUAGE');
        $locale = substr($locale, 0, 2);
        App::setLocale($locale);

        return $next($request);
    }
}
