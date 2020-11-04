<?php
namespace OCFram;

session_start();

class User extends ApplicationComponent{
    public function getAttribute($attribute){
        return isset($_SESSION[$attribute]) ? $_SESSION[$attribute] : null;
    }

    public function getFlash() : string {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function hasFlash() : bool {
        return isset($_SESSION['flash']);
    }

    public function isUserAuthenticated() : bool {
        return isset($_SESSION['userAuth']) && $_SESSION['userAuth'] === true;
    }

    public function setAttribute($attribute, $value){
        $_SESSION[$attribute] = $value;
    }

    public function setUserAuthenticated(bool $authenticated = true) {
        if(!is_bool($authenticated)){
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setUserAuthenticated() doit être un booléen');
        }
        $_SESSION['userAuth'] = $authenticated;
    }

    public function setFlash(string $value){
        if(!is_string($value)){
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setFlash() doit être un string');
        }
        $_SESSION['flash'] = $value;
    }
}