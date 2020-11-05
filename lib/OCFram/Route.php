<?php
namespace OCFram;

class Route 
{
    protected $action;
    protected $url;
    protected $module;
    protected $varsNames;
    protected $vars = [];

    public function __construct(string $url, string $module, string $action, array $varsNames)
    {
        $this->setURL($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    public function hasVars() : bool
    {
        return !empty($this->varsNames);
    }

    public function match(string $url)
    {
        if(preg_match('`^'.$this->url.'$`', $url, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }

    public function getAction() 
    {
        return $this->action;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getVarsNames()
    {
        return $this->varsNames;
    }

    public function getVars()
    {
        return $this->vars;
    }


    public function setURL($url)
    {
        if(is_string($url))
        {
            $this->url = $url;
        }
    }

    public function setModule($module)
    {
        if(is_string($module))
        {
            $this->module = $module;
        }
    }

    public function setAction($action)
    {
        if(is_string($action))
        {
            $this->action = $action;
        }
    }

    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }
}