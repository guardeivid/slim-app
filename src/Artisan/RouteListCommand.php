<?php

namespace SlimApp\Artisan;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Slim\Route;
use Slim\Router;
use SlimApp\Artisan\GeneratorCommand;

class RouteListCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registered routes';

    /**
     * The router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * An array of all the registered routes.
     *
     * @var \Illuminate\Routing\RouteCollection
     */
    public $routes;

    /**
     * The table headers for the command.
     *
     * @var array
     */
    public $headers = ['Method', 'URI', 'Name', 'Action'];

    /**
     * Create a new route command instance.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function __construct(Router $router, $options)
    {
        $this->router = $router;
        $this->routes = $router->getRoutes();

        parent::__construct(null, $options);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (count($this->routes) === 0) {
            $this->note[] = "<error>Your application doesn't have any routes.</error>";
            return;
        }

        //$this->displayRoutes($this->getRoutes());
        $this->note[] = $this->displayRoutes($this->getRoutes());
    }

    /**
     * Compile the routes into a displayable format.
     *
     * @return array
     */
    protected function getRoutes()
    {
        //var_dump(collect($this->routes));
        //die();

        $collect = new Collection($this->routes);

        $routes = $collect->map(function ($route) {
            return $this->getRouteInformation($route);
        })->all();

        if ($sort = $this->option('sort')) {
            $routes = $this->sortRoutes($sort, $routes);
        }

        if ($this->option('reverse')) {
            $routes = array_reverse($routes);
        }

        return array_filter($routes);
    }

    /**
     * Get the route information for a given route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        return $this->filterRoute([
            'method' => implode('|', $route->getMethods()),
            'uri'    => $route->getPattern(),
            'name'   => $route->getName(),
            'action' => $this->getAction($route),
        ]);
    }

    protected function getAction($route)
    {
        $action = $route->getCallable() instanceof Closure ? 'Closure' : $route->getCallable();

        return $action;
    }

    /**
     * Sort the routes by a given element.
     *
     * @param  string  $sort
     * @param  array  $routes
     * @return array
     */
    protected function sortRoutes($sort, $routes)
    {
        return Arr::sort($routes, function ($route) use ($sort) {
            return $route[$sort];
        });
    }

    /**
     * Display the route information on the console.
     *
     * @param  array  $routes
     * @return void
     */
    protected function displayRoutes(array $routes)
    {
        $table = "<table class='table'><thead><tr>";

        foreach ($this->headers as $header) {
            $table .= "<th> $header </th>";
        }

        $table .= "</tr></thead><tbody>";

        foreach ($routes as $route) {
            $table .= "<tr><td>".$route['method']."</td>";
            $table .= "<td>".$route['uri']."</td>";
            $table .= "<td>".$route['name']."</td>";
            $table .= "<td>".$route['action']."</td></tr>";
        }

        $table .= "</tbody></table>";

        return $table;
    }

    /**
     * Filter the route by URI and / or name.
     *
     * @param  array  $route
     * @return array|null
     */
    protected function filterRoute(array $route)
    {
        if (($this->option('name') && ! Str::contains($route['name'], $this->option('name'))) ||
             $this->option('path') && ! Str::contains($route['uri'], $this->option('path')) ||
             $this->option('method') && ! Str::contains($route['method'], strtoupper($this->option('method')))) {
            return;
        }

        return $route;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['method', null, 'Filter the routes by method'],

            ['name', null, 'Filter the routes by name'],

            ['path', null, 'Filter the routes by path'],

            ['reverse', 'r', 'Reverse the ordering of the routes'],

            ['sort', null, 'The column (host, method, uri, name, action, middleware) to sort by', 'uri'],
        ];
    }
}
