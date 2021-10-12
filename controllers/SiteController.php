<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Kalindu"
        ];
        return $this->render('home',$params);
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