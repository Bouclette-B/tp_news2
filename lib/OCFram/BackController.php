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
        $this->page = new Page;
    }
}