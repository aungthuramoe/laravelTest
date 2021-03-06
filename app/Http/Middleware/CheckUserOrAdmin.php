<?php

namespace App\Http\Middleware;

use Closure;
use Facade\FlareClient\Http\Response;

class CheckUserOrAdmin
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
        if (auth()->user()->type != 0) {
            return redirect('/');
        } 
        return $next($request);
    }
}
