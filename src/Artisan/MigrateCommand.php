<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use SlimApp\Artisan\GeneratorCommand;

class MigrateCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate {--database= : The database connection to use}
                {--force : Force the operation to run when in production}
                {--path= : The path to the migrations files to be executed}
                {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
                {--pretend : Dump the SQL queries that would be run}
                {--seed : Indicates if the seed task should be re-run}
                {--step : Force the migrations to be run so they can be rolled back individually}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database migrations';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * Create a new migration command instance.
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
        $this->prepareDatabase();

        // Next, we will check to see if a path option has been defined. If it has
        // we will use the path relative to the root of this installation folder
        // so that migrations may be run for any path within the applications.
        $migrations = $this->migrator->run(
            $this->getMigrationPaths(),
            [
                'pretend' => $this->option('pretend'),
                'step' => $this->option('step'),
            ]
        );

        var_dump($migrations);
        var_dump($this->migrator->getNotes());

        // Finally, if the "seed" option has been given, we will re-run the database
        // seed task to re-populate the database, which is convenient when adding
        // a migration and a seed at the same time, as it is only this command.
        if ($this->option('seed') && ! $this->option('pretend')) {
            //$this->call('db:seed', ['--force' => true]);
        }
    }

    /**
     * Prepare the migration database for running.
     *
     * @return void
     */
    protected function prepareDatabase()
    {
        //$this->migrator->setConnection($this->option('database'));

        if (! $this->migrator->repositoryExists()) {
            $repository = $this->migrator->getRepository();
            $repository->createRepository();
            $this->info[] = 'Migration table created successfully.';
        }
    }
}
