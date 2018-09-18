<?php

class Welcome extends MY_Controller
{
    private $welcomeModel;

    public function __construct() {
        parent::__construct();
        $this->welcomeModel = $this->render->model('WelcomeModel');
    }

    public function index() {
        $hello = $this->welcomeModel->hello();
        $this->loadView('index', ['hello' => $hello]);
    }

}
