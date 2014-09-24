<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 03:09
 */

namespace KForm\FormField;

class Text extends FormFieldBase{

    /**
     * @return string
     */
    public function __toString(){
        $name = $this->name();
        $label = $this->label();
        $value = $this->value();
        $errors = $this->errors();
        $readonly = $this->isReadonly()?'readonly':'';
        $placeholder = $this->placeholder();
        $form_group = $this->formgroup();
        return <<<HTML
<div {$form_group}>
    <label for="{$name}" class="control-label">{$label}</label>
    <input class="form-control" name="{$name}" placeholder="{$placeholder}" type="text" value="{$value}" {$readonly}>
    <div class="text-danger">
        {$errors}
    </div>
</div>
HTML;
    }
} 