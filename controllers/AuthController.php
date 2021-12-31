<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Notification;
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
        {
            var_dump(App::isGuest());
            var_dump($_POST);
//            var_dump($request->method());
//            echo '\n';
//            var_dump($request->getBody());
            exit();
            $response->redirect('/');
        }
        $loginForm = new LoginForm();

        if ($request->method() === 'post') {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                exit;
            }
            $this->setLayout('auth2');
            return $this->render('login2', ['model' => $loginForm]);
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

    public function profile(Request $request)
    {
        $currentuser = APP::$app->user;
        $user = User::findOne(['id' => $currentuser->id]);
        $user->password = '';
        $notifications = [];
        $unseenNotifications = 0;
        if (!App::isGuest()) {
            $notifications = Notification::getNotifications();
            foreach ($notifications as $notification) {
                if ($notification['status'] == 0) $unseenNotifications++;
            }
        }

        if ($request->method() === 'post') {
            $user->loadData($request->getBody());

            if ($user->validate('unique')  && $user->update(['id' => $user->id], $request->getBody())) {
                App::$app->session->setFlash('success', 'Thanks for Registering');
                App::$app->response->redirect('/');
                exit;
            }
            $this->setLayout('auth2');
            return $this->render('profile', ['model' => $user]);
        }
        $this->setLayout('auth2');
        return $this->render('profile', ['model' => $user,'unseenNotifications' => $unseenNotifications, 'notifications' => $notifications]);
    }

    public function subscribe(Request $request,Response $response)
    {
        User::subscribe($_GET['cat_id']);
        $response->redirect('/');
    }
    public function unsubscribe(Request $request,Response $response)
    {
        User::unsubscribe($_GET['cat_id']);
        $response->redirect('/');
    }

}