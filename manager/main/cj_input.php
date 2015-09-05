<?php

class CJ_Input
{
    /*
     * ******************************************************
     * Filter Data Before Add
     * ******************************************************
     */

    function testInput($data, $html = FALSE)
    {
        if (!empty($data)) {
            $data = trim($data);
            $data = stripslashes($data);

            if ($html == FALSE) {
                $data = htmlspecialchars($data);
            }
            return $data;
        }
    }





    /*
     * ******************************************************
     * Filter Data Array Before Add
     * ******************************************************
     */

    function testInputArray($datas, $html = FALSE)
    {
        $filterData = array();
        foreach ($datas as $key => $data) {
            if (!empty($data)) {
                $data = trim($data);
                $data = stripslashes($data);

                if ($html == FALSE) {
                    $data = htmlspecialchars($data);
                }
                $filterData[$key] = $data;
            }
        }

        return $filterData;
    }






    /*
     * ******************************************************
     * return value of $_POST
     * ******************************************************
     */

    public function post($key , $html = FALSE)
    {
        return $this->testInput($_POST[$key], $html = FALSE);
    }

    /*
     * ******************************************************
     * return an array of post fields
     * ******************************************************
     */

    public function arrayFromPost($fields)
    {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->post($field);
        }
        return $data;
    }


    /*
     * ******************************************************
     * Get Post Array
     * ******************************************************
     */
    public function postArray($name)
    {
        return $this->testInputArray($_POST[$name]);
    }



    /*
     * ******************************************************
     * return value of $_GET
     * ******************************************************
     */

    public function get($key, $html = FALSE)
    {
        return $this->testInput($_GET[$key], $html = FALSE);
    }

    /*
     * ******************************************************
     * return an arry of GET fields
     * ******************************************************
     */

    public function arrayFromGet($fields)
    {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->post($field);
        }
        return $data;
    }

}
