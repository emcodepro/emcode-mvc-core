<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 03-Mar-21
 * Time: 20:52
 */

namespace emcode\phpmvc\middlewares;


abstract class BaseMiddleware
{
    abstract public function execute();
}