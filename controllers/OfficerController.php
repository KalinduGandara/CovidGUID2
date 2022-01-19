<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\db\DbModel;
use app\core\middlewares\ActiveMiddleware;
use app\core\middlewares\OfficerMiddleware;
use app\core\middlewares\VerifyMiddleware;
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
        $this->registerMiddleware(new VerifyMiddleware(['verify']));
    }

    public function index()
    {
        return $this->render('officer_index', []);
    }

    public function guidelines(Request $request, Response $response)
    {
        $guideline = new Guideline();

        if (isset($_GET['delete_id'])) {
            $this->verifyUser($request,$response);

                $guideline->update(['guid_id' => $_GET['delete_id']], ['guid_status' => '4']);
                Notification::addNotification(Guideline::getCategoryID($_GET['delete_id']), Notification::DELETE_NOTIFICATION, Notification::GUIDELINE);
                App::$app->response->redirect('/officer/guidelines');
                exit();

        } elseif (isset($_GET['edit_id'])) {
            $guideline = Guideline::findOne(['guid_id'=>$_GET['edit_id']]);
            if ($request->method() === "post") {
                $this->verifyUser($request,$response);
                $data = $this->getFormData();
                if (!isset($data['guid_status'])) {
                    $data['guid_status'] = '0';
                }
                $guideline->loadData($data);
                if ($data['guid_status'] === '2'){// if draft then don't validate
                    $guideline->update(['guid_id' => $_GET['edit_id']], $data);
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                }
                if ($guideline->validate() && $guideline->update(['guid_id' => $_GET['edit_id']], $data)) {
                    Notification::addNotification(Guideline::getCategoryID($_GET['edit_id']), Notification::UPDATE_NOTIFICATION, Notification::GUIDELINE);
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                }
            }

            return $this->render('officer_add_guideline',['model'=>$guideline]);

        } elseif (isset($_GET['draft_id'])) {
            $this->verifyUser($request,$response);
                $guideline = Guideline::findOne(['guid_id' => $_GET['draft_id']]);
                if ($guideline->getGuidStatus() === '2') {
                    $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '0']);
                } else {
                    $guideline->update(['guid_id' => $_GET['draft_id']], ['guid_status' => '2']);
                }
                App::$app->response->redirect('/officer/guidelines');
                exit();

        }

        return $this->render('officer_guidelines');
    }

    public function add_guideline(Request $request, Response $response)
    {

        $guideline = new Guideline();
        if ($request->method() === 'post') {
                $this->verifyUser($request,$response);
                $data = $this->getFormData();
                $guideline->loadData($data);
                if ($data['guid_status'] === '2'){// if draft then don't validate
                    $guideline->save();
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                }
                if ($guideline->validate() && $guideline->save()) {
                    Notification::addNotification(Guideline::getCategoryID(DbModel::lastInsertID()), Notification::CREATE_NOTIFICATION, Notification::GUIDELINE);
                    App::$app->response->redirect('/officer/guidelines');
                    exit();
                }

        }
        return $this->render('officer_add_guideline',['model'=>$guideline]);


    }

    public function category(Request $request, Response $response)
    {
        $category = new Category();


        if (isset($_GET['edit_id'])) {
            $category = CategoryProxy::getById($_GET['edit_id'])->getCategoryObject();
            if ($request->method() === "post") {
                $this->verifyUser($request,$response);
                $data = $this->getFormData();
                $category->loadData($data);
                if ($category->validate() && $category->update(['cat_id' => $_GET['edit_id']], $data)){
                    App::$app->response->redirect('/officer/categories');
                    exit();
                }
            }
            return $this->render('officer_add_category', ['model' => $category]);
        }

        if (isset($_GET['delete_id'])) {
            $this->verifyUser($request,$response);
                foreach (SubCategory::getAllWhere(['cat_id'=> $_GET['delete_id'], 'sub_category_status'=>'0']) as $subCategory){
                    foreach (Guideline::getAllWhere(['sub_category_id'=> $subCategory->getSubCategoryId()]) as $guideline){
                        $guidelineView = new \app\views\components\guideline\OfficerGuideline($guideline);
                        $guidelineView->getState()->delete($guidelineView);
                    }
                    $subCategory->update(['sub_category_id'=> $subCategory->getSubCategoryId()],['sub_category_status'=>'1']);
                }

                $category->update(['cat_id' => $_GET['delete_id']], ['cat_status' => '1']);
                App::$app->response->redirect('/officer/categories');
                exit();
        }
        return $this->render('officer_categories', ['model' => $category]);
    }

    public function add_category(Request $request, Response $response)
    {
        $category = new Category();

        if ($request->method() === 'post') {
            $this->verifyUser($request,$response);
                $category->loadData($this->getFormData());
                if ($category->validate() && $category->save()) {
                    App::$app->response->redirect('/officer/categories');
                    exit();
                }
        }
        return $this->render('officer_add_category', ['model' => $category]);

    }

    public function subcategory(Request $request, Response $response)
    {
        $subcategory = new SubCategory();

        if (isset($_GET['edit_id'])) {
            $subcategory = SubcategoryProxy::getById($_GET['edit_id'])->getSubcategoryObject();
            if ($request->method() === "post") {
                $this->verifyUser($request,$response);
                $subcategory->loadData($this->getFormData());
                if ($subcategory->validate() && $subcategory->update(['sub_category_id' => $_GET['edit_id']], $request->getBody())) {
                    Notification::addNotification(SubCategory::getCategoryID($_GET['edit_id']), Notification::UPDATE_NOTIFICATION, Notification::SUB_CATEGORY);
                    App::$app->response->redirect('/officer/subcategories');
                    exit();
                }
            }
            return $this->render('officer_add_subcategory', ['model' => $subcategory]);
        }

        if (isset($_GET['delete_id'])) {
            $this->verifyUser($request,$response);
                foreach (Guideline::getAllWhere(['sub_category_id'=> $_GET['delete_id']]) as $guideline){
                    $guidelineView = new \app\views\components\guideline\OfficerGuideline($guideline);
                    $guidelineView->getState()->delete($guidelineView);
                }

                $subcategory->update(['sub_category_id' => $_GET['delete_id']], ['sub_category_status' => '1']);
                Notification::addNotification(SubCategory::getCategoryID($_GET['delete_id']), Notification::DELETE_NOTIFICATION, Notification::SUB_CATEGORY);
                App::$app->response->redirect('/officer/subcategories');
                exit();

        }

        return $this->render('officer_subcategory', ['model' => $subcategory]);
    }

    public function add_subcategory(Request $request, Response $response)
    {
        $subcategory = new SubCategory();
        $subcategory->loadData($request->getBody());
        if ($request->method() === 'post') {
            $this->verifyUser($request,$response);
                $subcategory->loadData($this->getFormData());
                if ($subcategory->validate() && $subcategory->save()) {
                    Notification::addNotification(SubCategory::getCategoryID(DbModel::lastInsertID()), Notification::CREATE_NOTIFICATION, Notification::SUB_CATEGORY);
                    App::$app->response->redirect('/officer/subcategories');
                    exit();
                }
        }
        return $this->render('officer_add_subcategory', ['model' => $subcategory,]);
    }

    public function verify(Request $request, Response $response)
    {
        if ($request->method() === 'post') {
            if (password_verify($_POST['verify'], App::$app->user->getPassword())) {
                App::$app->session->set('VERIFIED', 'TRUE');
                $request_prev = unserialize(App::$app->session->get('REQUEST'));
                App::$app->session->unset_key('REQUEST');
                App::$app->session->unset_key('fail');

                //setting the previous request and resolving it
                App::$app->session->set('FORM_DATA',$request_prev->getBody());
                $response->temporaryRedirect($request_prev->getRequestURI());
                exit();
            }
        }
        if (App::$app->session->get('fail'))
            return $this->render('officer_verify',['fail'=>true]);
        App::$app->session->set('fail', true);
        return $this->render('officer_verify',['fail'=>false]);
    }

    public function cancel_verify(Request $request, Response $response)
    {
        $request_prev = unserialize(App::$app->session->get('REQUEST'));
        App::$app->session->unset_key('REQUEST');
        App::$app->session->unset_key('fail');

        $response->redirect($request_prev->getPath());
    }

    private function verifyUser(Request $request, Response $response)
    {
        if(App::$app->session->get('VERIFIED') === 'TRUE') {
            App::$app->session->unset_key('VERIFIED');
        }
        else {
            App::$app->session->set('REQUEST', serialize($request));
            App::$app->session->set('fail',false);
            $response->redirect('/officer/verify');
            exit();
        }
    }

    private function getFormData():array
    {
        return App::$app->session->get('FORM_DATA');
    }
}
