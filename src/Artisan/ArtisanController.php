<?php

namespace SlimApp\Artisan;

use App\Controllers\Controller;
use \Input;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\ControllerMakeCommand;
use SlimApp\Artisan\MiddlewareMakeCommand;
use SlimApp\Artisan\MigrationCreator;
use SlimApp\Artisan\MigrateMakeCommand;
use SlimApp\Artisan\ModelMakeCommand;

class ArtisanController extends Controller
{
    /**
     * Page artisan.
     */
    public function index($request, $response)
    {
        
        $this->view->render($response, 'artisan/artisan.twig');
    }

    /**
     * Create a new controller class in app/Controllers folder.
     */
    public function makeController($request, $response, $args)
    {
        $type       = Input::post('type');

        $a = new ControllerMakeCommand(new Filesystem, [
            'name'      => Input::post('name'),
            'model'     => Input::post('model'),
            'resource'  => $type == 'resource' ? true : false,
            'invokable' => $type == 'invokable' ? true : false,
            'parent'    => $type == 'parent' ? true : false,
            'api'       => $type == 'api' ? true : false,
            'force'     => Input::post('force'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new middleware class.
     */
    public function makeMiddleware($request, $response)
    {
        $a = new MiddlewareMakeCommand(new Filesystem, [
            'name'      => Input::post('name'),
            'force'     => Input::post('force'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new migration file.
     */
    public function makeMigration($request, $response)
    {
        $a = new MigrateMakeCommand(
            new MigrationCreator(new Filesystem), 
            new Filesystem, [
                'name'   => Input::post('name'),
                'table'  => Input::post('table'),
                'create' => Input::post('type') == 'create' ? true : false,
                'path'     => null, //save in database/migrations
                'realpath' => null,
                'force'  => Input::post('force'),
            ]
        );

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new Eloquent model class.
     */
    public function makeModel($request, $response)
    {
        $a = new ModelMakeCommand(new Filesystem, [
            'name'      => Input::post('name'),
            'all'       => Input::post('all'),
            'factory'   => Input::post('factory'),
            'migration' => Input::post('migration'),
            'controller'=> Input::post('controller'),
            'resource'  => Input::post('resource'),
            'pivot'     => Input::post('pivot'),
            'force'     => Input::post('force'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new seeder class.
     */
    public function makeSeeder($request, $response)
    {
        echo "makeSeeder";
    }

    /**
     * Scaffold basic login and registration views and routes.
     */
    public function makeAuth($request, $response)
    {
        echo "makeAuth";
    }



    public function getModels($request, $response)
    {
        $files = [];
        foreach (glob(APP_PATH . "Models/*.php") as $file) {
            $files[] = basename($file, '.php');
        }

        return $response->withJson($files);
    }

}

/*

    4. make:seeder
    Create a new database seeder class.

    Example usage:

    php artisan make:seeder BooksTableSeeder
    Parameters: none.

    8. make:auth
    Example usage:

    php artisan make:auth
    Scaffold basic login and registration views and routes.

    Parameters:

    --views
    Only scaffold the authentication views.

    --force
    Overwrite existing views by default.

*/