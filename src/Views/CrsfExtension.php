<?php

namespace SlimApp\Views;

use Slim\Csrf\Guard;

class CrsfExtension extends \Twig_Extension
{
    /**
     * @var \Slim\Interfaces\RouterInterface
     */
    private $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('crsf_field', array($this, 'crsfField')),
        ];
    }

    public function crsfField()
    {
        return '
        <input type="hidden" name="' . $this->guard->getTokenNameKey() . '" id="input " class="form-control" value="' . $this->guard->getTokenName() . '">
        <input type="hidden" name="' . $this->guard->getTokenValueKey() . '" id="input " class="form-control" value="' . $this->guard->getTokenValue() . '">
        ';
    }
}
