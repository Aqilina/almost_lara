<?php


namespace app\controller;


use app\core\Application;

class SiteController
{
    /**
     * This serves the contact form view
     * @return string
     */
    public static function contact()
    {
        //RENDER VIEW (FROM ROUTER)
        return Application::$app->router->renderView('contact');
    }

    /**
     * This is where we handle post contact form
     * @return string
     */
    public static function handleContact()
    {
        return "Handling form from Site Controller handle form method";
    }
}