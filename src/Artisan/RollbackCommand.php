<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\Migrator;
use SlimApp\Artisan\GeneratorCommand;

class RollbackCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the last database migration';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * Create a new migration rollback command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator  $migrator
     * @return void
     */
    public function __construct(Migrator $migrator, $options)
    {
        $this->migrator = $migrator;

        parent::__construct(null, $options);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $this->migrator->setConnection($this->option('database'));

        $this->migrator->rollback(
            $this->getMigrationPaths(), [
                'pretend' => $this->option('pretend'),
                'step' => (int) $this->option('step'),
            ]
        );

        // Once the migrator has run we will grab the note output and send it out to
        // the console screen, since the migrator itself functions without having
        // any instances of the OutputInterface contract passed into the class.
        $this->note = $this->getNotes();
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

            ['pretend', null, 'Dump the SQL queries that would be run.'],

            ['step', null, 'The number of migrations to be reverted.'],
        ];
    }
}
