<?php

class Date
{
    /*
     * ***************************************************
     * Convert (d-m-Y) Date to sql Formar (Y-m-d)
     * ***************************************************
     */
    public static function convertSql($Date)
    {
        $old_date_timestamp = strtotime($Date);
       	$date  = date('Y-m-d', $old_date_timestamp);
        return $date;
    }
    
}
