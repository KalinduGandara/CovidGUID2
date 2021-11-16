<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
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
    }

    public function index()
    {
        return $this->render('admin_index', []);
    }

    public function guidelines()
    {
        $guidelines = Guideline::getAll();
        $categories = Category::getAll();

        return $this->render('admin_guidelines', ['guidelines'=>$guidelines,'categories'=>$categories]);

    }

    public function categories(Request $request,Response $response)
    {
        $category = new Category();
        $mode = '';
        if (isset($_GET['edit_id'])){
            $mode = 'update';
            $category = Category::findOne(['cat_id'=>$_GET['edit_id']]);
        }
        if ($request->method() == 'post'){
            $category->loadData($request->getBody());
            if ($mode == 'update'){
                $category->update(['cat_id'=>$_GET['edit_id']],$request->getBody());
                App::$app->response->redirect('/admin/categories');
                exit();
            }else {
                if ($category->validate() && $category->save()) {
                    App::$app->response->redirect('/admin/categories');
                    exit();
                }
            }
        }
        if (isset($_GET['delete_id'])){
            $delete_id = $_GET['delete_id'];
            $category->delete(['cat_id'=>$delete_id]);
        }
        $mode = '';


        $categories = Category::getAll();

        return $this->render('admin_categories', ['categories'=>$categories,'model'=>$category,'mode'=>$mode]);

    }

    public function users(Request $request,Response $response)
    {
        //TODO add delete and dropdown list to status
        $users = User::getAll();
        $mode = 'show';
        $user = new User();
        if (isset($_GET['source'])){
            if ($_GET['source']=='add_user') {
                $mode = 'create';
                if ($request->method() == 'post'){
                    $user->loadData($request->getBody());
                    if ($user->validate() && $user->save()){
                        return $response->redirect('/admin/users');
                    }
                }
                return $this->render('admin_users', ['mode' => $mode,'model'=>$user]);
            }
            if ($_GET['source']=='edit_user') {
                $mode = 'edit';
                $user = User::findOne(['id'=>$_GET['edit_user_id']]);
                $user->password = '';
                if ($request->method() == 'post'){
                    $user->loadData($request->getBody());
                    //TODO need add validate (bug)
                    if ($user->update(['id'=>$_GET['edit_user_id']],$request->getBody())){
                        return $response->redirect('/admin/users');
                    }
                }
                return $this->render('admin_users', ['mode' => $mode,'model'=>$user]);
            }
            if ($_GET['source']=='change_status'){
                $user->changeStatus($_GET['user_id']);
                return $response->redirect('/admin/users');
            }
        }
        if (isset($_GET['del_id'])){
            $user->deleteUser($_GET['del_id']);
            return $response->redirect('/admin/users');
        }


        return $this->render('admin_users', ['users'=>$users,'mode'=>$mode,'model'=>$user]);

    }


}
