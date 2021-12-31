<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\ContactForm;
use app\models\Guideline;
use app\models\Notification;
use app\models\SubCategory;
use app\models\User;

class SiteController extends Controller
{
    public function home()
    {
        $unseenNotifications = 0;
        $notifications = Notification::getNotifications();
        foreach ($notifications as $notification) {
            if ($notification->status == 0) $unseenNotifications++;
        }

        $guidelines = Guideline::getAll();
        $params = [
            'unseenNotifications' => $unseenNotifications,
            'notifications' => $notifications,
        ];
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $result = SubCategory::searchBy(["sub_category_name" => $search]);
            $params = ['unseenNotifications' => $unseenNotifications,
                'notifications' => $notifications,
                'subcategories' => $result,
                'guidelines' => $guidelines,
            ];
            return $this->render('search_sub_category', $params);
        }
        if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $category = Category::findOne(['cat_id' => $cat_id]);
            if (isset($_GET['read']) && isset($_GET['not_id'])) {
                if ($_GET['read'] == 0) {
                    Notification::markAsRead($_GET['not_id']);
                }
            }
            $unseenNotifications = 0;
            $notifications = Notification::getNotifications();
            foreach ($notifications as $notification) {
                if ($notification->status == 0) $unseenNotifications++;
            }

            $params = [
                'unseenNotifications' => $unseenNotifications, 'notifications' => $notifications
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
        App::$app->user->getSubscribeList();
        if (!App::isGuest())
            echo '<pre>';
        var_dump(Notification::getNotifications());
        echo '</pre>';
        exit();
        return Notification::getNotifications();
    }
}
