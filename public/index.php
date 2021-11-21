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
        'dsn' => $_ENV['DB_DSN'] . 'dbname=covidguide',
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new App(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);


$app->router->get('/post', [SiteController::class, 'post']);

$app->router->get('/admin', [AdminController::class, 'index']);
$app->router->get('/admin/guidelines', [AdminController::class, 'guidelines']);
//$app->router->post('/admin/posts',[AdminController::class,'posts']);
$app->router->get('/admin/categories', [AdminController::class, 'categories']);
$app->router->post('/admin/categories', [AdminController::class, 'categories']);
$app->router->get('/admin/users', [AdminController::class, 'users']);

//officer routes
$app->router->get('/officer', [OfficerController::class, 'index']);
$app->router->get('/officer/guidelines', [OfficerController::class, 'guidelines']);
$app->router->post('/officer/guidelines', [OfficerController::class, 'guidelines']);
$app->router->post('/officer/add-guideline', [OfficerController::class, 'add_guideline']);
$app->router->get('/officer/add-guideline',[OfficerController::class, 'add_guideline']);
//$app->router->post('/officer/posts',[OfficerController::class,'posts']);
$app->router->get('/officer/categories', [OfficerController::class, 'categories']);
$app->router->post('/officer/categories', [OfficerController::class, 'categories']);


$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);


$app->router->get('/profile', [AuthController::class, 'profile']);

$app->run();
