<?php

namespace SlimApp\Artisan;

use App\Controllers\Controller;
use \Input;
use \Container;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\ControllerMakeCommand;
use SlimApp\Artisan\MiddlewareMakeCommand;
use SlimApp\Artisan\MigrateMakeCommand;
use SlimApp\Artisan\ModelMakeCommand;
use SlimApp\Artisan\RuleMakeCommand;
use SlimApp\Artisan\SeederMakeCommand;
use SlimApp\Artisan\InstallCommand;
use SlimApp\Artisan\RouteListCommand;
use SlimApp\Artisan\MigrateCommand;
use SlimApp\Artisan\RollbackCommand;
use SlimApp\Artisan\ResetCommand;
use SlimApp\Artisan\RefreshCommand;
use SlimApp\Artisan\FreshCommand;
use SlimApp\Artisan\SeedCommand;

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

            'plain'     => Input::post('plain'),
            'soft'      => Input::post('soft'),
            'table'     => Input::post('table'),
            'autopk'    => Input::post('autopk'),
            'primarykey'=> Input::post('primarykey'),
            'incrementing'=> Input::post('incrementing'),
            'keytype'   => Input::post('keytype'),
            'timestamps'=> Input::post('timestamps'),
            'created_at'=> Input::post('created_at'),
            'updated_at'=> Input::post('updated_at'),
            'autofill'  => Input::post('autofill'),
            'fillable'  => Input::post('fillable'),
            'guarded'   => Input::post('guarded'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new Rule and Exception class.
     */
    public function makeValidation($request, $response)
    {
        $a = new RuleMakeCommand($this->file, [
            'name'      => Input::post('name'),
            'force'     => Input::post('force'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Create a new seeder class.
     */
    public function makeSeeder($request, $response)
    {
        $a = new SeederMakeCommand($this->file, [
            'name'  => Input::post('name'),
            'model' => Input::post('model'),
            'force' => Input::post('force'),
        ]);

        return $response->withJson(['info'  => $a->info, 'error' => $a->error]);
    }

    /**
     * Scaffold basic login and registration views and routes.
     */
    public function makeAuth($request, $response)
    {
        echo "makeAuth";
    }

    /**
     * List all registered routes.
     */
    public function routeList($request, $response)
    {
        $sort = ['method, uri, name, action'];

        $a = new RouteListCommand($this->router, [
            'method' => Input::post('method') ?: false,
            'name' => Input::post('name') ?: false,
            'path' => Input::post('path') ?: false,
            'reverse' => Input::post('reverse') ?: false,
            'sort' => Input::post('sort') ?: 'uri',
        ]);

        return $response->withJson(['notes' => $a->note]);
    }

    protected function getFiles($path)
    {
        $files = [];
        foreach (glob($path) as $file) {
            $files[] = basename($file, '.php');
        }

        return $files;
    }

    public function getModels($request, $response)
    {
        return $response->withJson($this->getFiles(APP_PATH . "Models/*.php"));
    }

    public function getSeeders($request, $response)
    {
        return $response->withJson($this->getFiles(APP_PATH . "database/seeds/*.php"));
    }


    /**
     * Migrate:install
     */
    public function install($request, $response)
    {
        $this->initMigrate();

        try {
            $a = new InstallCommand($this->repository, [
                'database'  => Input::post('database') ?: 'default',
            ]);

            return $response->withJson(['notes'  => $a->note]);
        } catch (Exception $e) {
            return $response->withJson(['notes'  => "<critical>".$e->getMessage()."</critical>"]);
        }

    }

    /**
     * Migrate migrate
     */
    public function migrate($request, $response)
    {
        $this->initMigrate();

        $a = new MigrateCommand($this->migrator, $this->resolver, [
            'database'  => Input::post('database')  ?: 'default',
            'pretend'   => Input::post('pretend')   ?: false,
            'seed'      => Input::post('seed')      ?: false,
            'step'      => Input::post('step')      ?: false,
            'force'     => Input::post('force')     ?: false,
            'class'     => Input::post('clase')     ?: 'DatabaseSeeder',
        ]);

        return $response->withJson(['notes'  => $a->note]);
    }

    /**
     * Migrate:rollback
     */
    public function rollback($request, $response)
    {
        $this->initMigrate();

        $a = new RollbackCommand($this->migrator, [
            'database'  => Input::post('database')  ?: 'default',
            'pretend'   => Input::post('pretend')   ?: false,
            'step'      => (int) Input::post('step'),
            'force'     => Input::post('force')     ?: false,
            'path'      => false, //The path of migrations files to be executed
        ]);

        return $response->withJson(['notes'  => $a->note]);
    }

    /**
     * Migrate:reset
     */
    public function reset($request, $response)
    {
        $this->initMigrate();

        $a = new ResetCommand($this->migrator, [
            'database'  => Input::post('database') ?: 'default',
            'pretend'   => Input::post('pretend') ?: false,
            'force'     => Input::post('force') ?: false,
            'path'      => false, //The path of migrations files to be executed
        ]);

        return $response->withJson(['notes'  => $a->note]);
    }

    /**
     * Migrate:refresh
     */
    public function refresh($request, $response)
    {
        $this->initMigrate();

        $a = new RefreshCommand($this->migrator, $this->resolver, [
            'database'  => Input::post('database') ?: 'default',
            'force'     => Input::post('force') ?: false,
            'path'      => false, //The path of migrations files to be executed
            'seed'      => Input::post('seed') ?: false,
            'seeder'    => Input::post('seeder') ?: 'DatabaseSeeder',
            'step'      => (int) Input::post('step'),
        ]);

        return $response->withJson(['notes'  => $a->note]);
    }

    /**
     * Migrate:fresh
     */
    public function fresh($request, $response)
    {
        //(Illuminate/Database/Schema/PostgresBuilder.php)
        //Version illuminate\database >= 5.5 dropAllTables
        //Version illuminate\database >= 5.6 dropAllViews

        $version = $this->getVersion();

        if ($version >= 5.6) {
            $this->initMigrate();

            $a = new FreshCommand($this->migrator, $this->resolver, [
                'database'      => Input::post('database') ?: 'default',
                'drop-views'    => Input::post('drop-views') ?: false,
                'force'         => Input::post('force') ?: false,
                'path'          => false, //The path of migrations files to be executed
                'seed'          => Input::post('seed') ?: false,
                'seeder'        => Input::post('seeder') ?: 'DatabaseSeeder',
                'step'          => (int) Input::post('step'),
            ]);
        } else {
            return $response->withJson(['notes'  => ['<critical>Command not support in version '.$version.' installed of illuminate\\database</critical>']]);
        }

        return $response->withJson(['notes'  => $a->note]);
    }

    /**
     * Db:seed
     */
    public function seed($request, $response)
    {
        $this->initMigrate();

        $a = new SeedCommand($this->resolver, [
            'database'  => Input::post('database') ?: 'default',
            'class'     => Input::post('class') ?: 'DatabaseSeeder',
            'force'     => Input::post('force') ?: false,
        ]);

        return $response->withJson(['notes'  => $a->note]);
    }


    /**
     * Init migrate
     */
    protected function initMigrate()
    {

        $this->resolver = new \Illuminate\Database\ConnectionResolver(
            ['default' => $this->db->getConnection()]
        );
        $this->resolver->setDefaultConnection('default');

        $this->repository = new \Illuminate\Database\Migrations\DatabaseMigrationRepository(
            $this->resolver,
            $this->migration_table
        );

        $this->migrator = new \Illuminate\Database\Migrations\Migrator(
            $this->repository,
            $this->resolver,
            $this->file
        );
    }

    protected function getVersion()
    {
        $data = [];
        $packages = json_decode(file_get_contents(ROOT_PATH.'vendor/composer/installed.json'), true);

        foreach ($packages as $package) {
            $data[$package['name']] = $package['version_normalized'];
        }

        return (float) $data['illuminate/database'];
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