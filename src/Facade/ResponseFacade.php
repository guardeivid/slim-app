<?php

namespace SlimApp\Facade;

class ResponseFacade extends \SlimFacades\Response
{
    
    protected static function getFacadeAccessor() { return 'response'; }

    public static function json($data, $status = 200)
    {
        //$container = self::$app->getContainer();
        $response = static::self();

        $response->withHeader('Content-Type', 'application/json');
        $response->withStatus($status);

        if($data instanceof \Illuminate\Support\Contracts\JsonableInterface){
            return $response->withJson($data->toJson());
        }else{
            return $response->withJson($data);
        }

    }

    public static function redirect($url, $status = 200)
    {
        return static::self()->withStatus($status)->withHeader('Location', $url);
    }
}