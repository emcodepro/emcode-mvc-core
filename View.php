<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 04-Mar-21
 * Time: 10:06
 */

namespace emcode\phpmvc;


class View
{
    public $title = '';

    public function render($callback, $params = [])
    {
        $view = $this->renderView($callback, $params);
        $layout = $this->renderLayout();

        return str_replace("{{content}}", $view, $layout);
    }
    public function renderView($callback, $params)
    {
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$callback.php";
        return ob_get_clean();
    }

    public function renderLayout()
    {
        $layout = Application::$app->controller->layout ? Application::$app->controller->layout : 'main';
        ob_start();
        include_once Application::$ROOT_DIR .  "/views/layouts/$layout.php";

        return ob_get_clean();
    }
}