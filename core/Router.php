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

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    //NORIM IVYKDYTI, KO KLIENTAS PRASE. paziurim koki path ir method klientas naudojo ir ar atitinka
    public function resolve()
    {
        //GAUNAMAS KELIAS PO "LOCALHOST"
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

//        var_dump($method);
//        var_dump($path);

        //TRYING TO RUN A ROUTES FROM ROUTES ARR
        $callback = $this->routes[$method][$path] ?? false; // jei bandys ivykdyti kelia, kurio nera

        //IF THERE ARE NO SUCH ROUTE ADDED
        if ($callback === false) :
            echo 'Page doesn\'t exist';
            die();
       endif;

           //IF PAGE EXIST
        echo call_user_func($callback);


//        var_dump($_SERVER);
//        var_dump($this->request->getPath());
//        var_dump($this->routes);
    }
}