<?php

session_cache_limiter(false);
session_start();

define('ROOT_PATH'  , __DIR__ . '/../');
define('VENDOR_PATH', __DIR__ . '/../vendor/');
define('APP_PATH'   , __DIR__ . '/../app/');
define('PUBLIC_PATH', __DIR__ . '/../public/');

require VENDOR_PATH .'autoload.php';

/**
 * Load the configuration
 */
$config = array(
    'path.root'     => ROOT_PATH,
    'path.public'   => PUBLIC_PATH,
    'path.app'      => APP_PATH
);

foreach (glob(ROOT_PATH . 'config/*.php') as $configFile) {
    require $configFile;
}

/**
 * Initialize Slim and SlimApp application
 */
$app        = new \Slim\App($config['slim']);
$starter    = new \SlimApp\Bootstrap($app);

$starter->setConfig($config);

$starter->boot();

$container = $app->getContainer();

require ROOT_PATH . 'bootstrap/register.php';

/** Start the route */
require APP_PATH . 'routes.php';

return $starter;
