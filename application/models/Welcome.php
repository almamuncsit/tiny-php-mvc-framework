<?php
class Welcome extends CJ_Model {

    function __construct() {
        parent::__construct();
        // $this->setTable('table_name');
    }
    
    public function hello() {
        return 'Welcome to Tiny PHP MVC Framework';
    }

}

