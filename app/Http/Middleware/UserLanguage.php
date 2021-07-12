<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( $request->user() ) {
            app()->setLocale($request->user()->language);
        }
        return $next($request);
    }
}
