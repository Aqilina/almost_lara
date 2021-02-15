<?php

$app = new Application();

$router = new Router();

$router->get('/', function () {
    return "this is home page";
});

$router->get('/about', function () {
    return "this is about page";
});

$app->run();