<?php
namespace OCFram;
abstract class Application
{
    protected $name;
    protected $HTTPRequest;
    protected $HTTPResponse;
    protected $user;
    protected $config;

    public function __construct($app){
        $this->HTTPRequest = new HTTPRequest($app);
        $this->HTTPResponse = new HTTPResponse($app);
        $this->name = '';
        $this->user = new User($app);
        $this->confing = new Config($app);
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

        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
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
}