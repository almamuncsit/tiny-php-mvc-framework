<?php

class MY_Controller extends CJ_Controller
{
    protected $m_login;
    protected $admin_id;

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->m_login = $this->render->model('m_login');
        
        /*
         * ***********************
         * Check Login
         * ***********************
         */
        Session::start();
        if (!isset($_SESSION)) {
            redirect(base_url() . 'user');
        } else {
            $username = Session::get('username');
            $password = Session::get('password');
            $this->data['admin'] = $admins = $this->m_login->admin($username, $password);
            if(count($this->data['admin']) != 1) {
                redirect(base_url() . 'user');
            }
            $this->admin_id = $this->data['admin'][0]->id;
        }
        
    }

}
