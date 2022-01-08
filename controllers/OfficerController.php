<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\middlewares\OfficerMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\Guideline;
use app\models\LoginForm;
use app\models\SubCategory;

class OfficerController extends Controller
{
    public string $layout = 'officer';
    public function __construct()
    {
        $this->registerMiddleware(new OfficerMiddleware());
    }

    public function index()
    {
        return $this->render('officer_index', []);
    }

    public function guidelines(Request $request, Response $response)
    {
        $guideline = new Guideline();
        $categories = Category::getAll();
        $subcategories = SubCategory::getAll();
        if (isset($_GET['delete_id'])) {
            $guideline->update(['guid_id' => $_GET['delete_id']], ['guid_status'=> '4']);
            App::$app->response->redirect('/officer/guidelines');
            exit();
        } elseif (isset($_GET['edit_id'])) {
            if ($request->method() === "post") {
                $data = $request->getBody();
                if(! isset($data['guid_status'])){
                    $data['guid_status'] = '0';
                }
                $guideline->update(['guid_id' => $_GET['edit_id']], $data );
                App::$app->response->redirect('/officer/guidelines');
                exit();
            }
            $guideline = Guideline::findOne(['guid_id' => $_GET['edit_id']]);
            return $this->render('officer_add_guideline', ['subcategories' => $subcategories, 'categories' => $categories, 'mode' => 'update', 'edit_guideline' => $guideline, 'display_guidelines'=> Guideline::getAll()]);
        }
        elseif (isset($_GET['draft_id'])){
            $guideline = Guideline::findOne(['guid_id'=>$_GET['draft_id']]);
            if($guideline->getGuidStatus() === '2'){
                $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '0']);
            }
            else{
                $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '2']);
            }
            App::$app->response->redirect('/officer/guidelines');
            exit();
        }

        return $this->render('officer_guidelines');
    }

    public function add_guideline(Request $request, Response $response)
    {
        $categories = Category::getAll();
        $subcategories = SubCategory::getAll();
        if ($request->method() === 'post') {
            $guideline = new Guideline();
            $guideline->loadData($request->getBody());
            if ($guideline->save()) {
                App::$app->response->redirect('/officer/guidelines');
                exit();
            } else {
                echo '<script>alert("Fail to save the guideline")</script>';
            }
        }
        return $this->render('officer_add_guideline', ['subcategories' => $subcategories, 'categories' => $categories, 'display_guidelines'=> Guideline::getAll()]);
    }

    public function categories(Request $request, Response $response)
    {
        $category = new Category();
        $mode = '';

        if (isset($_GET['edit_id'])) {
            $mode = 'update';
            $category = Category::findOne(['cat_id' => $_GET['edit_id']]);
        }
        if ($request->method() == 'post') {

            $formAttributes = $request->getBody();
            $havePermission = null; //will evaluate to true when officer reentered his correct email-pwd combination

            if(isset($formAttributes['email']) && isset($formAttributes['password']))
            {
                $loginForm = new LoginForm();
                $loginForm->loadData($request->getBody());
                if ($loginForm->validate() && $loginForm->login())
                {
                    $havePermission = true;
                }
            }

            if(!$havePermission)
            {
                App::$app->response->redirect('/officer/categories');
                exit();
            }
            $category->loadData($request->getBody());
            if ($mode == 'update') {
                $category->update(['cat_id' => $_GET['edit_id']], $request->getBody());
                App::$app->response->redirect('/officer/categories');
                exit();
            } else {
                if ($category->validate() && $category->save()) {
                    App::$app->response->redirect('/officer/categories');
                    exit();
                }
            }
        }
        if (isset($_GET['delete_id'])) {
            $formAttributes = $request->getBody();

            var_dump($request->getBody());
            echo '<script> openForm(); </script>';
            exit();

            $delete_id = $_GET['delete_id'];
            $category->delete(['cat_id' => $delete_id]);
        }
        $mode = '';


        $formAttributes = $request->getBody();

        if(isset($formAttributes['email']) && isset($formAttributes['password']))
        {
            $loginForm = new LoginForm();
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())
            {
                $delete_id = $formAttributes["delete_id"];
                $category->delete(['cat_id' => $delete_id]);
                App::$app->response->redirect('/officer/categories');
                exit();
            }
        }

        $categories = Category::getAll();

        return $this->render('officer_categories', ['categories' => $categories, 'model' => $category, 'mode' => $mode]);
    }
    public function add_subcategory(Request $request, Response $response)
    {
        $mode = "";
        $subcategory = new SubCategory();
        if (isset($_GET['edit_id'])) {
            $mode = 'update';
            $subcategory = SubCategory::findOne(['sub_category_id' => $_GET['edit_id']]);
        }

        if ($request->method() === 'post') {
            if ($mode == 'update') {
                $subcategory->update(['sub_category_id' => $_GET['edit_id']], $request->getBody());
                App::$app->response->redirect('/officer/add-subcategory');
                exit();
            }
            $subcategory->loadData($request->getBody());
            if ($subcategory->save()) {
                App::$app->response->redirect('/officer/add-subcategory');
                exit();
            }
        }
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $subcategory->delete(['sub_category_id' => $delete_id]);
        }



        $categories = Category::getAll();
        $subcategories = SubCategory::getAll();


        return $this->render('officer_add_subcategory', ['subcategories' => $subcategories, 'categories' => $categories, 'model' => $subcategory,]);
    }
}
