<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 01-Mar-21
 * Time: 12:41
 */

namespace emcode\phpmvc\form;


class Form
{
    public static function begin($action = '', $method = 'get')
    {
        echo sprintf("<form action='%s' method='%s' >", $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field($model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}