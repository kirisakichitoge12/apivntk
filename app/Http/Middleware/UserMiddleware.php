<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user || $user->role !== 'user') {
            return response()->json(['error' => 'Unauthorized - User only'], 403);
        }
        return $next($request);
    }
}
