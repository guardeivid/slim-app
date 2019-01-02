## SlimApp

SlimApp is a bootstrap application built with Slim Framework in MVC architecture, based in SlimStarter
with Laravel's Eloquent as database provider (Model) and Twig as template engine (View).

#### Características
- Slim Framework 3 (https://www.slimframework.com/docs/)
- Twig View (https://github.com/slimphp/Twig-View) (https://twig.symfony.com/doc/2.x/)
- Slim Facades (https://github.com/zhshize/slim-facades)
- Eloquent (https://laravel.com/docs/5.7/database) (https://laravel.com/docs/5.7/eloquent)
- Pagination (https://laravel.com/docs/5.7/pagination)
- Validation (Respect) (https://respect-validation.readthedocs.io/)
- Protection CSRF (https://github.com/slimphp/Slim-Csrf)


### Instalacion

#### 1 Manual Install
You can manually install SlimApp by cloning this repo or download the zip file from this repo, and run ```composer install```.
```
$git clone https://github.com/guardeivid/SlimApp.git .
$composer install
```

#### 2 Install via ```composer create-project```
Alternatively, you can use ```composer create-project``` to install SlimApp without downloading zip or cloning this repo.

```
composer create-project guardeivid/slim-app --stability="dev"
```

#### 3 Configuracion de permisos
After composer finished install the dependencies, you need to change file and folder permission.
```
chmod -R 777 storage/
chmod 666 config/database.php
```
## Directory Structure

### The Root Directory
- The `app` Directory
- The `bootstrap` Directory
- The `config` Directory
- The `public` Directory
- The `src` Directory
- The `storage` Directory
- The `vendor` Directory

### The App Directory
- The `Controllers` Directory
- The `Middelware` Directory
- The `Models` Directory
- The `Validation` Directory
    - The `Exceptions` Directory
    - The `Rules` Directory    
- The `Views` Directory

- The `routes.php` File

### The Bootstrap Directory
- `register.php` File (add service, middleware, etc.)

### The Config Directory
Contains all of your application's configuration files. 
- `aliases`
- `database`
- `slim`
- `twig`
- `validation`

### The Public Directory
The `public` directory contains the index.php file, which is the entry point for all requests entering your application and configures autoloading. This directory also houses your assets such as images, JavaScript, and CSS.

### The Storage Directory
The `storage` directory contains your compiled Twig templates, file based sessions, file caches.

## Configuration
Configuration file of SlimApp located in ```app/config```, edit the database.php, cookie.php and other to match your need

## Routing
Routing configuration is located in ```app/routes.php```, it use Route facade to access underlying Slim router.
If you prefer the 'Slim' way, you can use $app to access Slim instance

Route to closure
```php
Route::get(...)

$app->get(...)



Route::get('/', function(){
    View::display('welcome.twig');
});

/** the Slim way */
$app->get('/', function() use ($app){
    $app->view->display('welcome.twig');
});
```

Route to controller method
```php
/** get method */
Route::get('/', 'SomeController:someMethod');

/** post method */
Route::post('/post', 'PostController:create');

/** put method */
Route::put('/post/:id', 'PostController:update');

/** delete method */
Route::delete('/post/:id', 'PostController:destroy');
```

Route Name
```php
/** route name */
Route::get('/admin', 'AdminController:index')->setName('admin');
```

Route Middleware
```php
/** route middleware */
Route::get('/admin', 'AdminController:index')->add('SomeMiddleware');
```

Route group
```php
/** Route group to book resource */
Route::group('/book', function(){
    Route::get('/', 'BookController:index'); // GET /book
    Route::post('/', 'BookController:store'); // POST /book
    Route::get('/create', 'BookController:create'); // Create form of /book
    Route::get('/:id', 'BookController:show'); // GET /book/:id
    Route::get('/:id/edit', 'BookController:edit'); // GET /book/:id/edit
    Route::put('/:id', 'BookController:update'); // PUT /book/:id
    Route::delete('/:id', 'BookController:destroy'); // DELETE /book/:id
});
```

Route Resource
this will have same effect on route group above like Laravel Route::resource
```php
/** Route to book resource */
Route::resource('/book', 'BookController');
```

RouteController
```php
/** Route to book resource */
Route::controller('/book', 'BookController');

/**
 * GET /book will be mapped to BookController:getIndex
 * POST /book will be mapped to BookController:postIndex
 * [METHOD] /book/[path] will be mapped to BookController:methodPath
 */
```

## Model
Models are located in ```app/models``` directory, since Eloquent is used as database provider, you can write model like you
write model for Laravel, for complete documentation about eloquent, please refer to http://laravel.com/docs/eloquent

file : app/Models/Book.php
```php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Book Extends Model{}
```

## Controller
Controllers are located in ```app/Controllers``` directory, you may extends the *Controller* to get access to predefined helper.
You can also place your controller in namespace to group your controller.

file : app/controllers/HomeController.php
```php
namespace App\Controllers;

use App\Controllers\Controller;
use \View;

class HomeController extends Controller{

    public function welcome(){
        $this->data['title'] = 'Some title';
        View::fetch('home.twig', $this->data);

        return $this->view->render($this->response, 'home.twig', $this->data);
    }
}
```

Controller class have access to differents properties:
- $container
- $request
- $response
- $router
- $db
- $view
- $validator
- $data 

## View
Views file are located in ```app/Views``` directory in twig format, there is home.twig with 'body' block as default master template
shipped with SlimApp that will provide default access to published js variable.

For detailed Twig documentation, please refer to http://twig.sensiolabs.org/documentation


file : app/Views/welcome.twig
```html
{% extends 'home.twig' %}
{% block body %}
    Welcome to SlimApp
{% endblock %}

```

### Rendering view inside controller
If your controller extends the Controller class, you will have access to $data property which will be the placeholder for all
view's data and $view property equal a Facade View::.

```php
View::fetch('welcome.twig', $this->data);
$this->view->fetch('welcome.twig', $this->data);

View::render($this->response, 'home.twig', $this->data);
$this->view->render($this->response, 'home.twig', $this->data);

```

## Validation
If your controller extends the Controller class, you will have access to $validator property which will be the placeholder for all
validations from request. 
[https://respect-validation.readthedocs.io/](https://respect-validation.readthedocs.io/)

```php
$validation = $this->validator->validate($this->request, [
    'name' => v::noWhitespace()->notEmpty()
]);

if ($validation->failed()){
    return $this->response->withRedirect($this->router->pathFor('home'));
}
```

And from the view you can access to `{{ error.property }}`
```html
<div class="form-group{{ errors.email ? ' has-error' : '' }}">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control">
    {% if error.email %}
    <span class="help-block">{{ error.email | first }}</span>
    {% endif %}
</div>
```

Also you can acces to old input in the view `{{ old.property }}`
```html
<div class="form-group{{ errors.email ? ' has-error' : '' }}">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old.email }}">
    {% if error.email %}
    <span class="help-block">{{ error.email | first }}</span>
    {% endif %}
</div>
```

### Custom rules (validation)

Create rules in folder **app\Validation\Rules**

```php
<?php

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{
    public function validate($input)
    {
        // check if email exists
        return User::where('email', $input)->count() === 0;
    }
}
```

And exceptions in folder **app\Validation\Exceptions**

```php
<?php
namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Email not exists',
        ],
    ];
}
```

Use in controller with the class name of the rule (EmailAvailable) -> **emailAvailable()**

```php
$validation = $this->validator->validate($request, [
    'email' => v::noWhitespace()->notEmpty()->emailAvailable()
]);
```

### Translation
In `config/validation.php` you can configure the language to translate for validations exceptions. 

By default it is in Spanish language (translation is not complete) in case there is no translation, it is displayed in English.


```php
$config['translator'] = function($message)
{
    $messages = [
        'All of the required rules must pass for {{name}}' => 'Todas las reglas deben pasar para {{name}}',
        'These rules must pass for {{name}}' => 'Estas reglas deben pasar para {{name}}',
        'None of these rules must pass for {{name}}' => 'Ninguna de éstas reglas deben pasar para {{name}}',
        'These rules must not pass for {{name}}' => 'Estas reglas no deben pasar para {{name}}',

        ....
    ];

    if ($messages[$message]){
        return $messages[$message];        
    }

    return $message; 
};

//To configure English language, uncomment
$config['translator'] = null;
```

## CRSF

There are two way the include crsf in the view

1. Extension Twig
```html
{{ crsf_field() | raw }}
```

2. Middleware
```html
{{ crsf.field | raw }}
```

Register
```php
//If Middleware
$app->add(new \App\Middelware\CsrfViewMiddelware($container));

//And... check 

//Global, for all routes (default)
$app->add($container->csrf);

//or determinate route, (comment global)
$app->get('/', 'Controller:index')->add($container->csrf);
```

## Facades

| Facade  |  Class | Inherit |
|---|---|---|
| Slim  | Slim\App |   |
| Model | Illuminate\Database\Eloquent\Model |   |
| App | SlimFacades\App | Slim\App |
| Container | SlimFacades\Container | Slim\App |
| Log | SlimFacades\Log | (not instance of 'logger') |
| Request | SlimFacades\Request | Slim\Http\Request |
| Settings | SlimFacades\Settings | Slim\App |
| View | SlimFacades\View | Slim\Views\Twig |
| Response | SlimApp\Facade\ResponseFacade | Slim\Http\Response | 
| Route | SlimApp\Facade\RouteFacade | Slim\App |
| Input | SlimApp\Facade\InputFacade | Slim\Http\Request |
| DB | SlimApp\Facade\DatabaseFacade | Illuminate\Database\Capsule\Manager |

```php
use \Slim;
Slim::add($callable); //addMidellware
Slim::redirect($from, $to, $status = 302);
Slim::run();

use \App;
App::add($callable); //addMidellware
App::redirect($from, $to, $status = 302);
App::run();

use \Route; //Router proxy
Route::get($pattern, $callable);
Route::post($pattern, $callable);
Route::put($pattern, $callable);
Route::delete($pattern, $callable);
Route::any($pattern, $callable);
Route::options($pattern, $callable);
Route::patch($pattern, $callable);
Route::group($pattern, $callable);

use \Request;
Request::getMethod();
Request::withMethod();
Request::isMethod($method);
Request::isGet();
Request::isPost();
Request::isPut();
Request::isPatch();
Request::isDelete();
Request::isHead();
Request::isOptions();
Request::isXhr();
Request::getRequestTarget();
Request::withRequestTarget($requestTarget);
Request::getUri();
Request::withUri(UriInterface $uri, $preserveHost = false);
Request::getContentType();
Request::getMediaType();
Request::getMediaTypeParams();
Request::getContentCharset();
Request::getContentLength();
Request::getCookieParams();
Request::getCookieParam($key, $default = null);
Request::withCookieParams(array $cookies);
Request::getQueryParams();
Request::withQueryParams(array $query);
Request::getUploadedFiles();
Request::withUploadedFiles(array $uploadedFiles);
Request::getServerParams();
Request::getServerParam($key, $default = null);
Request::getAttributes();
Request::getAttribute($name, $default = null);
Request::withAttribute($name, $value);
Request::withAttributes(array $attributes);
Request::withoutAttribute($name);
Request::getParsedBody();
Request::withParsedBody($data);
Request::getParam($key, $default = null);
Request::getParsedBodyParam($key, $default = null);
Request::getQueryParam($key, $default = null);
Request::getParams(array $only = null);

use \Response;
Response::getStatusCode();
Response::withStatus($code, $reasonPhrase = '');
Response::withHeader($name, $value);
Response::write($data);
Response::withRedirect($url, $status = null);
Response::withJson($data, $status = null, $encodingOptions = 0);
Response::isEmpty();
Response::isOk();
Response::isSuccessful();
Response::isRedirect();
Response::isRedirection();
Response::isForbidden();
Response::isNotFound();
Response::isClientError();
Response::isServerError();

use \View;
View::fetch($template, $data = []);
View::render(ResponseInterface $response, $template, $data = []);

use \Model;
Model::fill(array $attributes);
Model::forceFill(array $attributes);
Model::all($columns = ['*']);
Model::with($relations);
Model::load($relations);
Model::update(array $attributes = [], array $options = []);
Model::push();
Model::save(array $options = []);
Model::saveOrFail(array $options = []);
Model::destroy($ids);
Model::delete();
Model::query();
Model::newQueryWithoutScopes();
Model::newEloquentBuilder($query);
Model::newCollection(array $models = []);
Model::newPivot(Model $parent, array $attributes, $table, $exists, $using = null);
Model::toArray();
Model::toJson($options = 0);
Model::jsonSerialize();
Model::fresh($with = []);
Model::refresh();
Model::is(Model $model);
Model::isNot(Model $model);
Model::getConnection();
Model::getConnectionName();
Model::setConnection($name);
Model::getTable();
Model::setTable($table);
Model::getKeyName();
Model::setKeyName($key);
Model::getQualifiedKeyName();
Model::getKeyType();
Model::setKeyType($type);
Model::getIncrementing();
Model::setIncrementing($value);
Model::getKey();
Model::getForeignKey();
Model::getPerPage();
Model::setPerPage($perPage);

use \DB;
DB::connection($connection = null);
DB::table($table, $connection = null);
DB::schema($connection = null);
DB::getConnection($name = null);
DB::addConnection(array $config, $name = 'default');
DB::bootEloquent();

DB::select($columns = ['*']);
DB::selectRaw($expression, array $bindings = []);
DB::selectSub($query, $as);
DB::addSelect($column);
DB::distinct();
DB::from($table);
DB::join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false);
DB::joinWhere($table, $first, $operator, $second, $type = 'inner');
DB::leftJoin($table, $first, $operator = null, $second = null);
DB::leftJoinWhere($table, $first, $operator, $second);
DB::rightJoin($table, $first, $operator = null, $second = null);
DB::rightJoinWhere($table, $first, $operator, $second);
DB::crossJoin($table, $first = null, $operator = null, $second = null);
DB::mergeWheres($wheres, $bindings);
DB::where($column, $operator = null, $value = null, $boolean = 'and');
DB::orWhere($column, $operator = null, $value = null);
DB::whereColumn($first, $operator = null, $second = null, $boolean = 'and');
DB::orWhereColumn($first, $operator = null, $second = null);
DB::whereRaw($sql, $bindings = [], $boolean = 'and');
DB::orWhereRaw($sql, $bindings = []);
DB::whereIn($column, $values, $boolean = 'and', $not = false);
DB::orWhereIn($column, $values);
DB::whereNotIn($column, $values, $boolean = 'and');
DB::orWhereNotIn($column, $values);
DB::whereInSub($column, Closure $callback, $boolean, $not);
DB::whereNull($column, $boolean = 'and', $not = false);
DB::orWhereNull($column);
DB::whereNotNull($column, $boolean = 'and');
DB::whereBetween($column, array $values, $boolean = 'and', $not = false);
DB::orWhereBetween($column, array $values);
DB::whereNotBetween($column, array $values, $boolean = 'and');
DB::orWhereNotBetween($column, array $values);
DB::orWhereNotNull($column);
DB::whereDate($column, $operator, $value = null, $boolean = 'and');
DB::orWhereDate($column, $operator, $value);
DB::whereTime($column, $operator, $value, $boolean = 'and');
DB::orWhereTime($column, $operator, $value);
DB::whereDay($column, $operator, $value = null, $boolean = 'and');
DB::whereMonth($column, $operator, $value = null, $boolean = 'and');
DB::whereYear($column, $operator, $value = null, $boolean = 'and');
DB::whereNested(Closure $callback, $boolean = 'and');
DB::forNestedWhere();
DB::addNestedWhereQuery($query, $boolean = 'and');
DB::whereExists(Closure $callback, $boolean = 'and', $not = false);
DB::orWhereExists(Closure $callback, $not = false);
DB::whereNotExists(Closure $callback, $boolean = 'and');
DB::orWhereNotExists(Closure $callback);
DB::addWhereExistsQuery(Builder $query, $boolean = 'and', $not = false);
DB::dynamicWhere($method, $parameters);
DB::groupBy(...$groups);
DB::having($column, $operator = null, $value = null, $boolean = 'and');
DB::orHaving($column, $operator = null, $value = null);
DB::havingRaw($sql, array $bindings = [], $boolean = 'and');
DB::orHavingRaw($sql, array $bindings = []);
DB::orderBy($column, $direction = 'asc');
DB::orderByDesc($column);
DB::latest($column = 'created_at');
DB::oldest($column = 'created_at');
DB::inRandomOrder($seed = '');
DB::orderByRaw($sql, $bindings = []);
DB::skip($value);
DB::offset($value);
DB::take($value);
DB::limit($value);
DB::forPage($page, $perPage = 15);
DB::forPageAfterId($perPage = 15, $lastId = 0, $column = 'id');
DB::union($query, $all = false);
DB::unionAll($query);
DB::lock($value = true);
DB::lockForUpdate();
DB::toSql();
DB::find($id, $columns = ['*']);
DB::value($column);
DB::get($columns = ['*']);
DB::paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null);
DB::simplePaginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null);
DB::getCountForPagination($columns = ['*']);
DB::pluck($column, $key = null);
DB::implode($column, $glue = '');
DB::exists();
DB::count($columns = '*');
DB::min($column);
DB::max($column);
DB::sum($column);
DB::avg($column);
DB::average($column);
DB::aggregate($function, $columns = ['*']);
DB::numericAggregate($function, $columns = ['*']);
DB::insert(array $values);
DB::insertGetId(array $values, $sequence = null);
DB::update(array $values);
DB::updateOrInsert(array $attributes, array $values = []);
DB::increment($column, $amount = 1, array $extra = []);
DB::decrement($column, $amount = 1, array $extra = []);
DB::delete($id = null);
DB::truncate();
DB::raw($value);
DB::getBindings();
DB::getRawBindings();
DB::setBindings(array $bindings, $type = 'where');
DB::addBinding($value, $type = 'where');
DB::mergeBindings(Builder $query);
DB::cleanBindings(array $bindings);
DB::getConnection();
DB::getGrammar();
...

```

### Auxiliar Methods

```php
use \Container;
Container::self(); //Slim\Container

use \Settings;
Settings::get($key = null);
Settings::set($key, $value);

Settings::get('db');

use \Route;
Route::resource();
Route::controller();

use \Response;
Response::json($data, $status = 200);
Response::redirect($url, $status = 200);

Response::redirect('home');

use \Input;
Input::file($name);
Input::get($key, $default = null);
Input::post($key, $default = null);
```

Run 
```sh
 composer dump-autoload -o
```