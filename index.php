<?php

/*
 * *****************************************
 * define the directory separator
 * It my defferent in defferent Platform
 * You need not change it
 * *****************************************
 */

define('DS', '/');

/*
 * ***************************************
 * define the application path
 * ***************************************
 */

define('ROOT', dirname(dirname(__FILE__)));


/*
 * *******************************************
 * Config Directory of application file
 * And config  Directory of system file
 * *******************************************
 */
define('_APPLICATION_', 'application');
define('_MANAGER_', 'manager');





/*
 * ********************************************
 * Used a autoload for create any object
 * We need not include any file here
 * ********************************************
 */

require _APPLICATION_ . DS . 'config/config.php';
require _APPLICATION_ . DS . 'config/database.php';


function __autoload($class) {
    $class = strtolower($class);
    $file = _MANAGER_ . DS . 'main' . DS . $class . '.php';
    $file1 = _MANAGER_ . DS . 'helpers' . DS . $class . '.php';
    $file2 = _MANAGER_ . DS . 'libraries' . DS . $class . '.php';
    
    // User Define Class
    $file3 = _APPLICATION_ . DS . 'core' . DS . $class . '.php';
    $file4 = _APPLICATION_ . DS . 'helpers' . DS . $class . '.php';
    
    if(file_exists($file))
        require $file;
    
    if(file_exists($file1))
        require $file1;
    
    if(file_exists($file2))
        require $file2;
    
    if(file_exists($file3))
        require $file3;
    
    if(file_exists($file4))
        require $file4;
}

/*
 * **********************************************
 * Create Main Boot Class onject
 * **********************************************
 */

$controller = new CJ_Boot();
