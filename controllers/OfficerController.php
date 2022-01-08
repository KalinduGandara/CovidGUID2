<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\db\DbModel;
use app\core\middlewares\ActiveMiddleware;
use app\core\middlewares\OfficerMiddleware;
use app\core\Request;
use app\core\Response;
use app\core\Router;
use app\models\Category;
use app\models\Guideline;
use app\models\LoginForm;
use app\models\Notification;
use app\models\proxy\CategoryProxy;
use app\models\proxy\SubcategoryProxy;
use app\models\SubCategory;

class OfficerController extends Controller
{
    public string $layout = 'officer';

    public function __construct()
    {
        $this->registerMiddleware(new OfficerMiddleware());
        $this->registerMiddleware(new ActiveMiddleware());

    }

    public function index()
    {
        return $this->render('officer_index', []);
    }

    public function guidelines(Request $request, Response $response)
    {
        $guideline = new Guideline();

        $query = mb_split("&", parse_url($request->getRequestURI(), PHP_URL_QUERY));
        if (!empty($query)) foreach ($query as $qr) {
            $vars = mb_split('=', $qr);
            if ($vars[0] != null)
                $_GET[$vars[0]] = $vars[1];
        }

        if (isset($_GET['delete_id'])) {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');

                $guideline->update(['guid_id' => $_GET['delete_id']], ['guid_status' => '4']);
                Notification::addNotification(Guideline::getCategoryID($_GET['delete_id']), Notification::DELETE_NOTIFICATION, Notification::GUIDELINE);
                App::$app->response->redirect('/officer/guidelines');
                exit();

            }
            return $this->requireVerification($request);
        } elseif (isset($_GET['edit_id'])) {
            if ($request->method() === "post") {
                $request->setRequestUri("/officer/add-guideline?edit_id=" . $_GET['edit_id']);
                $request->setPath("/officer/add-guideline");
                App::$app->run();
                exit();
            }

            return $this->render('officer_add_guideline');

        } elseif (isset($_GET['draft_id'])) {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');

                $guideline = Guideline::findOne(['guid_id' => $_GET['draft_id']]);
                if ($guideline->getGuidStatus() === '2') {
                    $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '0']);
                } else {
                    $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '2']);
                }
                App::$app->response->redirect('/officer/guidelines');
                exit();
            }

            return $this->requireVerification($request);

        }

        return $this->render('officer_guidelines');
    }

    public function add_guideline(Request $request, Response $response)
    {

        if ($request->method() === 'post') {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');

                $guideline = new Guideline();

                $query = mb_split("&", parse_url($request->getRequestURI(), PHP_URL_QUERY));
                if (!empty($query)) foreach ($query as $qr) {
                    $vars = mb_split('=', $qr);
                    if ($vars[0] != null)
                        $_GET[$vars[0]] = $vars[1];
                }

                if (isset($_GET["edit_id"])) {
                    $data = $request->getBody();
                    if (!isset($data['guid_status'])) {
                        $data['guid_status'] = '0';
                    }
                    $guideline->update(['guid_id' => $_GET['edit_id']], $data);
                    Notification::addNotification(Guideline::getCategoryID($_GET['edit_id']), Notification::UPDATE_NOTIFICATION, Notification::GUIDELINE);
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                }

                $guideline->loadData($request->getBody());
                if ($guideline->save()) {
                    Notification::addNotification(Guideline::getCategoryID(DbModel::lastInsertID()), Notification::CREATE_NOTIFICATION, Notification::GUIDELINE);
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                } else {
                    echo '<script>alert("Fail to save the guideline")</script>';
                }
            }
            return $this->requireVerification($request);
        }
        return $this->render('officer_add_guideline');


    }

    public function category(Request $request, Response $response)
    {
        $category = new Category();

        $query = mb_split("&", parse_url($request->getRequestURI(), PHP_URL_QUERY));
        if (!empty($query)) foreach ($query as $qr) {
            $vars = mb_split('=', $qr);
            if ($vars[0] != null)
                $_GET[$vars[0]] = $vars[1];
        }

        if (isset($_GET['edit_id'])) {
            if ($request->method() === "post") {
                $request->setRequestUri("/officer/add-category?edit_id=" . $_GET['edit_id']);
                $request->setPath("/officer/add-category");
                App::$app->run();
                exit();
            }

            return $this->render('officer_add_category', ['model' => CategoryProxy::getById($_GET['edit_id'])->getCategoryObject()]);
        }

        if (isset($_GET['delete_id'])) {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');

                $category->update(['cat_id' => $_GET['delete_id']], ['cat_status' => '1']);
                App::$app->response->redirect('/officer/categories');
                exit();

            }
            return $this->requireVerification($request);
        }
        return $this->render('officer_categories', ['model' => $category]);
    }

    public function add_category(Request $request, Response $response)
    {
        $category = new Category();

        if ($request->method() === 'post') {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');
                $query = mb_split("&", parse_url($request->getRequestURI(), PHP_URL_QUERY));
                if (!empty($query)) foreach ($query as $qr) {
                    $vars = mb_split('=', $qr);
                    if ($vars[0] != null)
                        $_GET[$vars[0]] = $vars[1];
                }

                if (isset($_GET["edit_id"])) {
                    $data = $request->getBody();
                    $category->update(['cat_id' => $_GET['edit_id']], $data);
                    App::$app->response->redirect('/officer/categories');
                    exit();
                }

                $category->loadData($request->getBody());
                if ($category->save()) {
                    App::$app->response->redirect('/officer/categories');
                    exit();
                } else {
                    echo '<script>alert("Fail to save the category")</script>';
                }
            }
            return $this->requireVerification($request);
        }
        return $this->render('officer_add_category', ['model' => $category]);

    }

    public function subcategory(Request $request, Response $response)
    {
        $subcategory = new SubCategory();

        if (isset($_GET['edit_id'])) {
            if ($request->method() === "post") {
                $request->setRequestUri("/officer/add-subcategory?edit_id=" . $_GET['edit_id']);
                $request->setPath("/officer/add-subcategory");
                App::$app->run();
                exit();
            }

            return $this->render('officer_add_subcategory', ['model' => SubcategoryProxy::getById($_GET['edit_id'])->getSubcategoryObject()]);
        }

        if (isset($_GET['delete_id'])) {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');

                $subcategory->update(['sub_category_id' => $_GET['delete_id']], ['sub_category_status' => '1']);
                Notification::addNotification($cat_id, Notification::DELETE_NOTIFICATION, Notification::SUB_CATEGORY);
                App::$app->response->redirect('/officer/subcategories');
                exit();

            }
            return $this->requireVerification($request);
        }

        return $this->render('officer_subcategory', ['model' => $subcategory]);
    }

    public function add_subcategory(Request $request, Response $response)
    {
        $subcategory = new SubCategory();
        $subcategory->loadData($request->getBody());
        if ($request->method() === 'post') {
            if (App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');
                $query = mb_split("&", parse_url($request->getRequestURI(), PHP_URL_QUERY));
                if (!empty($query)) foreach ($query as $qr) {
                    $vars = mb_split('=', $qr);
                    if ($vars[0] != null)
                        $_GET[$vars[0]] = $vars[1];
                }

                if (isset($_GET["edit_id"])) {
                    $subcategory->update(['sub_category_id' => $_GET['edit_id']], $request->getBody());
                    Notification::addNotification(SubCategory::getCategoryID($_GET['edit_id']), Notification::UPDATE_NOTIFICATION, Notification::SUB_CATEGORY);
                    App::$app->response->redirect('/officer/subcategories');
                    exit();
                }

                $subcategory->loadData($request->getBody());
                if ($subcategory->validate() && $subcategory->save()) {
                    Notification::addNotification(SubCategory::getCategoryID(DbModel::lastInsertID()), Notification::CREATE_NOTIFICATION, Notification::SUB_CATEGORY);
                    App::$app->response->redirect('/officer/subcategories');
                    exit();
                } else {
                    echo '<script>alert("Fail to save the subcategory")</script>';
                }
            }
            return $this->requireVerification($request);
        }
        return $this->render('officer_add_subcategory', ['model' => $subcategory,]);

    }

    public function verify(Request $request, Response $response)
    {
        if (password_verify($_POST['verify'], App::$app->user->getPassword())) {
            App::$app->session->set('VERIFIED', 'TRUE');
            $request_prev = unserialize(App::$app->session->get('REQUEST'));
            App::$app->session->unset_key('REQUEST');

            //setting the previous request and resolving it
            App::$app->router->request = $request_prev;
            App::$app->run();

            exit();
        }
        throw new \Error("Invalid Password", 403);

    }
    private function verifyUser(Request $request, Response $response)
    {
        if ($request->method() == 'post') return ;
        if(App::$app->session->get('VERIFIED') === 'TRUE') {
            App::$app->session->unset_key('VERIFIED');
            return true;
        }
        else {
            echo $this->requireVerifivation();
            exit();
        }
    }

    private
    function requireVerification(Request $request)
    {
        App::$app->session->set('REQUEST', serialize($request));
        $this->setLayout('main');
        return $this->render('officer_verify');
    }
}
