<?php
namespace OCFram;

abstract class Validator {
    protected $errorMsg;

    public function __construct(string $errorMsg)
    {
            $this->setErrorMsg($errorMsg);
    }

    abstract public function isValid($value);

    public function getErrorMsg(){
        return $this->errorMsg;
    }

    public function setErrorMsg($errorMsg){
        if(!is_string($errorMsg)) {
            throw new \InvalidArgumentException('Le message d\'erreur doit être une chaîne de caractères valide');
        }
        $this->errorMsg = $errorMsg;
    }

}