<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\models\LoginForm;

class SiteController extends Controller
{
    public function home()
    {
        $loginForm = new LoginForm();
        $posts = \app\models\Post::getAllWhere(['post_status'=>'published']);
        $categories = \app\models\Category::getAll();
        $params = [
            'name' => "Kalindu",
            'posts'=>$posts,
            'categories'=>$categories,
            'model'=>$loginForm
        ];
//        $this->setLayout('main2');
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
}