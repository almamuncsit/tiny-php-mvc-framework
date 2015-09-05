<?php

/*
 * *****************************************
 * Define your work environment
 * Make it TRUE or FALSE
 * if false user will not view real error 
 * Will view 404 page not found
 * If TRUE You will view Real Error
 * *****************************************
 */

define('DEVELOPMENT_ENVIRONMENT', TRUE);




/*
 * **********************************************************************
 * ADD SIDE BASE URL SUCH AS www.cenajana.com or www.cenajana.com/admin
 * OR localhost/cenajan
 * **********************************************************************
 */

define('BASE_URL', 'http://localhost/me/tth/admin/');


/*
 * *****************************************
 * ADD SIDE BASE URL SUCH AS www.cenajana.com 
 * OR localhost/cenajan
 * *****************************************
 */

define('SITE_URL', 'http://localhost/me/tth/');





/*
 * ******************************************
 * ADD YOUR SITE TITLE 
 * YOUR SITE NAME
 * ******************************************
 */

define('SITE_NAME', 'CenaJana');





/*
 * ******************************************
 * Set Default Controller
 * It will RUN if you don't call any controller
 * It Is your home page
 * By Default It call Index Controller 
 * You Can Change it 
 * Don't Forget Create Changed Controller
 * ******************************************
 */

define("DEFAULT_CONTROLLER", 'Welcome');



/*
 * *******************************************
 * Set default method of controller
 * It will call when no other method will call
 * *******************************************
 */

define("DEFAULT_METHOD", 'index');


/*
 * ********************************************
 * URL File Extention
 * You can define any Extention here
 * Such AS .html or .php or .aspx or .java
 * Every link will use this suffix
 * When you use link you have to use this extention
 * ********************************************
 */

define('URL_EXTENTION', '');