<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 05:11
 */

namespace KForm\FormField;


class DateTime extends FormFieldBase{

    /**
     * 默认时间
     * @var null
     */
    public $defaultDateTime = null;

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
        <input class="form-control" name="{$name}" type="text" value="{$value}" {$readonly} data-form-date-role='datetime'>
    </div>
    <div class="col-sm-2 text-danger">
        {$errors}
    </div>
</div>
HTML;
    }

} 