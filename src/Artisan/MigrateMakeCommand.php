<?php

namespace SlimApp\Artisan;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use SlimApp\Artisan\MigrationCreator;
use SlimApp\Artisan\GeneratorCommand;

class MigrateMakeCommand extends GeneratorCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--custom : Indicate if is custom migration}
        {--schema= : The schema to migrate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

    const CREATE_PATTERNS = [
        '/^create_(\w+)_table$/',
        '/^create_(\w+)$/',
    ];
    const CHANGE_PATTERNS = [
        '/_(to|from|in)_(\w+)_table$/',
        '/_(to|from|in)_(\w+)$/',
    ];

    /**
     * The migration creator instance.
     *
     * @var \Illuminate\Database\Migrations\MigrationCreator
     */
    protected $creator;

    /**
     * Create a new migration install command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files file
     * @return void
     */
    public function __construct(Filesystem $files, $options)
    {
        $this->creator = new MigrationCreator($files, $options);

        parent::__construct($files, $options);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // It's possible for the developer to specify the tables to modify in this
        // schema operation. The developer may also specify if this table needs
        // to be freshly created so we can create the appropriate migrations.
        $name = Str::snake(trim($this->option('name')));

        $table = $this->option('table');

        $create = $this->option('create') ?: false;

        // If no table was given as an option but a create option is given then we
        // will use the "create" option as the table name. This allows the devs
        // to pass a table name into this option as a short-cut for creating.
        if (! $table && is_string($create)) {
            $table = $create;

            $create = true;
        }

        // Next, we will attempt to guess the table name if this the migration has
        // "create" in the name. This will allow us to provide a convenient way
        // of creating migrations that create new tables for the application.
        if (! $table) {
            //[$table, $create] = $this->guess($name);
            list($table, $create) = $this->guess($name);
        }

        // Now we are ready to write the migration out to disk. Once we've written
        // the migration out, we will dump-autoload for the entire framework to
        // make sure that the migrations are registered by the class loaders.
        $this->writeMigration($name, $table, $create);
    }

    /**
     * Write the migration file to disk.
     *
     * @param  string  $name
     * @param  string  $table
     * @param  bool    $create
     * @return string
     */
    protected function writeMigration($name, $table, $create)
    {
        $file = pathinfo($this->creator->create(
            $name, $this->getMigrationPath(), $table, $create
        ), PATHINFO_FILENAME);

        $this->info[] = "Created Migration: {$file}";
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        if (! is_null($targetPath = $this->option('path'))) {
            return ! $this->usingRealPath()
                            ? ROOT_PATH . $targetPath
                            : $targetPath;
        }

        //Get the path to the migration directory.
        return APP_PATH.'database'.DIRECTORY_SEPARATOR.'migrations';
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
     * Attempt to guess the table name and "creation" status of the given migration.
     *
     * @param  string  $migration
     * @return array
     */
    public static function guess($migration)
    {
        foreach (self::CREATE_PATTERNS as $pattern) {
            if (preg_match($pattern, $migration, $matches)) {
                return [$matches[1], $create = true];
            }
        }
        foreach (self::CHANGE_PATTERNS as $pattern) {
            if (preg_match($pattern, $migration, $matches)) {
                return [$matches[2], $create = false];
            }
        }
    }

}
