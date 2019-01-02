<?php

use Respect\Validation\Validator as v;

$app->get('/home', function ($request, $response)
{
    return $this->view->render($response, 'home.twig');
});

$app->get('/home2', 'App\Controllers\HomeController:index');

$app->get('/', function ($request, $response)
{
    
    //$validator = $this->validator;

    //var_dump($validator);
    //die();

    $validation = $this->validator->validate($request, [
        'name' => v::positive()->noWhitespace()->boolVal()
    ]);

    //var_dump($validation);
    //var_dump($validation->failed());
    var_dump($validation->getErrors());
    //die();
    //return \Response::redirect('home');
});

use SlimApp\Artisan\ArtisanController as Art;
$app->group('/artisan', function(){

    $this->get('', Art::class . ':index')->setName('artisan');
    $this->get('/models', Art::class . ':getModels');

    $this->group('/make', function(){
        $this->post('/auth', Art::class . ':makeAuth');
        $this->post('/controller', Art::class . ':makeController');
        $this->post('/middelware', Art::class . ':makeMiddelware');
        $this->post('/migration', Art::class . ':makeMigration');
        $this->post('/model', Art::class . ':makeModel');
        $this->post('/seeder', Art::class . ':makeSeeder');
    });
});
