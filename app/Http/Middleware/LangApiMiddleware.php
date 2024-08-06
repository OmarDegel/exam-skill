<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LangApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang=$request->header("Accept-Language");
        $acceptlangs= ["en","ar"];
        if(! in_array($lang,$acceptlangs)){
            $lang="en";
        }
        App::setLocale($lang);
        return $next($request);
    }
}
