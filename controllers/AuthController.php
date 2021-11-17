<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request,Response $response)
    {
        if (!App::isGuest())
            $response->redirect('/');
        $loginForm = new LoginForm();

        if ($request->method() === 'post') {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                exit;
            }
            $this->setLayout('auth2');
            return $this->render('login2',['model'=>$loginForm]);
        }
        $this->setLayout('auth2');
        return $this->render('login2',['model'=>$loginForm]);
    }

    public function register(Request $request)
    {
        $user = new User();

        if ($request->method() === 'post') {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                App::$app->session->setFlash('success','Thanks for Registering');
                App::$app->response->redirect('/');
                exit;
            }
            $this->setLayout('auth2');
            return $this->render('register',['model'=>$user]);
        }
        $this->setLayout('auth2');
        return $this->render('register',['model'=>$user]);
    }

    public function logout(Request $request,Response $response )
    {
        App::$app->logout();
        $response->redirect('/');

    }

    public function profile()
    {
        return $this->render('profile');
    }
}