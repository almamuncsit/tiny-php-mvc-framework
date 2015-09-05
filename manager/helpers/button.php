<?php

class Button
{

    public static function view($url, $class = "btn btn-info btn-xs")
    {
        ?> <a href="<?php echo BASE_URL . $url; ?>" class="<?php echo $class; ?>">View</a> <?php
    }

    public static function btn_print($url, $class="")
    {
        ?> <a href="<?php echo BASE_URL . $url; ?>" class="<?php echo $class; ?>"> <i class="fa fa-print fa-2x"></i></a> <?php
    }

    public static function edit($url, $class = "btn btn-success btn-xs")
    {
        ?> <a href="<?php echo BASE_URL . $url; ?>" class="<?php echo $class; ?>"><i class="fa fa-pencil fa-fw"></i> Edit </a> <?php
    }

    public static function delete($url, $class="btn btn-danger btn-sm")
    {
        ?><a class="btn btn-danger btn-xs" href="<?php echo BASE_URL . $url; ?>" onclick="return confirm('Are you Sure? \nYou want to delete it !');">
            <i class="fa fa-times"></i> Delete
        </a> <?php
    }

    public static function link($url, $label, $classes)
    {
        ?> <a href="<?php echo BASE_URL . $url; ?>" class="btn btn-warning btn-xs"> <?php echo $label; ?> </a> <?php
    }

}
