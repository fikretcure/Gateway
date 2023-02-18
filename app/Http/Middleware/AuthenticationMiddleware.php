<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class AuthenticationMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse//: JsonResponse
    {
        return $next($request);

    }
}
