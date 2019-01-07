<?php

namespace App\Middleware;

use App\Middelware\Middelware;

class LocalHostMiddleware extends Middelware
{

    CONST HOSTS = ['localhost', '127.0.0.1'];

    /**
     * Handle an incoming request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param \Closure|Slim\Route                      $next
     *
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        $host = $request->getUri()->getHost();
        if (in_array($host, self::HOSTS)) {
            $response = $next($request, $response);
            return $response;
        }

        return $response->withStatus(403);
    }
}
