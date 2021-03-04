<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 27-Feb-21
 * Time: 23:08
 */

namespace app\core;

use app\core\db\Database;

class Application
{
    public $router;
    public $request;
    public $response;
    public $controller;
    public $view;
    public $session;
    public $user;
    public $userClass;
    public $db;

    public static $ROOT_DIR;
    public static $app;

    public function __construct($rootPath, $config)
    {
        $this->userClass = $config['userClass'];
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');

        //var_dump($primaryValue);
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public function run()
    {
        try{
            echo $this->router->resolve();
        }catch (\Exception $e)
        {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->render('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function login($user)
    {
        $this->user = $user;

        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
}