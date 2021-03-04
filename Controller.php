<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 28-Feb-21
 * Time: 13:21
 */

namespace emcode\phpmvc;

use emcode\phpmvc\middlewares\BaseMiddleware;

class Controller
{
    public $layout = 'main';

    public $action = '';
    /**
     * @var BaseMiddleware
     */
    public $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    protected function render($view, $params = [])
    {
        return Application::$app->router->render($view, $params);
    }

    public function registerMiddleWare($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}