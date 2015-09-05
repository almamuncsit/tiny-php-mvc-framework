<?php

class CJ_Controller
{

    protected $render;
    protected $input;
    protected $model;
    //protected $view;
    public $data = array();

    function __construct()
    {
        $this->render = new CJ_Render();
        $this->input = new CJ_Input();
        $this->model = new CJ_Model();
        //$this->view = new CJ_View();
        
    }

    protected function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    protected function get($name)
    {
        return $this->data[$name];
    }

    /*
     * *****************************************************************
     * Include View File 
     * *****************************************************************
     */

    protected function loadView($file, $vars = array())
    {
        extract($vars, EXTR_PREFIX_SAME, 'a');
        rtrim($file, '.php');
        include_once \_APPLICATION_ . DS . 'views' . DS . $file . '.php';
    }

    /*
     * *****************************************************************
     * For Redirect One Place to another
     * *****************************************************************
     */

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
    }

}
