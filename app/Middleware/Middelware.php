<?php

namespace App\Middelware;

use Psr\Container\ContainerInterface;

class Middelware
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}