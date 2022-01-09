<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\models\Notification;

class SiteController extends Controller
{
    public function home()
    {
        $params = [];
        if (isset($_GET['search'])) {
            return $this->render('search_sub_category', $params);
        }
        if (isset($_GET['cat_id'])) {
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

    public function notification(Request $request, Response $response)
    {
        if (isset($_GET['not_id'])) {
            if ($_GET['not_id'] == 'all'){
                Notification::markAllAsRead();
                $response->redirect('/');
            }else {
                Notification::markAsRead($_GET['not_id']);
                if (isset($_GET['cat_id']))
                    $response->redirect('/home?cat_id='.$_GET['cat_id']);
                else
                    $response->redirect('/notification');
            }
            exit();
        }
        return $this->render('notifications',[]);
    }

    public function index(Request $request, Response $response){
        if (!App::isGuest())
            return $response->redirect('/home');
        $this->setLayout('main');
        return $this->render('landing');
    }
}
