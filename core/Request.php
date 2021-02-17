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
        $path = $_SERVER['REQUEST_URI'] ?? '/'; //jei sita reiksme $_SERVER['REQUEST_URI'] nenusetinta - duodam '/'
        $questionMarkPosition = strpos($path, '?');

        if  ($questionMarkPosition !== false) :
            $path = substr($path, 0, $questionMarkPosition);
        endif;

        return $path;
//        var_dump($questionMarkPosition);
    }
}