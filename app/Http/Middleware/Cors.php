<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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
        $request->header('Access-Control-Allow-Origin: *');
        $request->header("Access-Control-Allow-Methods", "GET, POST");
        $request->header('Access-Control-Allow-Origin: Content-type, Authorization');
        return $next($request);
    }
}
