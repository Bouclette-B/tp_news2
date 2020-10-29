<?php
namespace OCFram;

class HTTPResponse extends ApplicationComponent
{
    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $HTTPOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $HTTPOnly );
    }

    public function redirect404()
    {

    }

    public function redirectPage($location)
    {
        header('Location: ' .$location);
        exit();
    }

    public function sendResponse()
    {
        exit($this->page->getGenereatedPage());
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }
}