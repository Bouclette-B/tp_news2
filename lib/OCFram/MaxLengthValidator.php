<?php
namespace OCFram;

class MaxLengthValidator extends Validator {

    public function isValid($value) {
        if($value){
            return true;
        }
        return false;
    }
}