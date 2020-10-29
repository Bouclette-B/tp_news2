<?php
namespace OCFram;

class HTTPRequest extends ApplicationComponent

{
    public function checkMethod()
    {
        return $_SERVER['REQUEST-METHOD'];
    }

    public function isPost($data) 
    {
        return isset($_POST[$data]) ? $_POST[$data] : null;
    }

    public function isGet($data)
    {
        return isset($_GET[$data]) ? $_GET[$data] : null;
    }

    public function getCookie($key)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function doesCookieExist($key)
    {
        return isset($_COOKIE[$key]);
    }

    public function doesPostExist($key) : bool
    {
        return isset($_POST[$key]);
    }

    public function doesGetExist($key)
    {
        return isset($_GET[$key]);
    }
}