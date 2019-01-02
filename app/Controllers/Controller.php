<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

class Controller
{
    
    protected $container;

    protected $data;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        //db
        $this->db;

        $this->data = array();

        /** default title */
        $this->data['title'] = '';

        /** prepared message info */
        $this->data['message'] = array(
            'error'    => array(),
            'info'    => array(),
            'debug'    => array(),
        );

        /** global javascript var */
        $this->data['global'] = array();

        /** base dir for asset file */
        $this->data['baseUrl']  = $this->baseUrl();
        $this->data['assetUrl'] = $this->data['baseUrl'].'assets/';
        $this->data['nodeUrl'] = $this->data['baseUrl'].'assets/node_modules/';

    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    /**
     * addMessage to be viewd in the view file
     */
    protected function message($message, $type='info')
    {
        $this->data['message'][$type] = $message;
    }

    /**
     * register global variable to be accessed via javascript
     */
    protected function publish($key,$val)
    {
        $this->data['global'][$key] =  $val;
    }

    /**
     * remove published variable from registry
     */
    protected function unpublish($key)
    {
        unset($this->data['global'][$key]);
    }

    /**
     * generate base URL
     */
    protected function baseUrl()
    {
        $baseUrl = $this->request->getUri()->getBaseUrl();
        $baseUrl = trim($baseUrl, '/');
        return $baseUrl . '/';
    }

    /**
     * generate siteUrl
     */
    protected function siteUrl($path, $includeIndex = false)
    {
        $path = trim($path, '/');
        return $this->data['baseUrl'] . $path;
    }
}