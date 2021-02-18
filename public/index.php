<?php

//phpInfo();exit;

//require_once 'core/Application.php';
//require_once 'core/Router.php';
//padarius composer dumpautoload -o terminale nebereikia

require_once '../vendor/autoload.php';

use \app\controller\SiteController;
use app\core\Application; //router inicijuojamas Application dalyje


//sukuriama nauja aplikacija, kurioje aukuriamas naujas routeris(Application.php)
//kuriant nauja klase paduodama dirname
$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/about', 'about');
$app->router->get('/contact', [SiteController::class, 'contact']);

//CREATE POST PATH. paduodamas klases pavadinimas - kaip kontroleris, handleContact metodas - kaip metodas
$app->router->post('/contact', [SiteController::class, 'handleContact']); //SiteController::class  - su namespace
$app->run();


