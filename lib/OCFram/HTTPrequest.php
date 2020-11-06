<?php
namespace OCFram;

class HTTPRequest extends ApplicationComponent {

    public function getCookie($key) {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public function doesCookieExist($key) {
        return isset($_COOKIE[$key]);
    }
    
    public function isGetData($key) : bool {
        return isset($_GET[$key]);
    }

    public function getGetData($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;

    }

    public function checkMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isPostData($key) : bool {
        return isset($_POST[$key]);
    }

    public function getPostData($key)  {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }



}