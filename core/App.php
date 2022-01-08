<?php

namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;

class App
{
    public string $userClass;

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?UserModel $user;

    public View $view;

    public static App $app;
    public Controller $controller;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'] ?? '';

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->response);
        $this->db = new Database($config['db']);
        $this->view = new View();

        $primaryValue = $this->session->get('user');
        if ($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey=>$primaryValue]);
        }else{
            $this->user = null;
        }
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        }catch(\Exception $e) {
            $error_code = $e->getCode();
            if(gettype($error_code) === 'string') {
                $error_code = 500;
            }
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error',[
                'exception'=> new \Exception($e->getMessage(), $error_code)
            ]);
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;

        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};

        $this->session->set('user',$primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest():bool
    {
        return !self::$app->user;
    }

    public static function isAdmin():bool
    {
        if (self::isGuest()){
            return false;
        }
        return self::$app->user->type == 0;
    }
    public static function isOfficer():bool
    {
        if (self::isGuest()){
            return false;
        }
        return self::isAdmin() || self::$app->user->type == 1;
    }

}