<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use SlimApp\Artisan\GeneratorCommand;

class RefreshCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset and re-run all migrations';

    /**
     * Refresh a migration command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator         $migrator
     * @param  \Illuminate\Database\ConnectionResolverInterface $resolver
     * @param  array                                            $options
     * @return void
     */
    public function __construct(Migrator $migrator, Resolver $resolver, array $options)
    {
        $this->migrator = $migrator;
        $this->resolver = $resolver;

        parent::__construct(null, $options);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        // Next we'll gather some of the options so that we can have the right options
        // to pass to the commands. This includes options such as which database to
        // use and the path to use for the migration. Then we'll run the command.
        $database = $this->option('database');

        $path = $this->option('path');

        $force = $this->option('force');

        // If the "step" option is specified it means we only want to rollback a small
        // number of migrations before migrating again. For example, the user might
        // only rollback and remigrate the latest four migrations instead of all.
        $step = $this->option('step') ?: 0;

        if ($step > 0) {
            $this->runRollback($database, $path, $step, $force);
        } else {
            $this->runReset($database, $path, $force);
        }

        // The refresh command is essentially just a brief aggregate of a few other of
        // the migration commands and just provides a convenient wrapper to execute
        // them in succession. We'll also see if we need to re-seed the database.
        $this->call('migrate', [
            'database' => $database,
            'path' => $path,
            'force' => $force,
        ]);

        if ($this->needsSeeding()) {
            $this->runSeeder($database);
        }

        $this->note = $this->getNotes();
    }

    /**
     * Run the rollback command.
     *
     * @param  string  $database
     * @param  string  $path
     * @param  bool  $step
     * @param  bool  $force
     * @return void
     */
    protected function runRollback($database, $path, $step, $force)
    {
        $this->call('migrate:rollback', [
            'database' => $database,
            'path' => $path,
            'step' => $step,
            'force' => $force,
        ]);
    }

    /**
     * Run the reset command.
     *
     * @param  string  $database
     * @param  string  $path
     * @param  bool  $force
     * @return void
     */
    protected function runReset($database, $path, $force)
    {
        $this->call('migrate:reset', [
            'database' => $database,
            'path' => $path,
            'force' => $force,
        ]);
    }

    /**
     * Determine if the developer has requested database seeding.
     *
     * @return bool
     */
    protected function needsSeeding()
    {
        return $this->option('seed') || $this->option('seeder');
    }

    /**
     * Run the database seeder command.
     *
     * @param  string  $database
     * @return void
     */
    protected function runSeeder($database)
    {
        $this->call('db:seed', [
            'database' => $database,
            'class' => $this->option('seeder') ?: 'DatabaseSeeder',
            'force' => $this->option('force'),
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, 'The database connection to use.'],

            ['force', null, 'Force the operation to run when in production.'],

            ['path', null, 'The path of migrations files to be executed.'],

            ['seed', null, 'Indicates if the seed task should be re-run.'],

            ['seeder', null, 'The class name of the root seeder.'],

            ['step', null, 'The number of migrations to be reverted & re-run.'],
        ];
    }
}
