<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\ContactForm;
use app\models\Guideline;
use app\models\LoginForm;
use app\models\Notification;
use app\models\Post;
use app\models\SubCategory;

class SiteController extends Controller
{
    public function home()
    {
        $loginForm = new LoginForm();
        $subcategories = SubCategory::getAll();
        $categories = Category::getAll();
        $guidelines = Guideline::getAll();
        $params = [
            'subcategories' => $subcategories,
            'categories' => $categories,
        ];
        if (isset($_GET['search'])){
            $search =  $_GET['search'];
            $result = SubCategory::searchBy(["sub_category_name"=>$search]);
            $params = ['subcategories' => $result, 'guidelines' => $guidelines, 'categories' => $categories,];
            return $this->render('search_sub_category',$params);
        }
        if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $category = Category::findOne(['cat_id' => $cat_id]);

            $params = [
                'category' => $category, 'subcategories' => $subcategories, 'guidelines' => $guidelines, 'categories' => $categories,

            ];
            return $this->render('subcategory', $params);
        }

        return $this->render('home2', $params);
    }
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->method() == 'post') {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                App::$app->session->setFlash('success', 'Thanks for contacting us');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
    public function post(Request $request, Response $response)
    {
        $guid_id = $_GET["guid_id"];
        $guideline = Guideline::findOne(['guid_id' => $guid_id]);
        $categories = Category::getAll();
        $params = [
            'guideline' => $guideline,
            'categories' => $categories,
        ];
        return $this->render('guideline', $params);
    }

    public function notification()
    {
        return Notification::getNotifications();
    }
}
