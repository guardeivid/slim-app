<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use SlimApp\Artisan\GeneratorCommand;

class FreshCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables and re-run all migrations';

    /**
     * Fresh a migration command instance.
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

        $database = $this->option('database');

        try {
            if ($this->option('drop-views')) {
                $this->dropAllViews($database);

                $this->note[] = '<info>Dropped all views successfully.</info>';
            }

            $this->dropAllTables($database);

            $this->note[] = '<info>Dropped all tables successfully.</info>';
        }
        catch (\Exception $e) {
            $this->note[] = "<critical>".$e->getMessage()."</critical>";
        }

        $this->call('migrate', array_filter([
            'database' => $database,
            'path' => $this->option('path'),
            'realpath' => $this->option('realpath'),
            'force' => true,
            'step' => $this->option('step'),
        ]));

        if ($this->needsSeeding()) {
            $this->runSeeder($database);
        }

        $this->note = $this->getNotes();
    }

    /**
     * Drop all of the database tables.
     *
     * @param  string  $database
     * @return void
     */
    protected function dropAllTables($database)
    {
        $this->resolver->connection($database)
                    ->getSchemaBuilder()
                    ->dropAllTables();
    }

    /**
     * Drop all of the database views.
     *
     * @param  string  $database
     * @return void
     */
    protected function dropAllViews($database)
    {
        $this->resolver->connection($database)
                    ->getSchemaBuilder()
                    ->dropAllViews();
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
        $this->call('db:seed', array_filter([
            'database' => $database,
            'class' => $this->option('seeder') ?: 'DatabaseSeeder',
            'force' => true,
        ]));
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, 'The database connection to use'],

            ['drop-views', null, 'Drop all tables and views'],

            ['force', null, 'Force the operation to run when in production'],

            ['path', null, 'The path to the migrations files to be executed'],

            ['realpath', null, 'Indicate any provided migration file paths are pre-resolved absolute paths'],

            ['seed', null, 'Indicates if the seed task should be re-run'],

            ['seeder', null, 'The class name of the root seeder'],

            ['step', null, 'Force the migrations to be run so they can be rolled back individually'],
        ];
    }
}
