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
            $guideline->delete(['guid_id' => $_GET['delete_id']]);
            App::$app->response->redirect('/officer/guidelines');
            exit();
        } elseif (isset($_GET['edit_id'])) {
            if ($request->method() === "post") {
                $guideline->update(['guid_id' => $_GET['edit_id']], $request->getBody());
                App::$app->response->redirect('/officer/guidelines');
                exit();
            }
            $guideline = Guideline::findOne(['guid_id' => $_GET['edit_id']]);
            return $this->render('officer_add_guideline', ['subcategories' => $subcategories, 'categories' => $categories, 'mode' => 'update', 'guideline' => $guideline]);
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
        return $this->render('officer_guidelines', ['guidelines' => $guidelines]);
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
        return $this->render('officer_add_guideline', ['subcategories' => $subcategories, 'categories' => $categories]);
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
            $delete_id = $_GET['delete_id'];
            $category->delete(['cat_id' => $delete_id]);
        }
        $mode = '';


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
