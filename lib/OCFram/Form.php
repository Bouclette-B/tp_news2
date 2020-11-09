<?php
namespace OCFram;

class Form {
    protected $entity;
    protected $fields = [];

    public function __construct(Entity $entity) {
        $this->setEntity($entity);
    }

    public function addField(Field $field) {
        $attribute = ucfirst($field->getName());
        $methodName = "get{$attribute}";
        $field->setValue($this->entity->$methodName());
        $this->fields[] = $field;
        return $this;
    }

    public function createView() : string {
        $view ='';
        foreach($this->fields as $field) {
            $view .= $field->buildWidget().'<br />';
        }
        return $view;
    }

    public function isValid() : bool {
        $valid = true;
        foreach($this->fields as $field) {
            if(!$field->isValid()) {
                $valid = false;
            }
        }
        return $valid;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function setEntity(Entity $entity) {
        $this->entity = $entity;
    }

}