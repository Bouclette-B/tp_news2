<?php
namespace OCFram;
abstract class Application
{
    protected $name;
    protected $HTTPRequest;
    protected $HTTPResponse;
    protected $user;
    protected $config;

    public function __construct(){
        $this->HTTPRequest = new HTTPRequest($this);
        $this->HTTPResponse = new HTTPResponse($this);
        $this->name = '';
        $this->user = new User($this);
        $this->config = new Config($this);
    }

    abstract public function run();

    public function getController()
    {
        $router = new Router;
        $xml = new \DOMDocument();
        $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        foreach ($routes as $route)
        {
            $vars = [];
            if($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
            }
            $router->addRoutes(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            $matchedRoute = $router->getRoute($this->HTTPRequest->getURI());
        }
        catch (\RuntimeException $e)
        {
            if($e->getCode() == Router::NO_ROUTE)
            {
                $this->HTTPResponse->redirect404();
            }
        }

        $_GET = array_merge($_GET, $matchedRoute->getVars());

        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';
        return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction());
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHTTPRequest()
    {
        return $this->HTTPRequest;
    }

    public function getHTTPResponse()
    {
        return $this->HTTPResponse;
    }

    public function getUser() {
        return $this->user;
    }

    public function getConfig() {
        return $this->config;
    }
}