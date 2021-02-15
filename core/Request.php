<?php


namespace app\core;

/**
 * Get user page from url
 * [REQUEST_URI] => /almostLara/todos?id=5
 * extract /todos
 *
 * Class Request
 * @package app\core
 */
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/31-almostLara/'; //jei sita reiksme $_SERVER['REQUEST_URI'] nenusetinta - duodam '/'
        $questionMarkPosition = strpos($path, '?');
        var_dump($questionMarkPosition);
    }
}