<?php

class From
{

    private static $data;

    /*
     * **************************************************
     * Start from
     * **************************************************
     */

    public static function start($action = NULL, $data = NULL, $method = 'POST', $class = 'form-horizontal')
    {
        self::$data = $data;
        ?> 
            <form action="<?php echo $action; ?>" method="<?php echo $method; ?>" class="<?php echo $class; ?>" enctype="multipart/form-data" > 
        <?php
    }
    
    /*
     * **************************************************
     * End From
     * **************************************************
     */

    public static function end()
    {
        echo '</form>';
    }

    /*
     * **************************************************
     * Add new text Box
     * **************************************************
     */

    public static function text($name, $required = NULL, $type = 'text', $value = NULL, $label = NULL)
    {
        if (empty($label)) {
            $label = ucwords(str_replace('_', ' ', $name));
        }
        if (empty($value) && isset(self::$data->{$name})) {
            $value = self::$data->{$name};
        }
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"> <?php echo $label; if(!empty($required)) { echo '<spam style="color:#f00;" > * </spam>'; } ?>  : </label>
            <div class="col-sm-8">
                <input <?php echo $required; ?> value="<?php echo $value; ?>" type="<?php echo $type; ?>" class="form-control input-sm" name="<?php echo $name; ?>" id="<?php echo $name; ?>" placeholder="<?php echo $label; ?>">
            </div>
        </div>  <?php
    }
    
    
    /*
     * **************************************************
     * Add new text Box
     * **************************************************
     */

    public static function date($name, $required = NULL, $type = 'text', $value = NULL, $label = NULL)
    {
        if (empty($label)) {
            $label = ucwords(str_replace('_', ' ', $name));
        }
        if (empty($value) && isset(self::$data->{$name})) {
            $value = self::$data->{$name};
        }
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"> <?php echo $label; if(!empty($required)) { echo '<spam style="color:#f00;" > * </spam>'; } ?>  : </label>
            <div class="col-sm-8">
                <input <?php echo $required; ?> value="<?php echo $value; ?>" type="<?php echo $type; ?>" class="form-control input-sm datepicker" name="<?php echo $name; ?>" id="<?php echo $name; ?>" placeholder="<?php echo $label; ?>">
            </div>
        </div>  <?php
    }

    /*
     * **************************************************
     * Add dropdown list 
     * here label and value is same
     * **************************************************
     */

    public static function select($name, $values, $selected = NULL, $required = NULL, $label = NULL)
    {
        if (empty($label)) {
            $label = ucwords(str_replace('_', ' ', $name));
        }
        if (empty($selected) && isset(self::$data->{$name})) {
            $selected = self::$data->{$name};
        }
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"> <?php echo $label; if(!empty($required)) { echo '<spam style="color:#f00;" > * </spam>'; } ?> : </label>
            <div class="col-sm-8">
                <select <?php echo $required; ?> name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control input-sm">
                    <option value="<?php echo $selected; ?>" selected="selected"> 
                        <?php
                        if (!empty($selected)) {
                            echo $selected;
                        } else {
                            echo '<-- Please Select -->';
                        }
                        ?> 
                    </option>

                    <?php
                    foreach ($values as $value) {
                        echo "<option value=\"$value\"> $value </option>";
                    }
                    ?>

                </select>
            </div>
        </div>  
        <?php
    }

    
        /*
     * **************************************************
     * Add dropdown list where labe and vlue is defferent
     * **************************************************
     */

    public static function selectVal($name, $values, $selected = NULL, $required = NULL, $label = NULL)
    {
        if (empty($label)) {
            $label = ucwords(str_replace('_', ' ', $name));
        }
        if (empty($selected) && isset(self::$data->{$name})) {
            $selected = self::$data->{$name};
        }
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"> <?php echo $label; if(!empty($required)) { echo '<spam style="color:#f00;" > * </spam>'; } ?> : </label>
            <div class="col-sm-8">
                <select <?php echo $required; ?> name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control input-sm">
                    <option value="<?php echo $selected; ?>" selected="selected"> 
                        <?php
                        if (!empty($selected)) {
                            echo $selected;
                        } else {
                            echo '<-- Please Select -->';
                        }
                        ?> 
                    </option>

                    <?php
                    foreach ($values as $key => $value) {
                        echo "<option value=\"$key\"> $value </option>";
                    }
                    ?>

                </select>
            </div>
        </div>  
        <?php
    }
    
    
    
    /*
     * ********************************************************************************
     * Create atextarea
     * ********************************************************************************
     */

    public static function textarea($name, $required = NULL, $value = NULL, $label = NULL)
    {
        if (empty($label)) {
            $label = ucwords(str_replace('_', ' ', $name));
        }
        $value = '';
        if (empty($value) && isset(self::$data->{$name})) {
            $value = self::$data->{$name};
        }
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"> <?php echo $label; if(!empty($required)) { echo '<spam style="color:#f00;" > * </spam>'; } ?> : </label>
            <div class="col-sm-8">
                <textarea <?php echo $required; ?> class="form-control input-sm" name="<?php echo $name; ?>" id="<?php echo $name; ?>" placeholder="<?php echo $label; ?>"><?php echo $value; ?></textarea>
            </div>
        </div>  <?php
    }

    /*
     * **************************************************
     * Add new text Box
     * **************************************************
     */

    public static function file($name, $required = NULL, $label = NULL)
    {
        if (empty($label)) {
            $label = ucwords(str_replace('_', ' ', $name));
        }
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"> <?php echo $label; ?> : </label>
            <div class="col-sm-8">
                <input type="file" name="<?php echo $name; ?>" id="<?php echo $name; ?>" <?php echo $required; ?>/>
            </div>
        </div>  <?php
    }

    /*
     * ********************************************************************************
     * Submit Button
     * ********************************************************************************
     */

    public static function submit($label = 'Save', $class = 'btn btn-success')
    {
        ?>
        <div class="form-group">
            <label class="col-sm-8 control-label"></label>
            <div class="col-sm-2">
                <input type="submit" class="<?php echo $class; ?>" value="<?php echo $label; ?>">
            </div>
        </div>  <?php
    }

}
