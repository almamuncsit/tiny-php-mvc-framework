<?php

class Session
{

    /*
     * *********************************
     * Start Session
     * *********************************
     */
    public static function start()
    {
        session_start();
    }
    
    /*
     * ********************************
     * Set Session
     * ********************************
     */
    
    public static function set($key, $value)
    {
        $key = Filter::string($key);
        $value = Filter::string($value);
        $_SESSION[$key] = $value;
    }
    
    
    /*
     * **********************************
     * Get Session value
     * **********************************
     */
    public static function get($key)
    {
        $key = Filter::string($key);
        return $_SESSION[$key];
    }
    
    /*
     * *************************************
     * Destroy A Session
     * *************************************
     */
    public static function destroy ()
    {
        session_destroy();
    }

}

