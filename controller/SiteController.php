<?php


namespace app\controller;


use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    /**
     *  This handles home page get request
     * @return string|string[]
     */
    public function home()
    {
        $params = [
            'name' => 'Almost Lara',
            'subtitle' => 'This is a splendid page'

        ];
        return $this->render('home', $params);
    }

    /**
     * This serves the contact form view
     * @return string
     */
    public function contact()
    {
        //RENDER VIEW (FROM ROUTER)
        return  $this->render('contact');
    }

    /**
     * This serves the contact form view
     * @return string
     */
    public function about()
    {
        $params = [
            'version' => '1.0.0'
        ];
        return $this->render('about', $params);
    }

    /**
     * This is where we handle post contact form
     * @return string
     */
    public static function handleContact(Request $request)
    {
        //we use getBody method to see user input
        $body = $request->getBody();

        var_dump($body);
//        return "Handling form from Site Controller handle form method";
    }


}