<?php

class CJ_Model extends CJ_Database
{

    public function __construct()
    {
        $this->connect();
    }

    /*
     * *******************************************************
     * Insert or update data
     * if get id then update or insert
     * *******************************************************
     */

    public function save($data, $id = NULL)
    {
        $data = array_filter($data);
        if (empty($id)) {
            return $this->insert($data);
        } else {
            $this->update($data, $id);
            return $id;
        }
    }

    /*
     * *******************************************************
     * Delete File
     * *******************************************************
     */

    public function deleteFile($location)
    {
        if (file_exists($location)) {
            unlink($location);
        }
    }

    function __destruct()
    {
        $this->close();
    }

}
