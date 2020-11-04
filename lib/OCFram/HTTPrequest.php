<?php
namespace OCFram;

class HTTPRequest extends ApplicationComponent {

    public function getCookie($key) {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public function doesCookieExist($key) {
        return isset($_COOKIE[$key]);
    }
    
    public function isGetData($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function doesGetExist($key) {
        return isset($_GET[$key]);
    }

    public function checkMethod() {
        return $_SERVER['REQUEST-METHOD'];
    }

    public function isPostData($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function doesPostExist($key) : bool {
        return isset($_POST[$key]);
    }

    public function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }



}