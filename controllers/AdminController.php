<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
use app\core\middlewares\ActiveMiddleware;
use app\core\middlewares\AdminMiddleware;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\Guideline;
use app\models\Post;
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
        if (isset($_GET['source'])) {
            $this->verifyUser($request,$response);
            if ($_GET['source'] == 'add_user') {
                $mode = 'create';
                if ($request->method() == 'post') {
                    $user->loadData($request->getBody());
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
                    $user->loadData($request->getBody());
                    //TODO need add validate (bug)
                    if ($user->validate('unique') && $user->update(['id' => $_GET['edit_user_id']], $request->getBody())) {
                        return $response->redirect('/admin/users');
                    }
                }
                return $this->render('admin_users', ['mode' => $mode, 'model' => $user]);
            }
            if ($_GET['source'] == 'change_status') {
                $user->changeStatus($_GET['user_id']);
                return $response->redirect('/admin/users');
            }
        }
        if (isset($_GET['del_id'])) {
            $user->deleteUser($_GET['del_id']);
            return $response->redirect('/admin/users');
        }


        return $this->render('admin_users', ['mode' => $mode, 'model' => $user]);
    }
    public function verify(Request $request, Response $response){
        var_dump(App::$app->user->getPassword());
        if(password_verify($_POST['verify'],App::$app->user->getPassword()) ){
            App::$app->session->set('VERIFIED','TRUE');
            $request = App::$app->session->get('REQUEST');
            App::$app->session->unset_key('REQUEST');
            $response->redirect($request);
            exit();
        }
        throw new \Error("Unauthorized Access", 403);

    }

    private function verifyUser(Request $request, Response $response)
    {
        if ($request->method() == 'post') return ;
        if(App::$app->session->get('VERIFIED') === 'TRUE') {
            App::$app->session->unset_key('VERIFIED');
            return true;
        }
        else {
            echo $this->requireVerifivation();
            exit();
        }
    }

    /**
     * @return array|false|string|string[]
     */
    private function requireVerifivation(){
        App::$app->session->set('REQUEST', App::$app->request->getRequest());
        $this->setLayout('main');
        return $this->render('officer_verify');
    }
}
