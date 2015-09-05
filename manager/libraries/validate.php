<?php

class Valid
{
    /*
     * ******************************************************
     * Return TRUE for "1", "true", "on" and "yes", 
     * FALSE for "0", "false", "off", "no", and "", NULL otherwise
     * ******************************************************
     */

    public static function bool($var)
    {
        return filter_var($var, FILTER_VALIDATE_BOOLEAN);
    }

    /*
     * **********************************************************
     * Validate value as e-mail
     * **********************************************************
     */

    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /*
     * **********************************************************
     * Validate value as float
     * **********************************************************
     */

    public static function float($var)
    {
        return filter_var($var, FILTER_VALIDATE_FLOAT);
    }

    /*
     * **********************************************************
     * Validate value as integer, 
     * optionally from the specified range
     * **********************************************************
     */

    public static function int($int, $range = NULL)
    {
        if (!empty($range)) {
            return filter_var($int, FILTER_VALIDATE_INT, $range);
        } else {
            return filter_var($int, FILTER_VALIDATE_INT);
        }
    }

    /*
     * **********************************************************
     * Validate value as IP address, optionally only IPv4 or IPv6 
     * or not from private or reserved ranges
     * **********************************************************
     */

    public static function ip($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    /*
     * **********************************************************
     * Validate value as URL, optionally with required components
     * **********************************************************
     */

    public static function url($email)
    {
        return filter_var($email, FILTER_VALIDATE_URL);
    }

}
