<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 27-Feb-21
 * Time: 23:08
 */

namespace app\core;


use app\core\exception\NotFoundException;

class Router
{
    protected $routes = [];
    protected $request;
    protected $response;

    public function __construct($request, $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ? $this->routes[$method][$path] : false;
        if($callback === false){
            throw new NotFoundException();
        }

        if(is_string($callback)){
            return $this->render($callback);
        }

        if(is_array($callback))
        {
            Application::$app->controller = new $callback[0]();
            Application::$app->controller->action = $callback[1];
            $callback[0] = Application::$app->controller;

            foreach (Application::$app->controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function render($callback, $params = [])
    {
        return Application::$app->view->render($callback, $params);
    }
    public function renderView($callback, $params)
    {
        return Application::$app->view->renderView($callback, $params);
    }

//    public function renderLayout()
//    {
//        $layout = Application::$app->controller->layout ? Application::$app->controller->layout : 'main';
//        ob_start();
//        include_once Application::$ROOT_DIR .  "/views/layouts/$layout.php";
//
//        return ob_get_clean();
//    }



}