<?php
//require_once 'core/Application.php';
//require_once 'core/Router.php';
//padarius composer dumpautoload -o terminale nebereikia

require_once 'vendor/autoload.php';

use app\core\Application;
use app\core\Router;

$app = new Application();
$router = new Router();

//$router->get('/', function () {
//    return "this is home page";
//});
//
//$router->get('/about', function () {
//    return "this is about page";
//});

//$app->run();