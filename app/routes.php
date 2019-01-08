<?php

use Respect\Validation\Validator as v;

$app->get('/home', function ($request, $response)
{
    return $this->view->render($response, 'home.twig');
});

$app->get('/home2', 'App\Controllers\HomeController:index');

$app->get('/', function ($request, $response) {

    //$validator = $this->validator;
    $host = $request->getUri()->getHost();
    echo "hola";
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
