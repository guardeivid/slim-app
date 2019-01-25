<?php
/**
 * Based in Laravel-5-Generators-Extended
 * https://github.com/laracasts/Laravel-5-Generators-Extended
 */
namespace SlimApp\Artisan;

class GeneratorException extends \Exception
{
    /**
     * The exception description.
     *
     * @var string
     */
    protected $message = 'Could not determine what you are trying to do. Sorry! Check your migration name.';
}
