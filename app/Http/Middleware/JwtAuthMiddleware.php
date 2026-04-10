<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Extract JWT token from cookie
        $token = $request->cookie('jwt_token');

        if ($token) {
            try {
                // Set the token so JWTAuth::user() and Auth::guard('api')->user() work
                JWTAuth::setToken($token);
            } catch (\Exception $e) {
                // Token is invalid or expired, continue without setting
            }
        }

        return $next($request);
    }
}

