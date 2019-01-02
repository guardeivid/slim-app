<?php

$config['aliases'] = array(
    'Slim'      => 'Slim\App',
    'Model'     => 'Illuminate\Database\Eloquent\Model',
    'App'       => 'SlimFacades\App',
    'Container' => 'SlimFacades\Container',
    'Log'       => 'SlimFacades\Log',
    'Request'   => 'SlimFacades\Request',
    //'Response'  => 'SlimFacades\Response',
    //'Route'     => 'SlimFacades\Route',
    'Settings'  => 'SlimFacades\Settings',
    'View'      => 'SlimFacades\View',
    'Response'  => 'SlimApp\Facade\ResponseFacade',
    'Route'     => 'SlimApp\Facade\RouteFacade',
    'Input'     => 'SlimApp\Facade\InputFacade',
    'DB'        => 'SlimApp\Facade\DatabaseFacade',
);