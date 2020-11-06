<?php 
namespace OCFram;

abstract class Field {
    use Hydrator;

    protected $errorMsg;
    protected $label;
    protected $name;
    protected $value;

    public function __construct(array $options = []) {
        if(!empty($options)) {
            $this->hydrate($options);
        }
    }

    abstract public function buildWidget() : string;


    public function isValid() : bool {
        return !(empty($this->label) || empty($this->name) || empty($this->value));
    }

    // GETTERS

    public function getLabel() : string {
        return $this->label;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getValue() : string {
        return $this->value;
    }

    // SETTERS
    
    public function setLabel($label) {
        if(!is_string($label)) {
            throw new \InvalidArgumentException('Le label doit être une chaîne de caractère valide');
        }
        $this->label = $label;
    }

    public function setName($name) {
        if(!is_string($name)) {
            throw new \InvalidArgumentException('Le nom doit être une chaîne de caractère valide');
        }
        $this->name = $name;
    }

    public function set($value) {
        if(!is_string($value)) {
            throw new \InvalidArgumentException('La valeur doit être une chaîne de caractère valide');
        }
        $this->value = $value;
    }




}