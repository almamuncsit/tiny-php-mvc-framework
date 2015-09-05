<?php

class Upload
{

    private $_name;
    private $_type;
    private $_error;
    private $_size;
    private $_tmp_name;

    public function __construct($name)
    {
        $name = Filter::string($name);
        $this->_error = $_FILES[$name]["error"];
        $this->_name = $_FILES[$name]["name"];
        $this->_type = $_FILES[$name]["type"];
        $this->_size = $_FILES[$name]["size"];
        $this->_tmp_name = $_FILES[$name]["tmp_name"];
    }


    /*
     * ************************************************
     * Get File name
     * ************************************************
     */

    public function name()
    {
        return $this->_name;
    }


    /*
     * ************************************************
     * Get file Type
     * ************************************************
     */

    public function type()
    {
        return $this->_type;
    }


    /*
     * ************************************************
     * Get file size
     * ************************************************
     */

    public function size()
    {
        return $this->_size;
    }


    /*
     * *************************************************
     * Rename Image name
     * *************************************************
     */

    public function rename()
    {
        $one = rand('000000', '9999999');
        $two = rand('000000', '9999999');
        $new = $one . $two;
        $fileExt = explode('.', $this->_name);
        $ext = end($fileExt);
        return $new . '.' . $ext;
    }


    /*
     * ************************************************
     * Upload Full image
     * ************************************************
     */

    public function image($directory, $resize = NULL, $max_size = NULL)
    {
        if(!in_array($this->_type, array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'))){
            return 0;
        }
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $loacation = $directory . '/' . $this->rename();
        if (move_uploaded_file($this->_tmp_name, $loacation)) {
            return str_replace('../', '', $loacation);
        }

        return 0;
    }


    /*
     * ************************************************
     * Upload a Document 
     * ************************************************
     */

    public function document($directory, $resize = NULL, $max_size = NULL)
    {
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $loacation = $directory . '/' . $this->rename();
        if (move_uploaded_file($this->_tmp_name, $loacation)) {
            return str_replace('../', '', $loacation);
        }

        return 0;
    }

}
