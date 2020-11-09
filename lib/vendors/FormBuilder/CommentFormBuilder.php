<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\NotNullValidator;
use OCFram\StringField;
use OCFram\TextField;

class CommentFormBuilder extends FormBuilder {
    public function build(){
        $form = $this->getForm();
        $form->addField(new StringField([
            'label' => 'Auteur',
            'name' => 'author',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire')
            ],
        ]));
        $form->addField(new TextField([
            'label' => 'Contenu',
            'name' => 'content',
            'rows' => 7,
            'cols' => 50,
            'validators' => [
                new NotNullValidator('Vous n\'avez pas écrit de commentaire'),
            ],
        ]));
    }
}