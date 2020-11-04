<?php
namespace OCFram;

use DOMDocument;

class Config extends ApplicationComponent {
    protected $vars = [];

    public function getVar(string $var) : string {
        if(!$this->vars){
            $configFile = new \DOMDocument;
            $configFile->load(__DIR__.'/../../App/'.$this->app->getName().'/Config/app.xml');
            $elements = $configFile->getElementsByTagName('define');
            
            foreach($elements as $element){
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }

        if(isset($this->vars[$var])){
            return $this->vars[$var];
        }

        return null;
    }
}