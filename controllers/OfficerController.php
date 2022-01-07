<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\db\DbModel;
use app\core\middlewares\ActiveMiddleware;
use app\core\middlewares\OfficerMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\Guideline;
use app\models\LoginForm;
use app\models\Notification;
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
        $categories = Category::getAll();
        $subcategories = SubCategory::getAll();
        if (isset($_GET['delete_id'])) {
            if(App::$app->session->get('VERIFIED') === 'TRUE') {
                App::$app->session->unset_key('VERIFIED');

                $guideline->update(['guid_id' => $_GET['delete_id']], ['guid_status' => '4']);
                Notification::addNotification(Guideline::getCategoryID($_GET['delete_id']), Notification::DELETE_NOTIFICATION, Notification::GUIDELINE);
                App::$app->response->redirect('/officer/guidelines');
                exit();

            }
            return $this->requireVerifivation();
        }
        elseif (isset($_GET['edit_id'])) {
            if(App::$app->session->get('VERIFIED') === 'TRUE'){
                if ($request->method() === "post") {
                    $data = $request->getBody();
                    if(! isset($data['guid_status'])){
                        $data['guid_status'] = '0';
                    }
                    $guideline->update(['guid_id' => $_GET['edit_id']], $data );
                    Notification::addNotification(Guideline::getCategoryID($_GET['edit_id']),Notification::UPDATE_NOTIFICATION,Notification::GUIDELINE);
                    App::$app->session->unset_key('VERIFIED');
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                }

                return $this->render('officer_add_guideline');
            }
            return $this->requireVerifivation();

        }
        elseif (isset($_GET['draft_id'])){
            if(App::$app->session->get('VERIFIED') === 'TRUE'){
                App::$app->session->unset_key('VERIFIED');

                $guideline = Guideline::findOne(['guid_id'=>$_GET['draft_id']]);
                if($guideline->getGuidStatus() === '2'){
                    $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '0']);
                }
                else{
                    $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '2']);
                }
                App::$app->response->redirect('/officer/guidelines');
                exit();
            }

            return $this->requireVerifivation();

        }

        return $this->render('officer_guidelines');
    }

    public function add_guideline(Request $request, Response $response)
    {
        if(App::$app->session->get('VERIFIED') === 'TRUE'){
            if ($request->method() === 'post') {
                App::$app->session->unset_key('VERIFIED');
                $guideline = new Guideline();
                $guideline->loadData($request->getBody());
                if ($guideline->save()) {
                    Notification::addNotification(Guideline::getCategoryID(DbModel::lastInsertID()),Notification::CREATE_NOTIFICATION,Notification::GUIDELINE);
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                } else {
                    echo '<script>alert("Fail to save the guideline")</script>';
                }
            }
            return $this->render('officer_add_guideline');
        }
        return $this->requireVerifivation();

    }

    public function category(Request $request, Response $response)
    {
        $category = new Category();

        if ($request->method() == 'post') {
            $category->loadData($request->getBody());
            $category->update(['cat_id' => $_GET['edit_id']], $request->getBody());
            App::$app->response->redirect('/officer/categories');
            exit();
        }
        if (isset($_GET['edit_id'])) {
            $this->verifyUser($request,$response);
            $category = Category::findOne(['cat_id' => $_GET['edit_id']]);
        }
        if (isset($_GET['delete_id'])) {
            $this->verifyUser($request,$response);
            $delete_id = $_GET['delete_id'];
            $category->delete(['cat_id' => $delete_id]);
        }
        return $this->render('officer_categories', [ 'model' => $category]);
    }
    public function add_category(Request $request, Response $response)
    {
        $category = new Category();
        if ($request->method() == 'post') {
            $category->loadData($request->getBody());
            if ($category->validate() && $category->save()) {
                App::$app->response->redirect('/officer/categories');
                exit();
            }
        }
        $this->verifyUser($request,$response);
        return $this->render('officer_add_category', ['model' => $category]);
    }
    public function subcategory(Request $request, Response $response)
    {
        $subcategory = new SubCategory();
        if ($request->method() === 'post') {
            $subcategory->update(['sub_category_id' => $_GET['edit_id']], $request->getBody());
            Notification::addNotification(SubCategory::getCategoryID($_GET['edit_id']), Notification::UPDATE_NOTIFICATION, Notification::SUB_CATEGORY);
            App::$app->response->redirect('/officer/subcategories');
            exit();
        }
        if (isset($_GET['delete_id'])) {
            $this->verifyUser($request,$response);
            $delete_id = $_GET['delete_id'];
            $cat_id = SubCategory::getCategoryID($_GET['delete_id']);
            $subcategory->delete(['sub_category_id' => $delete_id]);
            Notification::addNotification($cat_id,Notification::DELETE_NOTIFICATION,Notification::SUB_CATEGORY);
        }
        if (isset($_GET['edit_id'])) {
            $subcategory = SubCategory::findOne(['sub_category_id' => $_GET['edit_id']]);
            $this->verifyUser($request,$response);
        }
        return $this->render('officer_subcategory', ['model' => $subcategory]);
    }
    public function add_subcategory(Request $request, Response $response)
    {
        $subcategory = new SubCategory();
        $subcategory->loadData($request->getBody());
        if ($request->method() === 'post') {
            if ($subcategory->validate() && $subcategory->save()) {
                Notification::addNotification(SubCategory::getCategoryID(DbModel::lastInsertID()), Notification::CREATE_NOTIFICATION, Notification::SUB_CATEGORY);
                App::$app->response->redirect('/officer/subcategories');
                exit();
            }
        }
        $this->verifyUser($request,$response);
        return $this->render('officer_add_subcategory', ['model' => $subcategory,]);

    }

    public function verify(Request $request, Response $response){
        if(password_verify($_POST['verify'],App::$app->user->getPassword()) ){
            App::$app->session->set('VERIFIED','TRUE');
            $request = App::$app->session->get('REQUEST');
            App::$app->session->unset_key('REQUEST');
            $response->redirect($request);
            exit();
        }
        throw new \Error("Unauthorized Access", 403);

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

    /**
     * @param $callback
     * @param $failed
     * @return
     */
    private function requireVerifivation(){
        App::$app->session->set('REQUEST', App::$app->request->getRequest());
        $this->setLayout('main');
        return $this->render('officer_verify');
    }
}
