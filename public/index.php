<?php

//phpInfo();exit;

//require_once 'core/Application.php';
//require_once 'core/Router.php';
//padarius composer dumpautoload -o terminale nebereikia

require_once '../vendor/autoload.php';

use \app\controller\SiteController;
use app\core\Application;
use app\core\AuthController;

//COMPOSER.JSON inicijuota
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

var_dump($config);

//router inicijuojamas Application dalyje


//sukuriama nauja aplikacija, kurioje aukuriamas naujas routeris(Application.php)
//kuriant nauja klase paduodama dirname
$app = new Application(dirname(__DIR__));

//CREATE POST PATH. paduodamas klases pavadinimas - kaip kontroleris, handleContact metodas - kaip metodas
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/home', [SiteController::class, 'home']);
$app->router->get('/about', [SiteController::class, 'about']);
//$app->router->get('/about', 'about'); //jei jokio funkcionalumo, tik dekoracija - g.b. string
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']); //SiteController::class  - su namespace

//routes for login
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

//routes for register
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();


