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

    public function __construct()
    {
        echo "This is router constructor";
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        var_dump($_SERVER);
    }
}