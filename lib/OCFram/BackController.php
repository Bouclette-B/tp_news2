<?php

namespace OCFram;

abstract class BackController extends ApplicationComponent
{
    protected $view ='';
    protected $module ='';
    protected $action ='';
    protected $page = null;

    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app);
        $this->page = new Page ($app);
        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    public function execute(){
        $method = 'execute'.ucfirst($this->action);
        
        if(!is_callable([$this, $method])){
            throw new \RuntimeException('L\'action "'. $this->action . '" n\'est pas définie sur ce module');
        }
        $this->$method($this->app->getHTTPRequest());
    }
    
    public function getPage(){
        return $this->page;
    }

    public function setView(string $view){
        if(!is_string($view) || empty($view)){
            throw new \InvalidArgumentException('La vue doit être une chaîne de caractères valide');
        }
        $this->view = $view;
        $this->page->setContentFile(__DIR__.'../../App'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
    }

    public function setAction(string $action) {
        if(!is_string(($action)) || empty($action)){
            throw new \InvalidArgumentException('L\'action doit être une chaîne de caractères non nulle');
        }
        $this->action = $action;
    }

    public function setModule(string $module){
        if(!is_string(($module)) || empty($module)){
            throw new \InvalidArgumentException('Le module doit être une chaîne de caractères non nulle.');
        }
        $this->module = $module;
    }
}