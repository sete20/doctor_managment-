<?php

namespace App\Http\Middleware\Api;

use Closure;

class lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if($request->lang && in_array($request->lang ,['en','ar']))
        {
            app()->setLocale($request->lang);
        }else{
            app()->setLocale('en');
        }

        return $next($request);
    }
}
