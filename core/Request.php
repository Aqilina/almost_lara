<?php


namespace app\core;


class Request
{

    /**
     * Get user page from url
     * [REQUEST_URI] => /almostLara/todos?id=5
     * extract /todos
     *
     * @return string
     */
    public function getPath(): string //nurodoma, kas grizta
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/'; //jei sita reiksme $_SERVER['REQUEST_URI'] nenusetinta - duodam '/'
        $questionMarkPosition = strpos($path, '?');

        if ($questionMarkPosition !== false) :
            $path = substr($path, 0, $questionMarkPosition);
        endif;

        return $path;
//        var_dump($questionMarkPosition);
    }

    /**
     * This will return http method get or post
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}