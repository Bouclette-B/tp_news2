<?php

namespace OCFram;

class Page extends ApplicationComponent {
    protected $contentFile;
    protected $vars = [];

    public function addVar(string $var, $value){
        if(!is_string($var) || is_numeric($var) || empty($var)){
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaîne de caractères non nulle');
        }
        $this->vars[$var] = $value;
    }

    public function getGeneratedPage(){
        if(!file_exists($this->contentFile)){
            throw new \RuntimeException('La vue spécifiée n\'existe pas');
        }
        $user = $this->app->getUser();
        extract($this->vars);

        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();

        ob_start();
        require __DIR__.'/../.App/'.$this->app->getName().'/templates/layout.php';
        require('../Application/template.php');
        return ob_get_clean();
    }

    public function setFileContent($contentFile){
        if(!is_string($contentFile) || empty($contentFile)){
            throw new \InvalidArgumentException('La vue est invalide');
        }
        $this->contentFile = $contentFile;
    }

    public function setContentFile(){

    }
}