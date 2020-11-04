<?php

namespace OCFram;

abstract class BackController extends ApplicationComponent
{
    protected $view ='';
    protected $module = '';
    protected $action = '';
    protected $page = null;

    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app);
        $this->module = $module;
        $this->action = $action;
        $this->page = new Page ($app);
    }

    public function setView($view){
        if(!is_string($view) || empty($view)){
            throw new \InvalidArgumentException('La vue doit être une chaîne de caractères valide');
        }

        $this->view = $view;
        $this->page->setContentFile(__DIR__.'../../App'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
    }
}