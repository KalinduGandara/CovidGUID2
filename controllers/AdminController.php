<?php


namespace app\controllers;


use app\core\App;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\Post;

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

    public function posts()
    {
        $posts = Post::getAll();
        $categories = Category::getAll();

        return $this->render('admin_posts', ['posts'=>$posts,'categories'=>$categories]);

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

    public function users()
    {
        return $this->render('admin_users', []);

    }


}