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
    //issaugomas router - visine savybe. paimtas per composer - automatiskai susizino
    public Router $router;
    public Request $request;

    public function __construct()
    {
    $this->request = new Request(); //php iesko su autoload
    $this->router = new Router($this->request); //php iesko su autoload
    }

    //paleidziama pati aplikacija
    public function run()
    {
       echo $this->router->resolve();
    }
}