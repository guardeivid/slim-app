<?php
namespace App\Middelware;

use App\Middelware\Middelware;

class OldInputMiddelware extends Middelware
{
    /**
     * Handle an incoming request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param \Closure                                 $next
     *
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['old'])) {
            $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
            $_SESSION['old'] = $request->getParams();
        }

        $response = $next($request, $response);
        return $response;
    }
}