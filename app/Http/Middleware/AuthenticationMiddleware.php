<?php

namespace App\Http\Middleware;


use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class AuthenticationMiddleware
{
    use ResponseTrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {

//        return $this->failMes("Hatasız kul olmaz !")->send();

        return $next($request);

    }
}
