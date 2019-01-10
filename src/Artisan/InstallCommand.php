<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use SlimApp\Artisan\GeneratorCommand;

class InstallCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the migration repository';

    /**
     * The repository instance.
     *
     * @var \Illuminate\Database\Migrations\MigrationRepositoryInterface
     */
    protected $repository;

    /**
     * Create a new migration install command instance.
     *
     * @param  \Illuminate\Database\Migrations\MigrationRepositoryInterface  $repository
     * @return void
     */
    public function __construct(MigrationRepositoryInterface $repository, $options)
    {
        $this->repository = $repository;

        parent::__construct(null, $options);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->repository->setSource($this->option('database'));

        $this->repository->createRepository();

        $this->note[] = '<info>Migration table created successfully.</info>';
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
        ];
    }
}
