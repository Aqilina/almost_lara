<?php


namespace app\core;

/**
 * Class Router
 *
 * This is where we call controllers and methods
 *
 * @package app\core
 */
class Router
{
    /**
     * This will hold all routes.
     *
     * taip atrodys routes masyvas:
     * routes = [
     *
     * ['get => [
     *  ['/' => function return],
     *  ['/about' => function return],
     * ],
     *
     * ['post' => [
     *  ['/' => function return],
     *  ['/contact' => function return],
     * ]
     * ]
     *
     * @var array
     */
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Adds get route and callback fn to routes array
     * @param string $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * This creates post path and handling in routes array
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

//----------------------------------------------------------------------------------------------------------------------
    /**
     * executes user function if it is set in routes array
     */
    //NORIM IVYKDYTI, KO KLIENTAS PRASE. paziurim koki path ir method klientas naudojo ir ar atitinka
    //tikrinama ar $callback stringa, array ar - g.b. function
    public function resolve()
    {
        //GAUNAMAS KELIAS PO "LOCALHOST"
        $path = $this->request->getPath();
        $method = $this->request->method();

//        var_dump($method);
//        var_dump($path);
//        N.B.!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//        var_dump($this->routes);

        //TRYING TO RUN A ROUTES FROM ROUTES ARR
        $callback = $this->routes[$method][$path] ?? false; // jei bandys ivykdyti kelia, kurio nera

        //IF THERE ARE NO SUCH ROUTE ADDED
        if ($callback === false) :
            //404 error sukurti
            $this->response->setResponseCode(404);
           return $this->renderView('_404');

        endif;

        //IF CALLBACK VALUE IS STRING
        //$app->router->get('/about', 'about'); (index.php)
        if (is_string($callback)) :
            return $this->renderView($callback);
        endif;

        //IF $CALLBACK VALUE IS ARRAY (than handle with class instance)
        if (is_array($callback)) :
            //$callback yra array - jis ateina is index.php - ten paduodamas masyvas
            $instance = new $callback[0]; //sukuriama nauja
            Application::$app->controller = $instance; //handleContact iskvieciam
            $callback[0] =  Application::$app->controller;
//            var_dump($callback);
        endif;

        //IF PAGE EXIST
        return call_user_func($callback, $this->request); //

//        var_dump($_SERVER);
//        var_dump($this->request->getPath());
//        var_dump($this->routes);
    }

//-----------------------------------------------------------------------------------------------------------------------

    /**
     * renders the page and applies the layout
     * @param string $view
     * @return string|string[]
     */
    //sujungiami layout ir content is zemiau esanciu f-ju
    public function renderView(string $view, array $params =  [])
    {
        //universalus budas kaip nurodyti kelia iki direktorijos (kaip anksciau config faile APPROOT)
        $layout = $this->layoutContent(); //includina main php
        $page = $this->pageContent($view, $params);

//        echo $layout;
//        echo $page;

        //take layout and replace the {{content}} with the $page content
        return str_replace('{{content}}', $page, $layout);
    }

//-----------------------------------------------------------------------------------------------------------------------
    /**
     * Returns the layout HTML content
     * @return false|string
     */
    //grazina kas yra layout'e. gauti $layoyout reikalinga renderView f-jai
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        //start buffering - iraso, kas bus isspjauta
        ob_start(); //paima i atminti
        include_once Application::$ROOT_DIR . "/view/layout/$layout.php";
        //stop and return buffering
        return ob_get_clean(); // grazina i iskvietimo vieta viska
    }

//-----------------------------------------------------------------------------------------------------------------------
    /**
     * Returns given page HTML content
     * @param $view
     * @return false|string
     */
    //grazina kas yra page'e. gauti $page reikalinga renderView f-jai
    //TIK VIEAM VIEW ABOUT(SITECONTROLLER)???
    protected function pageContent($view, $params)
    {
        //a smart way of creating variables dynamically
        //        $name = $params['name'];
        foreach ($params as $key => $param) :
            $$key = $param;
        endforeach;
//        var_dump($params); //$params is SiteController

        //start buffering
        ob_start();
        include_once Application::$ROOT_DIR . "/view/$view.php";
        return ob_get_clean();
    }
}