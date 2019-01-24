<?php

namespace SlimApp\Artisan;

use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\GeneratorCommand;

class SeederMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  array                              $options
     * @return void
     */
    public function __construct(Filesystem $files, $options)
    {
        parent::__construct($files, $options);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('model')) {
            return __DIR__.'/stubs/seeder.model.stub';
        }
        return __DIR__.'/stubs/seeder.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return APP_PATH.'/database/seeds/'.$name.'.php';
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        return $name;
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

        return $this->replaceNamespace($stub, $name)->replaceModel($stub)->replaceClass($stub, $name);
    }

    /**
     * Replace the model for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceModel(&$stub)
    {
        if ($this->option('model')) {
             $stub = str_replace('DummyModel', $this->option('model'), $stub);
        }

        return $this;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', 'Generate a seeder for the given model.'],
        ];
    }
}
