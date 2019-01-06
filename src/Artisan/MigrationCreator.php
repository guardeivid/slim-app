<?php

namespace SlimApp\Artisan;

use Illuminate\Database\Migrations\MigrationCreator as Migration;

class MigrationCreator extends Migration
{

    /**
     * Get the path to the stubs.
     *
     * @return string
     */
    public function stubPath()
    {
        return __DIR__.'/stubs';
    }
}