<?php

class CJ_Boot
{

    public $error;
    private $url = array();

    /*
     * *************************************************
     * Check User Given Extention 
     * *************************************************
     */

    private function extentionChecker($url)
    {
        $extention = URL_EXTENTION;
        $extention = str_replace(' ', '', $extention);
        $extention = str_replace('.', '', $extention);
        $url_array = explode('.', $url);
        if (count($url_array) > 1) {
            $given_extention = end($url_array);
        } else {
            $given_extention = '';
        }

        if (strtolower($extention) != strtolower($given_extention)) {
            $this->error->notExtention($given_extention);
        }
        $url = rtrim($url, URL_EXTENTION);

        return $url;
    }

    /*
     * *************************************************
     * GET ARRAY FROM USER GIVEN URL
     * *************************************************
     */

    private function getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : NULL;
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = rtrim($url, '/');
        $url = $this->extentionChecker($url);
        $this->url = explode('/', $url);
    }

    /*
     * ***********************************************************************
     *  Check if environment is development and display errors 
     * ***********************************************************************
     */

    private function errorSetting()
    {
        if (DEVELOPMENT_ENVIRONMENT == TRUE) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
        }
    }

    /**
     * ************************************************************************
     * Check for Magic Quotes and remove them 
     * ************************************************************************
     */
    function stripSlashesDeep($val)
    {
        $val = is_array($val) ? array_map('stripSlashesDeep', $val) : stripslashes($val);
        return $val;
    }

    function magicQuotesRemover()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = stripSlashesDeep($_GET);
            $_POST = stripSlashesDeep($_POST);
            $_COOKIE = stripSlashesDeep($_COOKIE);
        }
    }

    /*
     * ************************************************************************
     *  Check register globals and remove them 
     * ************************************************************************
     */

    function globalsUnRegister()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /*
     * *****************************************************
     * Main Function of this class which will call others function
     * *****************************************************
     */

    public function CJ_Boot()
    {
        $file = _MANAGER_ . DS . 'main/global.php';
        require_once $file;
        
        $this->error = new CJ_Error();
        $this->getUrl();
        $this->errorSetting();
        $this->magicQuotesRemover();
        $this->globalsUnRegister();
        $CJ_ObjectFactory = new CJ_ObjectFactory($this->url);
        $CJ_ObjectFactory->objectCreator();
    }

}
