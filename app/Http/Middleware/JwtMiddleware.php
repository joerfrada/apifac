<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        try
        {
            $user = JWTAuth::parseToken()->authenticate();
        } 
        catch (Exception $e)
        {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return response()->json(['tipo' => -1, 'codigo' => 1, 'mensaje' => 'Token no es válido.'], 401);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return response()->json(['tipo' => -1, 'codigo' => 2, 'mensaje' => 'La sesión ha expirado. Intente conectarse nuevamente.'], 401);
            }
            else
            {
                return response()->json(['tipo' => -1, 'codigo' => 3, 'mensaje' => 'No autorizado', 401]);
            }
        }
        return $next($request);
    }
}
