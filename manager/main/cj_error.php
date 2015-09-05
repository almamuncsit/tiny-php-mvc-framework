<?php

class CJ_Error
{

    public function notExtention($extention)
    {
        echo 'Your ginven extention : <strong style="color: red; "> ' . $extention . ' </strong> is not Currect <br/>';
        echo 'Please Update URL_EXTENTION on config file <br/>';
    }

    public function notFile($file)
    {
        echo 'File Requried Failed. File does not exists : <strong style="color: red; "> ' . $file . ' </strong> <br/>';
    }

    public function notClass($class)
    {
        echo 'Your given class : <strong style="color: red; "> ' . $class . ' </strong> did not found. <br/>';
    }

    public function notMethod($method)
    {
        echo 'Your given Method : <strong style="color: red; "> ' . $method . ' </strong> did not found. <br/>';
    }

}
