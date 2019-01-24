<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\MigrationCreator as Migration;

class MigrationCreator extends Migration
{

    /**
     * Create a new migration creator instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files, $options = [])
    {
        $this->files = $files;
        $this->options = $options;
    }

    /**
     * Get the migration stub file.
     *
     * @param  string  $table
     * @param  bool    $create
     * @return string
     */
    protected function getStub($table, $create)
    {
        if (is_null($table)) {
            return $this->files->get($this->stubPath().'/blank.stub');
        }

        $stub = $create ? 'create.stub' : 'update.stub';

        if ($this->option('custom')) {
            $stub = str_replace('.stub', '.custom.stub', $stub);
        }

        return $this->files->get($this->stubPath()."/{$stub}");
    }

    /**
     * Get the path to the stubs.
     *
     * @return string
     */
    public function stubPath()
    {
        return __DIR__.'/stubs';
    }

    /**
     * Populate the place-holders in the migration stub.
     *
     * @param  string  $name
     * @param  string  $stub
     * @param  string  $table
     * @return string
     */
    protected function populateStub($name, $stub, $table)
    {
        $stub = str_replace('DummyClass', $this->getClassName($name), $stub);

        if (! is_null($table)) {
            $stub = str_replace('DummyTable', $table, $stub);
        }

        if ($this->option('custom')) {
            //$stub = str_replace('.stub', '.custom.stub', $stub);
        }

        return $stub;
    }

    /**
     * Get the value of a command option.
     *
     * @param  string|null  $key
     * @return string|array|null
     */
    protected function option($key)
    {
        return $this->options[$key];
    }
}