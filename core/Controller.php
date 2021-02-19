<?php


namespace app\core;

/**
 * Our base controller class
 * Class Controller
 * @package app\core
 */
class Controller
{
    /**
     * We render the base view with params
     * @param string $view
     * @param array $params
     * @return string|string[]
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);

    }
}