<?php

class Display
{

    public static function view($var, $label)
    {
        ?>
        <div class="row display_view">
            <div class ="col-md-4 text-right text-bold"> <?php echo $label; ?> &nbsp; <span class="text-aqua"> : </span></div>
            <div class ="col-md-8"> <?php echo nl2br($var); ?> </div>
        </div>
        <?php
    }

    public static function image($location, $label = NULL)
    {
        if (!empty($label)) {
            ?>
            <div class="row display_view">
                <div class ="col-md-4 text-right text-bold"> <?php echo $label; ?> &nbsp; <span class="text-aqua"> : </span></div>
                <div class ="col-md-8"> <img src="<?php echo site_url().$location; ?>" class="thumbnail" width="200"> </div>
            </div>
            <?php
        }
    }

}
