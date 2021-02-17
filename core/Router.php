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
     *  ['/about' => function return],
     * ]
     * ]
     *
     * @var array
     */
    protected array $routes = [];
    public Request $request;

    public function __construct($request)
    {
        $this->request = $request;
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
     * executes user function if it is set in routes array
     */
    //NORIM IVYKDYTI, KO KLIENTAS PRASE. paziurim koki path ir method klientas naudojo ir ar atitinka
    public function resolve()
    {
        //GAUNAMAS KELIAS PO "LOCALHOST"
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

//        var_dump($method);
//        var_dump($path);
//        var_dump($this->routes);

        //TRYING TO RUN A ROUTES FROM ROUTES ARR
        $callback = $this->routes[$method][$path] ?? false; // jei bandys ivykdyti kelia, kurio nera

        //IF THERE ARE NO SUCH ROUTE ADDED
        if ($callback === false) :
            echo 'Page doesn\'t exist';
            die();
        endif;

        //IF CALLBACK VALUE IS STRING
        //$app->router->get('/about', 'about'); (index.php)

        if (is_string($callback)) :
            return $this->renderView($callback);
        endif;

        //IF PAGE EXIST
        return call_user_func($callback);

//        var_dump($_SERVER);
//        var_dump($this->request->getPath());
//        var_dump($this->routes);
    }

    public function renderView(string $view)
    {


        //universalus budas kaip nurodyti kelia iki direktorijos (kaip anksciau config faile APPROOT)
        include_once Application::$ROOT_DIR . "/view/$view.php";
    }

    protected function layoutContent()
    {
        include_once Application::$ROOT_DIR . "/view/layout/main.php";

    }
}