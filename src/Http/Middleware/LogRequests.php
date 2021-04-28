<?php

namespace LeandroSe\LaravelGelfLogging\Http\Middleware;

use Closure;
use LaravelGelfLogging;
use Symfony\Component\HttpFoundation\Request;

class LogRequests
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        LaravelGelfLogging::request($request, $response);
    }
}
