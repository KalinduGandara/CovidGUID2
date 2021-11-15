<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Post;

class SiteController extends Controller
{
    public function home()
    {
        $loginForm = new LoginForm();
        $posts = Post::getAllWhere(['post_status'=>'published']);
        $categories = Category::getAll();
        $params = [
            'name' => "Kalindu",
            'posts'=>$posts,
            'categories'=>$categories,
            'model'=>$loginForm
        ];
//        $this->setLayout('main2');
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
        $post_id = $_GET["post_id"];
        $post = Post::findOne(['post_id'=>$post_id]);
        $categories = Category::getAll();
        $params = [
//            'name' => "Kalindu",
            'post'=>$post,
            'categories'=>$categories,
//            'model'=>$loginForm
        ];
        return $this->render('post',$params);
    }
}