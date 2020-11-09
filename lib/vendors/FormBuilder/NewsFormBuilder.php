<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\NotNullValidator;
use OCFram\StringField;
use OCFram\TextField;

class NewsFormBuilder extends FormBuilder {
    public function build(){
        $form = $this->getForm();
        $form->addField(new StringField([
            'label' => 'Auteur',
            'name' => 'author',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('Le nom d\'auteur est trop long.', 50),
                new NotNullValidator('Merci de spécifier le nom d\'auteur'),
            ],
        ]));
        $form->addField(new StringField([
            'label' => 'Titre',
            'name' => 'title',
            'maxLength' => 100,
            'validators' => [
                new MaxLengthValidator('Le titre est trop long.', 100),
                new NotNullValidator('Merci de spécifier le titre'),
            ],
        ]));
        $form->addField(new TextField([
            'label' => 'Contenu',
            'name' => 'content',
            'rows' => 8,
            'cols' => 60,
            'validators' => [
                new NotNullValidator('Vous n\'avez pas écrit de rnews !'),
            ]
        ]));
    }
}