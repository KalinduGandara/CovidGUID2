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
use app\models\Post;

class SiteController extends Controller
{
    public function home()
    {
        $loginForm = new LoginForm();
        $guidelines = Guideline::getAll();
        $categories = Category::getAll();
        $params = [
            'guidelines'=>$guidelines,
            'categories'=>$categories,
        ];
        if (App::isGuest()){
            return $this->render('home2',$params);
        }

        return $this->render('home2',$params);

    }
    public function contact(Request $request,Response $response)
    {
        $contact = new ContactForm();
        if ($request->method() == 'post'){
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()){
                App::$app->session->setFlash('success','Thanks for contacting us');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact',[
            'model'=>$contact
        ]);
    }
    public function post(Request $request,Response $response)
    {
        $guid_id = $_GET["guid_id"];
        $guideline = Guideline::findOne(['guid_id'=>$guid_id]);
        $categories = Category::getAll();
        $params = [
            'guideline'=>$guideline,
            'categories'=>$categories,
        ];
        return $this->render('guideline',$params);
    }
}
