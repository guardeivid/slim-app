<?php

namespace SlimApp\Artisan;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\GeneratorCommand;
use SlimApp\Artisan\ControllerMakeCommand;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('all')) {
            $this->setOption('factory', true);
            $this->setOption('migration', true);
            $this->setOption('controller', true);
            $this->setOption('resource', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('controller') || $this->option('resource')) {
            $this->createController();
        }
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->option('name')));

        /*$this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
        ]);*/
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->option('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        /*$this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);*/
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->option('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', [
            'name' => "{$controller}Controller",
            '--model' => $this->option('resource') ? $modelName : null,
        ]);

        $a = new ControllerMakeCommand(new Filesystem, [
            'name'      => "{$controller}Controller",
            'model'     => $this->option('resource') ? $modelName : null,
            'resource'  => $this->option('resource') ? true : null,
            'force'     => $this->option('force'),
        ]);

        if ($a->info) {
            $this->info[] = $a->info;
        }

        if ($a->error) {
            $this->error[] = $a->error;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__.'/stubs/pivot.model.stub';
        }

        return __DIR__.'/stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', 'Generate a migration, factory, and resource controller for the model'],

            ['controller', 'c', 'Create a new controller for the model'],

            ['factory', 'f', 'Create a new factory for the model'],

            ['force', null, 'Create the class even if the model already exists'],

            ['migration', 'm', 'Create a new migration file for the model'],

            ['pivot', 'p', 'Indicates if the generated model should be a custom intermediate table model'],

            ['resource', 'r', 'Indicates if the generated controller should be a resource controller'],
        ];
    }
}
