<?php

namespace SlimApp\Artisan;

use App\Controllers\Controller;
use \Input;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\ControllerMakeCommand;
use SlimApp\Artisan\MiddlewareMakeCommand;

class ArtisanController extends Controller
{
    /**
     * Page artisan.
     */
    public function index($request, $response)
    {
        //$this->view->render($response, 'artisan/index.twig');
        $this->view->render($response, 'artisan/artisan.twig');
    }

    /**
     * Create a new controller class in app/Controllers folder.
     */
    public function makeController($request, $response, $args)
    {
        $type       = Input::post('type');
        $resource   = $type == 'resource' ? true : false;
        $invokable  = $type == 'invokable' ? true : false;
        $parent     = $type == 'parent' ? true : false;
        $api        = $type == 'api' ? true : false;

        $a = new ControllerMakeCommand(new Filesystem, [
            'name'      => Input::post('name'),
            'model'     => Input::post('model'),
            'resource'  => $resource,
            'invokable' => $invokable,
            'parent'    => $parent,
            'api'       => $api,
            'force'     => Input::post('force'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new controller class.
     */
    public function makeMiddelware($request, $response)
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
        echo "makeMigration";
    }

    /**
     * Create a new Eloquent model class.
     */
    public function makeModel($request, $response)
    {
        echo "makeModel";
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

1. make:controller
This command creates a new controller file in app/Http/Controllers folder.

Example usage:

php artisan make:controller UserController
Parameters:

--resource
The controller will contain a method for each of the available resource operations – index(), create(), store(), show(), edit(), update(), destroy().

--model=Photo
If you are using route model binding and would like the resource controller’s methods to type-hint a model instance.

--parent=Photo
Officially undocumented parameter, in the code it says “Generate a nested resource controller class” but for me it failed to generate a Controller properly. So probably work in progress.

2. make:model
Create a new Eloquent model class.

Example usage:

php artisan make:model Photo
Parameters:

--migration
Create a new migration file for the model.

--controller
Create a new controller for the model.

--resource
Indicates if the generated controller should be a resource controller.

Yes, you’ve got it right, you can do it like this:

php artisan make:model Project --migration --controller --resource
Or even shorter:

php artisan make:model Project -mcr
3. make:migration
Create a new migration file.

Example usage:

php artisan make:migration create_projects_table
Parameters:

--create=Table
The table to be created.

--table=Table
The table to migrate.

--path=Path
The location where the migration file should be created.

4. make:seeder
Create a new database seeder class.

Example usage:

php artisan make:seeder BooksTableSeeder
Parameters: none.

6. make:middleware
Create a new middleware class.

Example usage:

php artisan make:middleware CheckAge
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