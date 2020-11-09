<?php 
namespace OCFram;

abstract class Field {
    use Hydrator;

    protected $errorMsg;
    protected $label;
    protected $name;
    protected $value;
    protected $validators =[];

    public function __construct(array $options = []) {
        if(!empty($options)) {
            $this->hydrate($options);
        }
    }

    abstract public function buildWidget() : string;


    public function isValid() : bool {
        foreach ($this->validators as $validator) {
            if(!$validator->isValid($this->value)){
                $this->errorMsg = $validator->getErrorMsg();
                return false;
            }
            return true;
        }
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

    public function getValidators() {
        return $this->validators;
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

    public function setValue($value) {
        if(is_string($value)) {
            $this->value = $value;
        }
    }

    public function setValidators(array $validators){
        $this->validators = $validators;
        foreach($validators as $validator) {
            if($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }

}