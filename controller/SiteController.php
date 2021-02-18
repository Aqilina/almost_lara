<?php


namespace app\controller;


use app\core\Application;

class SiteController
{
    /**
     *  This handles home page get request
     * @return string|string[]
     */
    public static function home()
    {
        $params = [
            'name' => 'Almost Lara',
            'subtitle' => 'This is a splendid page'

        ];
        return Application::$app->router->renderView('home', $params);
    }

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