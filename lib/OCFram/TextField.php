<?php
namespace OCFram;

class TextField extends Field {
    protected $rows;
    protected $cols;

    public function buildWidget(): string
    {
        $widget = '';
        if(!empty($this->errorMsg)) {
            $widget .= $this->errorMsg . '<br />';
        }

        $widget .= '<label>' . $this->label . '</label><textarea name="' . $this->name . '"';
        
        if(!empty($this->cols)) {
            $widget.= ' cols="' . $this->cols . '"';
        }

        if(!empty($this->rows)) {
            $widget.= ' rows="' . $this->rows . '"';
        }
                
        $widget .= '>';
        
        if(!empty($this->value)) {
            $widget.= htmlspecialchars($this->value);
        }
        return $widget .= '</textarea>';
    }

    public function setRows($rows) {
        $rows = (int) $rows;
        if($rows > 0){
            $this->rows = $rows;
        } else {
            throw new \InvalidArgumentException('Le nombre de lignes doit être supérieur à 0');
        }
    }

    public function setCols($cols) {
        $cols = (int) $cols;
        if($cols > 0){
            $this->cols = $cols;
        } else {
            throw new \InvalidArgumentException('Le nombre de colonnes doit être supérieur à 0');
        }
    }

}