<?php

namespace SlimApp\Artisan;

use InvalidArgumentException;

abstract class Seeder
{

    protected $note = [];

    /**
     * Seed the given connection from the given path.
     *
     * @param  string  $class
     * @return void
     */
    public function call($class)
    {
        $this->note[] = "<info>Seeding:</info> $class";

        $this->resolve($class)->__invoke();
    }

    /**
     * Resolve an instance of the given seeder class.
     *
     * @param  string  $class
     * @return \Illuminate\Database\Seeder
     */
    protected function resolve($class)
    {
        return new $class;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function __invoke()
    {
        if (! method_exists($this, 'run')) {
            throw new InvalidArgumentException('Method [run] missing from '.get_class($this));
        }

        return $this->run();
    }

    public function getNotes()
    {
        return $this->note;
    }
}
