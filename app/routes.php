<?php

use Respect\Validation\Validator as v;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->get('/home', function ($request, $response)
{
    return $this->view->render($response, 'home.twig');
});

$app->get('/home2', 'App\Controllers\HomeController:index');

$app->get('/', function ($request, $response) {

    $routes = $this->router->getRoutes();
    // And then iterate over $routes

    //var_dump($routes);
    $html = "<table>
    <thead>
        <tr>
            <td> Method </td>
            <td> URI </td>
            <td> Name </td>
            <td> Action </td>
        </tr>
    </thead>
    <tbody>";

    $i=0;
    foreach ($routes as $route) {
        /*if($i==0){
            $groups = $route->getGroups();
            //print_r($groups);
            if(count($groups)){
                foreach ($groups as $group) {
                    //echo $group->getPattern();
                    $middles = $group->getMiddleware();
                    //echo $middle;
                    var_dump($middles);
                    foreach ($middles as $middle) {
                        //print_r($middle->resolveCallable());
                        //echo $middle instanceof Closure ? 'Closure' : $middle->getCallable();
                    }
                    //echo $group->getMiddleware() instanceof Closure ? 'Closure' : $group->getMiddleware();
                }
            }
            $i++;
        }*/
        $action = $route->getCallable() instanceof Closure ? 'Closure' : $route->getCallable();
        //$middleware = $route->getMiddleware();
        //var_dump($middleware);

        $html .= "<tr>
            <td>" . implode('|', $route->getMethods()) . "</td>
            <td>". $route->getPattern() . "</td>
            <td>". $route->getName() . "</td>
            <td>". $action . "</td>
            <td>". /*implode(',', $route->getMiddleware()) . */"</td>
            <td>". /*implode(',', $route->getGroups()) .*/ "</td>
        </tr>";
    }

    $html .= "</tbody></table>";

    echo $html;

    //$validator = $this->validator;
    //$host = $request->getUri()->getHost();
    //echo "hola";
    //var_dump($host == 'localhost' or $host == '127.0.0.1');
    //die();

    /*$validation = $this->validator->validate($request, [
        'name' => v::positive()->noWhitespace()->boolVal()
    ]);*/

    //var_dump($validation);
    //var_dump($validation->failed());
    //var_dump($validation->getErrors());
    //die();
    //return \Response::redirect('home');
});

$app->get('/migrate', 'SlimApp\Artisan\ArtisanController:migrate');
$app->get('/route', 'SlimApp\Artisan\ArtisanController:routeList');
