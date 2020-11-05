<?php
namespace OCFram;

abstract class Entity implements \ArrayAccess {

    use Hydrator;

    protected $errors = [];
    protected $id;

    public function __construct(array $data = []) {
        if(!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function isNew() {
        return empty($this->id);
    }

    // GETTERS

    public function getErrors() {
        return $this->errors;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = (int) $id;
    }

    // méthodes implémentées de \ArrayAccess

    public function offsetGet($var) {
        if (isset($this->$var) && is_callable([$this, $var])) {
            return $this->$var();
        }
    }
        
    public function offsetSet($var, $value) {
        $method = 'set'.ucfirst($var);
        if (isset($this->$var) && is_callable([$this, $method])) {
            $this->$method($value);
        }
    }
        
    public function offsetExists($var) {
        return isset($this->$var) && is_callable([$this, $var]);
    }
        
    public function offsetUnset($var) {
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}