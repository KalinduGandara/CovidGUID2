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

        if ($request->method() === "post")
        {
            $formAttributes = $request->getBody();
            $havePermission = null; //will evaluate to true when officer reentered his correct email-pwd combination


//            var_dump($request->getBody());
//            exit();


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
                App::$app->response->redirect("/officer/guidelines?edit_id=" . $_GET['edit_id']);
                exit();
            }
            else
            {
                $delete_id = $formAttributes['delete_id'];
                $guideline->delete(['guid_id' => $delete_id]);
                App::$app->response->redirect('/officer/guidelines');
                exit();
            }
        }


        if (isset($_GET['delete_id'])) {
//            $guideline->delete(['guid_id' => $_GET['delete_id']]);

            App::$app->response->redirect('/officer/guidelines');
            exit();
        } elseif (isset($_GET['edit_id'])) {
            if ($request->method() === "post") {

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
                    App::$app->response->redirect("/officer/guidelines?edit_id=" . $_GET['edit_id']);
                    exit();
                }

                $guideline->update(['guid_id' => $_GET['edit_id']], $request->getBody());
                App::$app->response->redirect('/officer/guidelines');
                exit();
            }
            $guideline = Guideline::findOne(['guid_id' => $_GET['edit_id']]);
            return $this->render('officer_add_guideline', ['subcategories' => $subcategories, 'categories' => $categories, 'mode' => 'update', 'edit_guideline' => $guideline, 'display_guidelines'=> Guideline::getAll()]);
        }
        $guidelines_fetched = Guideline::getAll();
        $guidelines = [];
        foreach ($guidelines_fetched as $guideline) {
            $category =  array_search($guideline['cat_id'], array_column($categories, 'cat_id'));
            $guideline['cat_title'] = $categories[$category]['cat_title'];
            $subcategory =  array_search($guideline['sub_category_id'], array_column($subcategories, 'sub_category_id'));
            $guideline['sub_category_name'] = $subcategories[$subcategory]['sub_category_name'];
            $guidelines[] = $guideline;
        }
//        foreach ($guidelines as $subcategory) {
//            print_r($subcategory);
//            echo "<br>";
//        }
//        exit();
        return $this->render('officer_guidelines', ['subcategories'=> $subcategories,'guidelines' => $guidelines]);
    }

    public function add_guideline(Request $request, Response $response)
    {
        $categories = Category::getAll();
        $subcategories = SubCategory::getAll();
        if ($request->method() === 'post') {

            $formAttributes = $request->getBody();
//            var_dump($request->getBody());
//            exit();
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
                App::$app->response->redirect('/officer/add-guideline');
                exit();
            }

            $guideline = new Guideline();
            $guideline->loadData($request->getBody());


//            var_dump($request->getBody());
//            exit();
            if ($guideline->save()) {
//                var_dump($guideline);
//                exit();
                App::$app->response->redirect('/officer/guidelines');
//                App::$app->response->redirect('/officer/add-guideline');
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

        if ($request->method() === 'post')
        {
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
                App::$app->response->redirect('/officer/add-subcategory');
                exit();
            }
            if ($mode == 'update') {
                $subcategory->update(['sub_category_id' => $_GET['edit_id']], $request->getBody());
                App::$app->response->redirect('/officer/add-subcategory');
                exit();
            }
            else
            {
                $subcategory->loadData($request->getBody());

                if ($subcategory->validate() && $subcategory->save()) {
                    App::$app->response->redirect('/officer/add-subcategory');
                    exit();
                }
            }
        }
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $subcategory->delete(['sub_category_id' => $delete_id]);
        }

        $formAttributes = $request->getBody();

        if(isset($formAttributes['email']) && isset($formAttributes['password']))
        {
            $loginForm = new LoginForm();
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())
            {
                $delete_id = $formAttributes["delete_id"];
                $subcategory->delete(['sub_category_id' => $delete_id]);
                App::$app->response->redirect('/officer/add-subcategory');
                exit();
            }
        }

        $categories = Category::getAll();
        $subcategories = SubCategory::getAll();


        return $this->render('officer_add_subcategory', ['subcategories' => $subcategories, 'categories' => $categories, 'model' => $subcategory]);
    }
}
