<?php

namespace SlimApp\Facade;

class InputFacade extends \SlimFacades\Facade
{
    protected static function getFacadeAccessor() { return 'request'; }

    public static function file($name)
    {
        return isset($_FILES[$name]) && $_FILES[$name]['size'] ? $_FILES[$name] : null;
    }

    public static function get($key, $default = null)
    {
        return static::self()->getQueryParam($key, $default);
    }

    public static function post($key, $default = null)
    {
        return static::self()->getParsedBodyParam($key, $default);
    }
}