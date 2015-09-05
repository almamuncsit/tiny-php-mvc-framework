<?php

class Alert
{
    /*
     * ****************************************************
     * Alert if Success and its status is 1
     * ****************************************************
     */

    public static function success($message)
    {
        ?>
        <div class="alert alert-success alert-dismissable">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>Alert!</b> <?php echo $message; ?>
        </div>
        <?php
    }

    /*
     * ****************************************************
     * Alert Information and its status is 2
     * ****************************************************
     */

    public static function info($message)
    {
        ?>
        <div class="alert alert-info alert-dismissable">
            <i class="fa fa-info"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>Alert!</b>  <?php echo $message; ?>
        </div>
        <?php
    }

    /*
     * ****************************************************
     * Alert Warnging and its status is 3
     * ****************************************************
     */

    public static function warning($message)
    {
        ?>
        <div class="alert alert-warning alert-dismissable">
            <i class="fa fa-warning"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>Alert!</b> <?php echo $message; ?>
        </div>
        <?php
    }

    /*
     * ****************************************************
     * Alert Danger and its status is 4
     * ****************************************************
     */

    public static function danger($message)
    {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>Alert!</b>  <?php echo $message; ?>
        </div>
        <?php
    }

    /*
     * ******************************************************
     * Show Alert Depend on Status
     * ******************************************************
     */

    public static function show($msg, $status)
    {
        if (!empty($msg) && !empty($status)) {

            switch ($status) {
                case 1:
                    self::success($msg);
                    break;
                case 2:
                    self::info($msg);
                    break;
                case 3:
                    self::warning($msg);
                    break;
                case 4:
                    self::danger($msg);
                    break;
            }
        }
    }

}
