<?php

class Welcome extends MY_Controller
{
    private $m_welcome;

    public function __construct() {
        parent::__construct();
        $this->m_welcome = $this->render->model('Welcome');
    }

    public function index() {
        $hello = $this->m_welcome->hello();
        $this->loadView('index', ['hello' => hello]);
    }

}
