<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\Guideline;

class OfficerController extends Controller
{
    public string $layout = 'officer';
    public function __construct()
    {
    }

    public function index()
    {
        return $this->render('officer_index', []);
    }

    public function guidelines()
    {
        $guidelines_fetched = Guideline::getAll();
        $guidelines = [];
        $categories = Category::getAll();
        foreach ($guidelines_fetched as $guideline) {
            $category =  array_search($guideline['cat_id'], array_column($categories, 'cat_id'));
            $guideline['cat_title'] = $categories[$category]['cat_title'];
            $guidelines[] = $guideline;
        }
        return $this->render('officer_guidelines', ['guidelines' => $guidelines]);
    }

    public function add_guideline(Request $request, Response $response)
    {
        if ($request->method() === 'post') {
            $guideline = new Guideline();
            $guideline->loadData($request->getBody());
            if ($guideline->save()) {
            }
        }
        $categories = Category::getAll();
        return $this->render('officer_add_guideline', ['categories' => $categories]);
    }

    public function categories(Request $request, Response $response)
    {
        $category = new Category();
        if ($request->method() == 'post') {
            if (isset($_GET['edit_id'])) {
                $category = Category::findOne(['cat_id' => $_GET['edit_id']]);
                $category->loadData($request->getBody());
                $category->update(['cat_id' => $_GET['edit_id']], $request->getBody());
                App::$app->response->redirect('/officer/categories');
                exit();
            } else {
                $category->loadData($request->getBody());
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
        $categories = Category::getAll();
        return $this->render('officer_categories', ['categories' => $categories, 'model' => $category, 'mode' => '']);
    }
}
