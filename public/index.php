<?php

//phpInfo();exit;

//require_once 'core/Application.php';
//require_once 'core/Router.php';
//padarius composer dumpautoload -o terminale nebereikia

require_once '../vendor/autoload.php';

use app\core\Application; //router inicijuojamas Application dalyje


//sukuriama nauja aplikacija, kurioje aukuriamas naujas routeris(Application.php)
$app = new Application();

$app->router->get('/', function () {
    return "this is home page";
});


$app->router->get('/about', 'about');

$app->run();