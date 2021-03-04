<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 03-Mar-21
 * Time: 21:03
 */

namespace emcode\phpmvc\exception;


class ForbiddenException extends \Exception
{
    public $message = 'You don\'t have permission to access this page';
    public $code = 403;


}