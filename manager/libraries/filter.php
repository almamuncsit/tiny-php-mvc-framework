<?php

class Filter
{
    /*
     * *************************************************
     * Remove all characters, except digits and +-
     * And return an int number
     * *************************************************
     */

    public static function int($int)
    {
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }

    /*
     * *************************************************
     * Strip tags, optionally strip or encode special characters
     * And return a string
     * *************************************************
     */

    public static function string($string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    /*
     * *************************************************
     * Remove all characters, except digits, +- and optionally .,eE
     * @Return a float number
     * *************************************************
     */

    public static function float($var)
    {
        return filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    /*
     * *************************************************
     * Remove all characters, except letters, digits and !#$%&'*+-/=?^_`{|}~@.[]
     * @Return a valid email address
     * *************************************************
     */

    public static function email($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /*
     * *************************************************
     * Apply addslashes()
     * Add \ when get ' or " 
     * *************************************************
     */

    public static function magicQuotes($var)
    {
        return filter_var($var, FILTER_SANITIZE_MAGIC_QUOTES);
    }

    /*
     * *************************************************
     * HTML-escape '"<>& and characters with ASCII value less than 32
     * *************************************************
     */

    public static function specialChars($var)
    {
        return filter_var($var, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /*
     * *************************************************
     * Remove all characters, except letters, digits 
     * and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=
     * @Return a valid URL
     * *************************************************
     */

    public static function url($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }
    
    
    /*
     * *************************************************
     * Remove all empty element of a array
     * *************************************************
     */

    public static function farray($array)
    {
        return array_filter($array);
    }

}
