<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 28-Feb-21
 * Time: 12:34
 */
namespace emcode\phpmvc;

class Response
{
    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: '. $url);
    }
}