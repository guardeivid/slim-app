<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\MigrationCreator as Migration;
use SlimApp\Artisan\SchemaParser;
use SlimApp\Artisan\SyntaxBuilder;

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
            return $this->files->get($this->stubPath().'/migration.blank.stub');
        }

        $stub = $create ? 'migration.create.stub' : 'migration.update.stub';

        if ($this->option('custom')) {
            $stub = 'migration.custom.stub';
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

        if ($this->option('custom')) {
            if ($schema = $this->option('schema')) {
                $schema = (new SchemaParser)->parse($schema);
            }
            $schema = (new SyntaxBuilder)->create($schema, $this->option('action'), $table);
            $stub = str_replace(['DummySchemaUp', 'DummySchemaDown'], $schema, $stub);
        }

        if (! is_null($table)) {
            $stub = str_replace('DummyTable', $table, $stub);
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