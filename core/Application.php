<?php


namespace app\core;

/**
 * Class Application
 *
 * This is main application
 *
 * @package app\core
 */
class Application
{
    /**
     * This is instance of router class
     *
     * We will need routing in all our application - we will have it as a property
     * @var Router
     */

    public static string $ROOT_DIR;
    //issaugomas router - vidine savybe. paimtas per composer - automatiskai susizino
    public Router $router;
    public Request $request;

    public function __construct($rootPath)
    {
        //static property assignment - statinis pasiekiamas su ::
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request(); //php iesko su autoload
        $this->router = new Router($this->request); //php iesko su autoload
    }

    //paleidziama pati aplikacija
    public function run()
    {
        echo $this->router->resolve();
    }
}