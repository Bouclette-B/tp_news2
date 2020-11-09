<?php
namespace OCFram;

class MaxLengthValidator extends Validator {

    protected $maxLength;

    public function __construct($errorMsg, $maxLength)
    {
        parent::__construct($errorMsg);
        $this->maxLength = $maxLength;
    }

    public function isValid($value) {
        return strlen($value) <= $this->maxLength;
    }

    public function setMaxLength($maxLength) {
        $maxLength = (int) $maxLength;
        if($maxLength > 0){
            $this->maxLength = $maxLength;
        }
        else throw new \InvalidArgumentException('La longueur maximale doit être un entier supérieur à 0');
    }


}