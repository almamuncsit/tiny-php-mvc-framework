<?php

class Welcome extends MY_Controller
{
    private $m_welcome;
    public function __construct() {
        parent::__construct();
        $this->m_welcome = $this->render->model('welcome_m');
    }

    public function index() {
        $this->data['name'] = $this->m_welcome->hello();
        
        
        $this->loadView('index', $this->data);
    }

}
