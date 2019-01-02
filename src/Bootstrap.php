<?php

namespace SlimApp;

use \Illuminate\Database\Capsule\Manager as DatabaseManager;
use \SlimFacades\Facade;
use Respect\Validation\Validator as v;

/**
 * SlimApp Bootstrapper, initialize all the thing needed on the start
 */
class Bootstrap
{
    protected $app;
    protected $config;
    protected $container;

    /**
     * SlimApp Bootstrap constructor
     * @param \Slim\App $app
     */
    public function __construct(\Slim\App $app = null){
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    /**
     * Setup SlimApp configuration and inject it to Slim instance
     * @param array $config
     */
    public function setConfig($config){
        $this->config = $config;
        //foreach ($config as $key => $value) {
        //    $this->app->config($key, $value);
        //}
    }

    /**
     * Setting up slim instance for slim app
     * @param SlimApp $app [description]
     */
    public function setApp(\Slim\App $app){
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    /**
     * Boot up Slim Facade accessor
     * @param  Array $config
     */
    public function bootFacade($config){
        Facade::setFacadeApplication($this->app);
        $this->registerAliases($config);
    }

    public function registerAliases($aliases = null)
    {
        if (!$aliases) {
            $aliases = [
                'App'       => 'SlimFacades\App',
                'Container' => 'SlimFacades\Container',
                'Log'       => 'SlimFacades\Log',
                'Request'   => 'SlimFacades\Request',
                'Response'  => 'SlimFacades\Response',
                'Route'     => 'SlimFacades\Route',
                'Settings'  => 'SlimFacades\Settings',
                'View'      => 'SlimFacades\View',
            ];
        }
        foreach ($aliases as $alias => $class) {
            class_alias($class, $alias);
        }
    }

    /**
     * Boot up Eloquent ORM and inject to Slim container
     * @param  Array $config
     */
    public function bootEloquent($config)
    {
        try{
            $this->container['db'] = function($c) use ($config){
                $capsule = new \Illuminate\Database\Capsule\Manager;
                $capsule->addConnection(
                    $config['connections'][$config['default']]
                );

                $capsule->setAsGlobal();
                $capsule->bootEloquent();

                return $capsule;
            };

        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Boot up Eloquent ORM Pagination and inject to Slim container
     * @param  Array $config
     */
    public function bootPagination(){
        $container = $this->container;
        \Illuminate\Pagination\Paginator::currentPageResolver(
            function ($pageName = 'page') use ($container) {
                $page = $container->request->getParam($pageName);

                if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                    return $page;
                }
                return 1;
            }
        );
    }

    function bootCsrf()
    {
        // add Slim CSRF
        $this->container['csrf'] = function($c){
            return new \Slim\Csrf\Guard;
        };
    }

    /**
     * Boot up Twig template engine
     * @param  Array $config
     */
    public function bootTwig($config)
    {
        // Register component on container
        $this->container['view'] = function ($c) use ($config) {
            $view = new \Slim\Views\Twig(
                [
                    ROOT_PATH . 'src/Artisan/views',
                    $c['settings']['viewTemplatesDirectory']
                ], 
                $config
            );

            // Instantiate and add Slim specific extension
            $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
            $view->addExtension(
                new \Slim\Views\TwigExtension(
                    $c->get('router'), 
                    $uri
                )
            );

            $view->addExtension(
                new \SlimApp\Views\CrsfExtension(
                    $c->get('csrf'))
            );

            return $view;
        };
    }

    public function bootValidator($translator)
    {
        $this->container['validator'] = function($c) use ($translator)
        {
            return new \App\Validation\Validator($translator);
        };

        // setup custom rules
        v::with('App\\Validation\\Rules\\');
    }

    /**
     * Run the boot sequence
     * @return [type] [description]
     */
    public function boot()
    {
        $this->bootFacade($this->config['aliases']);
        $this->bootEloquent($this->config['database']);
        $this->bootPagination();
        $this->bootValidator($this->config['translator']);
        $this->bootCsrf();
        $this->bootTwig($this->config['twig']);
    }

    /**
     * Run the Slim application
     */
    public function run()
    {
        $this->app->run();
    }
}