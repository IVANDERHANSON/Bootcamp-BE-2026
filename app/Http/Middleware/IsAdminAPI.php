<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if($user->role == 'Admin') {
            return $next($request);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized.'
        ], 401);
    }
}
