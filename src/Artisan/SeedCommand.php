<?php

namespace SlimApp\Artisan;

use \ReflectionClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use SlimApp\Artisan\GeneratorCommand;
use App\database\seeds\DatabaseSeeder;

class SeedCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with records';

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * Create a new database seed command instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface  $resolver
     * @param  array                                             $options
     * @return void
     */
    public function __construct(Resolver $resolver, array $options)
    {
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
        $this->resolver->setDefaultConnection($this->getDatabase());

        Model::unguarded(function () {
            $this->getSeeder()->__invoke();
            $this->note = array_merge($this->note, $this->seeder->getNotes());
        });
    }

    /**
     * Get a seeder instance from the container.
     *
     * @return \Illuminate\Database\Seeder
     */
    protected function getSeeder()
    {
        $class = $this->option('class') ?: 'DatabaseSeeder';
        $class != 'DatabaseSeeder' ? $this->note[] = "<info>Seeding:</info> $class" : null;

        $reflection = new ReflectionClass("App\\database\\seeds\\" . $class);

        $this->seeder = $reflection->newInstance();
        return $this->seeder;
    }

    /**
     * Get the name of the database connection to use.
     *
     * @return string
     */
    protected function getDatabase()
    {
        $database = $this->option('database');

        return $database ?: $this->resolver->getDefaultConnection();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['class', null, 'The class name of the root seeder', 'DatabaseSeeder'],

            ['database', null, 'The database connection to seed'],

            ['force', null, 'Force the operation to run when in production'],
        ];
    }
}
