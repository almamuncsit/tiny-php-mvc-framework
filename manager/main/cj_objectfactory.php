<?php

class CJ_ObjectFactory
{

    private $url = array();
    private $controller = DEFAULT_CONTROLLER;
    private $method = DEFAULT_METHOD;
    private $parameters = array();
    private $count = 0;
    private $error;

    public function __construct($url)
    {
        $this->url = $url;
        if (!empty($this->url[0])) {
            $this->count = count($url);
        }
        $this->error = new CJ_Error();
    }

    /*
     * ****************************************************
     * Call Object if Only one Element is given
     * ****************************************************
     */

    private function firstObject()
    {
        $this->controller = $this->url[0];
        $location = 'controllers' . DS . $this->controller;
        if (is_dir(_APPLICATION_ . DS . $location)) {
            $this->controller = DEFAULT_CONTROLLER;
            $location = $location . DS . $this->controller;
        }
        $this->addFile($location);
    }

    /*
     * ****************************************************
     * Call Object if Two Element is given
     * ****************************************************
     */

    private function secondObject()
    {
        $this->controller = $this->url[0];
        $location = 'controllers' . DS . $this->controller;

        if (is_dir(_APPLICATION_ . DS . $location)) {
            $this->controller = $this->url[1];
            $location = $location . DS . $this->controller;
        } else {
            $this->method = $this->url[1];
        }
        $this->addFile($location);
    }

    /*
     * ****************************************************
     * Call Object if more then two element is given 
     * ****************************************************
     */

    private function thirdObject()
    {
        $this->controller = $this->url[0];
        $location = 'controllers' . DS . $this->controller;

        if (is_dir(_APPLICATION_ . DS . $location)) {
            $this->controller = $this->url[1];
            $this->method = $this->url[2];
            $location = $location . DS . $this->controller;
        } else {
            $this->method = $this->url[1];
            $this->parameters = array_slice($this->url, 2);
        }
        $this->addFile($location);
    }

    /*
     * ****************************************************
     * Call Object if more then two element is given 
     * ****************************************************
     */

    private function othersObject()
    {
        $this->controller = $this->url[0];
        $location = 'controllers' . DS . $this->controller;

        if (is_dir(_APPLICATION_ . DS . $location)) {
            $this->controller = $this->url[1];
            $this->method = $this->url[2];
            $this->parameters = array_slice($this->url, 3);
            $location = $location . DS . $this->controller;
        } else {
            $this->method = $this->url[1];
            $this->parameters = array_slice($this->url, 2);
        }
        $this->addFile($location);
    }

    /*
     * ***************************************************
     * Require File if exists
     * ***************************************************
     */

    private function addFile($location)
    {
        $file = _APPLICATION_ . DS . strtolower($location) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            $this->error->notFile($file);
        }
    }

    /*
     * *******************************************************
     * GET Controller , Method and Parameters
     * *******************************************************
     */

    private function getObjectInfo()
    {

        switch ($this->count) {
            case 3:
                $this->thirdObject();
                break;

            case 2:
                $this->secondObject();
                break;

            case 1:
                $this->firstObject();
                break;

            case 0:
                $location = 'controllers' . DS . $this->controller;
                $this->addFile($location);
                break;

            default:
                $this->othersObject();
                break;
        }
    }

    /*
     * *********************************************************
     * Call Method of a Class using created object
     * *********************************************************
     */

    private function methodCaller($object)
    {
        if (method_exists($object, $this->method)) {
            if (!empty($this->parameters)) {
                //call_user_method_array($this->method, $object, $this->parameters);
                call_user_func_array(array($object, $this->method), $this->parameters);
            } else if (strtolower($this->controller) != strtolower($this->method)) {
                $object->{$this->method}();
            }
        } else {
            $this->error->notMethod($this->method);
        }
    }

    /*
     * *********************************************************
     * Create Object and call Method
     * *********************************************************
     */

    public function objectCreator()
    {

        $this->getObjectInfo();

        if (class_exists($this->controller)) {
            $object = new $this->controller;
            $this->methodCaller($object);
        } else {
            $this->error->notClass($this->controller);
        }
    }

}
