<?php
/*
class CJ_View {

    public $render;
    public $data = array();

    function __construct() {
        //$this->render = new CJ_Render();
    }

    public function render($file, $vars= array()) {
        extract($vars, EXTR_PREFIX_SAME, 'a');
        rtrim($file, '.php');
        include_once \_APPLICATION_ . DS . 'views' . DS . $file . '.php';
    }

}
