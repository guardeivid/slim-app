<?php

namespace SlimApp\Artisan;

use App\Controllers\Controller;
use \Input;
use \Container;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\ControllerMakeCommand;
use SlimApp\Artisan\MiddlewareMakeCommand;
use SlimApp\Artisan\MigrationCreator;
use SlimApp\Artisan\MigrateMakeCommand;
use SlimApp\Artisan\ModelMakeCommand;
use SlimApp\Artisan\SeederMakeCommand;

class ArtisanController extends Controller
{

    public function __construct()
    {
        parent::__construct(Container::self());
        $this->file = new \Illuminate\Filesystem\Filesystem;
    }


    /**
     * Page artisan.
     */
    public function index($request, $response)
    {

        $this->view->render($response, 'artisan/index.twig');
    }

    /**
     * Create a new controller class in app/Controllers folder.
     */
    public function makeController($request, $response, $args)
    {
        $type       = Input::post('type');

        $a = new ControllerMakeCommand($this->file, [
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
        $a = new MiddlewareMakeCommand($this->file, [
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
            new MigrationCreator($this->file),
            $this->file, [
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
        $a = new ModelMakeCommand($this->file, [
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
        $a = new SeederMakeCommand($this->file, ['name' => Input::post('name')]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
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


    /**
     * .
     */
    public function migrate($request, $response)
    {
        $this->initMigrate();

        $a = new MigrateCommand($this->migrator, $this->resolver, [
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Init migrate
     */
    protected function initMigrate()
    {
        $this->resolver = new \Illuminate\Database\ConnectionResolver(['default' => $this->db]);
        $this->resolver->setDefaultConnection('default');

        $this->repository = new \Illuminate\Database\Migrations\DatabaseMigrationRepository($this->resolver, $this->migration_table);

        $this->migrator = new \Illuminate\Database\Migrations\Migrator($this->repository, $this->resolver, $this->file);

    }

}

/*
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