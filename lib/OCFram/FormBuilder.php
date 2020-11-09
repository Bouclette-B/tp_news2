<?php
namespace OCFram;

abstract class FormBuilder {
    protected $form;

    abstract public function build();

    public function __construct(Entity $entity) {
        $this->form = new Form($entity);
    }

    public function getForm() {
        return $this->form;
    }

    public function setForm(Form $form) {
        $this->form = $form;
    }

}