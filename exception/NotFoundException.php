<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 03-Mar-21
 * Time: 21:24
 */

namespace app\core\exception;


class NotFoundException extends \Exception
{
    public $code = 404;
    public $message = 'Page not found';
}