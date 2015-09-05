<?php

class CJ_Render
{
    /*
     * *****************************************************
     * Include file of view folder
     * Use Sub folder Befole file if you use sub folder on view folder
     * ****************************************************
     */

    public function view($file, $datas = NULL)
    {
        rtrim($file, '.php');
        include_once(_APPLICATION_ . DS . 'views' . DS . $file . '.php');
    }

    /*
     * **********************************************************************
     * Return object of given Model 
     * *********************************************************************
     */

    public function model($model_name)
    {
        rtrim($model_name, '/');
        rtrim($model_name, '.php');

        $location = explode('/', $model_name);
        $count = count($location);
        $filename = _APPLICATION_ . DS . 'models' . DS . strtolower($model_name) . '.php';
        $filename2 = _APPLICATION_ . DS . 'models' . DS . $model_name . '.php';
        if (1) {
            if (file_exists($filename)) {
                include_once $filename;
                return new $model_name;
            } elseif (file_exists($filename2)) {
                include_once $filename2;
                return new $model_name;
            }
        } else if (2) {
            if (file_exists($filename)) {
                include_once $filename;
                return new $location[1];
            } elseif (file_exists($filename2)) {
                include_once $filename2;
                return new $location[1];
            }
        }
        return;
    }

    /*
     * ************************************************************************
     * use css file 
     * ************************************************************************
     */

    public function css($file)
    {
        rtrim($file, '.css');
        $file = BASE_URL . DS . 'public' . DS . 'css' . DS . $file . '.css';
        echo '<link rel="stylesheet" type="text/css" href="' . $file . '" >';
    }

    /*
     * ************************************************************************
     * use css file 
     * ************************************************************************
     */

    public function image($file, $class = NULL, $width = NULL, $height = NULL)
    {
        $file = BASE_URL . DS . 'public' . DS . 'images' . DS . $file;
        echo '<img src="' . $file . '" >';
    }

    /*
     * ************************************************************************
     * use javascript file 
     * ************************************************************************
     */

    public function js($file)
    {
        rtrim($file, '.js');
        $file = BASE_URL . DS . 'public' . DS . 'js' . DS . $file . '.js';
        echo '<script src="' . $file . '"></script>';
    }

    /*
     * ************************************************************************
     * use Json file 
     * ************************************************************************
     */

    public function json($file)
    {
        rtrim($file, '.json');
        $file = BASE_URL . DS . 'public' . DS . 'json' . DS . $file . '.json';
    }

    /*
     * ************************************************************************
     * use xml file 
     * ************************************************************************
     */

    public function xml($file)
    {
        rtrim($file, '.xml');
        $file = BASE_URL . DS . 'public' . DS . 'xml' . DS . $file . '.xml';
    }

}
