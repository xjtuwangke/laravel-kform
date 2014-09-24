<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 04:55
 */

namespace KForm\FormField;


class TextArea extends FormFieldBase{

    /**
     * @var int textarea的rows
     */
    public $rows = 3;

    /**
     * @param $rows
     * @return $this
     */
    public function setRows( $rows ){
        $this->rows = (int) $rows;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(){
        $name = $this->name();
        $label = $this->label();
        $value = $this->value();
        $errors = $this->errors();
        $readonly = $this->isReadonly()?'readonly':'';
        $hidden = $this->isHide()?'display:none':'';
        $rows   = $this->rows;
        return <<<HTML
<div class="form-group" style="{$hidden}">
    <label for="{$name}" class="control-label col-sm-2">{$label}</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="{$name}" rows="{$rows}" {$readonly}>{$value}</textarea>
    </div>
    <div class="col-sm-2 text-danger">
        {$errors}
    </div>
</div>
HTML;
    }
} 