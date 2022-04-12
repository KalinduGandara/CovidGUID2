<?php

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\OfficerController;
use app\controllers\SiteController;
use app\core\App;
use app\models\User;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new App(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/home', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/notification', [SiteController::class, 'notification']);


$app->router->get('/admin', [AdminController::class, 'index']);
$app->router->get('/admin/users', [AdminController::class, 'users']);
$app->router->post('/admin/users', [AdminController::class, 'users']);
$app->router->get('/admin/verify', [AdminController::class, 'verify']);
$app->router->post('/admin/verify', [AdminController::class, 'verify']);
$app->router->get('/admin/cancel-verify', [AdminController::class, 'cancel_verify']);


//officer routes
$app->router->get('/officer', [OfficerController::class, 'index']);
$app->router->get('/officer/guidelines', [OfficerController::class, 'guidelines']);
$app->router->post('/officer/guidelines', [OfficerController::class, 'guidelines']);
$app->router->post('/officer/add-guideline', [OfficerController::class, 'add_guideline']);
$app->router->get('/officer/add-guideline', [OfficerController::class, 'add_guideline']);

$app->router->get('/officer/categories', [OfficerController::class, 'category']);
$app->router->post('/officer/categories', [OfficerController::class, 'category']);
$app->router->get('/officer/add-category', [OfficerController::class, 'add_category']);
$app->router->post('/officer/add-category', [OfficerController::class, 'add_category']);

$app->router->get('/officer/subcategories', [OfficerController::class, 'subcategory']);
$app->router->post('/officer/subcategories', [OfficerController::class, 'subcategory']);

$app->router->get('/officer/add-subcategory', [OfficerController::class, 'add_subcategory']);
$app->router->post('/officer/add-subcategory', [OfficerController::class, 'add_subcategory']);


$app->router->get('/officer/verify', [OfficerController::class, 'verify']);
$app->router->post('/officer/verify', [OfficerController::class, 'verify']);
$app->router->get('/officer/cancel-verify', [OfficerController::class, 'cancel_verify']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);


$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->post('/profile', [AuthController::class, 'profile']);


$app->router->get('/subscribe', [AuthController::class, 'subscribe']);
$app->router->get('/unsubscribe', [AuthController::class, 'unsubscribe']);
$app->run();
