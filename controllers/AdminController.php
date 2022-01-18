<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
use app\core\middlewares\ActiveMiddleware;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\User;

class AdminController extends Controller
{
    public string $layout = 'admin';
    public function __construct()
    {
        $this->registerMiddleware(new AdminMiddleware());
        $this->registerMiddleware(new ActiveMiddleware());
    }

    public function index()
    {
        return $this->render('admin_index', []);
    }

    public function users(Request $request, Response $response)
    {
        $mode = 'show';
        $user = new User();
//        $this->setGetParams($request);
        if (isset($_GET['source'])) {
            if ($_GET['source'] == 'add_user') {
                $mode = 'create';
                if ($request->method() == 'post') {
                    $this->verifyUser($request,$response);
                    $user->loadData($this->getFormData());
                    if ($user->validate() && $user->save()) {
                        return $response->redirect('/admin/users');
                    }
                }
                return $this->render('admin_users', ['mode' => $mode, 'model' => $user]);
            }
            if ($_GET['source'] == 'edit_user') {
                $mode = 'edit';
                /** @var $user User*/
                $user = User::findOne(['id' => $_GET['edit_user_id']]);
                $user->password = '';
                if ($request->method() == 'post') {
                    $this->verifyUser($request,$response);
                    $user->loadData($this->getFormData());
                    //TODO need add validate (bug)
                    if ($user->validate('unique') && $user->update(['id' => $_GET['edit_user_id']], $this->getFormData())) {
                        return $response->redirect('/admin/users');
                    }
                }
                return $this->render('admin_users', ['mode' => $mode, 'model' => $user]);
            }
            if ($_GET['source'] == 'change_status') {
                $this->verifyUser($request,$response);
                $user->changeStatus($_GET['user_id']);
                return App::$app->response->redirect('/admin/users');
            }
        }
        if (isset($_GET['del_id'])) {
            $this->verifyUser($request,$response);
            $user->deleteUser($_GET['del_id']);
            return $response->redirect('/admin/users');
        }


        return $this->render('admin_users', ['mode' => $mode, 'model' => $user]);
    }
    public function verify(Request $request, Response $response)
    {
        if ($request->method() === 'post') {
            if (password_verify($_POST['verify'], App::$app->user->getPassword())) {
                App::$app->session->set('VERIFIED', 'TRUE');
                $request_prev = unserialize(App::$app->session->get('REQUEST'));
                App::$app->session->unset_key('REQUEST');
                App::$app->session->unset_key('fail');

                //setting the previous request and resolving it
                App::$app->session->set('FORM_DATA',$request_prev->getBody());
                $response->temporaryRedirect($request_prev->getRequestURI());
                exit();
            }
        }
        if (App::$app->session->get('fail'))
            return $this->render('admin_verify',['fail'=>true]);
        App::$app->session->set('fail', true);
        return $this->render('admin_verify',['fail'=>false]);
    }

    public function cancel_verify(Request $request, Response $response)
    {
        $request_prev = unserialize(App::$app->session->get('REQUEST'));
        App::$app->session->unset_key('REQUEST');
        App::$app->session->unset_key('fail');

        $response->redirect($request_prev->getPath());
    }

    private function verifyUser(Request $request, Response $response)
    {
        if(App::$app->session->get('VERIFIED') === 'TRUE') {
            App::$app->session->unset_key('VERIFIED');
        }
        else {
            App::$app->session->set('REQUEST', serialize($request));
            App::$app->session->set('fail',false);
            $response->redirect('/admin/verify');
            exit();
        }
    }

    private function setGetParams(Request $request): void
    {
        $param = parse_url($request->getRequestURI(), PHP_URL_QUERY);
        if ($param === null) return;
        $query = mb_split("&", $param);
        if (!empty($query)) foreach ($query as $qr) {
            $vars = mb_split('=', $qr);
            if ($vars[0] != null)
                $_GET[$vars[0]] = $vars[1];
        }
    }
    private function getFormData():array
    {
        return App::$app->session->get('FORM_DATA');
    }
}
