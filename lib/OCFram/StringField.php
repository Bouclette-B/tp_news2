<?php
namespace OCFram;

class StringField extends Field {
    protected $maxLength;

    public function buildWidget(): string {
        $widget = "";
        if(!empty($this->errorMsg)) {
            $widget .= $this->errorMsg . '<br />';
        }

        $widget .= '<label>' . $this->label . '</label><input type="text" name="' . $this->name . '"';

        if(!empty($this->value)) {
            $widget.= ' value="' . htmlspecialchars($this->value). '"';
        }

        if(!empty($this->maxLength)) {
            $widget.= ' maxlength="' . $this->maxLength . '"';
        }

        return $widget .= ' />';
        
    }

    public function setMaxLength($length) {
        $maxLength = (int) $length;
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \InvalidArgumentException('La longueur maximale doit être supérieur à 0');
        }
    }
}