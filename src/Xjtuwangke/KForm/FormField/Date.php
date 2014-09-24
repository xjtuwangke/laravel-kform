<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 05:03
 */

namespace KForm\FormField;


class Date extends FormFieldBase{


    /**
     * 默认日期
     * @var null
     */
    public $defaultDate = null;

    public function __construct( $name ){
        parent::__construct( $name );
        $this->setRules( 'date' );
    }


    public function __toString(){
        $name = $this->name();
        $label = $this->label();
        $value = $this->value();
        $errors = $this->errors();
        $readonly = $this->isReadonly()?'readonly':'';
        $hidden = $this->isHide()?'display:none':'';
        return <<<HTML
<div class="form-group" style="{$hidden}">
    <label for="{$name}" class="control-label col-sm-2">{$label}</label>
    <div class="col-sm-6">
        <input class="form-control" name="{$name}" type="text" value="{$value}" {$readonly} data-form-date-role='date'>
    </div>
    <div class="col-sm-2 text-danger">
        {$errors}
    </div>
</div>
HTML;
    }

}