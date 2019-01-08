<?php

namespace SlimApp\Artisan;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\ControllerMakeCommand;
use SlimApp\Artisan\MigrationCreator;
use SlimApp\Artisan\MigrateMakeCommand;
use SlimApp\Artisan\ModelMakeCommand;
use SlimApp\Artisan\SeedCommand;

/*abstract */class GeneratorCommand
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    public $info = [];
    public $error = [];

    protected $path;

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files = null, $options = [])
    {
        $this->files = $files;
        $this->options = $options;

        $this->handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    /*abstract protected function getStub();*/

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($this->getNameInput())) {
            $this->error[] = $this->type.' already exists!';

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info[] = $this->type.' created successfully.';
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
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
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($this->qualifyClass($rawName)));
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return APP_PATH.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->getNamespace($name), $this->rootNamespace(), \App\User::class],
            $stub
        );

        return $this;
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyClass', $class, $stub);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->option('name'));
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'App\\';
    }

    /**
     * Get the value of a command option.
     *
     * @param  string|null  $key
     * @return string|array|null
     */
    public function option($key)
    {
        return $this->options[$key];
    }

    /**
     * Determine if the given option is present.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasOption($name)
    {
        return $this->options[$name] ? true : false;
    }

    /**
     * Set the value of a command option.
     *
     * @param  string|null  $key
     * @param  mix          $value
     * @return string|array|null
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    public function call($command, $options)
    {
        $a = [];

        if ($command == 'make:controller') {
            $a = new ControllerMakeCommand($this->files, $options);
        } elseif ($command == 'make:migration') {
            $a = new MigrateMakeCommand(new MigrationCreator($this->files), $this->files, $options);
        } elseif ($command == 'make:model') {
            $a = new ModelMakeCommand($this->files, $options);
        } elseif ($command == 'make:factory') {
            //$a = new FactoryMakeCommand($this->files, $options);
        } elseif ($command == 'db:seed') {
            $a = new SeedCommand($this->resolver, $options);
        }

        if (isset($a)) {
            if ($a->info) {
                $this->info[] = $a->info[0];
            }

            if ($a->error) {
                $this->error[] = $a->error[0];
            }
        }
    }


    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getMigrationPaths()
    {
        // Here, we will check to see if a path option has been defined. If it has we will
        // use the path relative to the root of the installation folder so our database
        // migrations may be run for any customized path from within the application.
        if ($this->hasOption('path') && $this->option('path')) {
            return collect($this->option('path'))->map(function ($path) {
                return ! $this->usingRealPath()
                                ? ROOT_PATH.'/'.$path
                                : $path;
            })->all();
        }
        return array_merge(
            $this->migrator->paths(), [$this->getMigrationPath()]
        );
    }
    /**
     * Determine if the given path(s) are pre-resolved "real" paths.
     *
     * @return bool
     */
    protected function usingRealPath()
    {
        return $this->hasOption('realpath') && $this->option('realpath');
    }
    /**
     * Get the path to the migration directory.
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        return ROOT_PATH.'database'.DIRECTORY_SEPARATOR.'migrations';
    }

}
