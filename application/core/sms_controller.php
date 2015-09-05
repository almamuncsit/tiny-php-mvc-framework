<?php

class SMS_Controller extends CJ_Controller
{
    private $m_login;
    
    function __construct()
    {
        parent::__construct();
        
        $this->m_login = $this->render->model('m_login');
        
        /*
         * ***********************
         * Check Login
         * ***********************
         */
        Session::start();
        if (!isset($_SESSION)) {
            redirect(base_url() . 'sms/user');
        } else {
            $username = Session::get('username');
            $password = Session::get('password');
            $this->data['admin'] = $this->m_login->admin($username, $password);
            if(count($this->data['admin']) != 1) {
                redirect(base_url() . 'sms/user');
            }
            
        }
        
    }

}
