<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 03-Mar-21
 * Time: 20:54
 */

namespace emcode\phpmvc\middlewares;


use emcode\phpmvc\Application;
use emcode\phpmvc\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}