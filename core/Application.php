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


    public function __construct()
    {
    $this->router = new Router(); //php iesko su autoload
    }

    //paleidziama pati aplikacija
    public function run()
    {
        $this->router->resolve();
    }
}