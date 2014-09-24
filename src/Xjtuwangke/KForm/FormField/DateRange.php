<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 05:13
 */

namespace KForm\FormField;


class DateRange extends FormFieldBase{

    /**
     * 默认开始时间
     * @var null
     */
    public $defaultStart = null;

    /**
     * 默认结束时间
     * @param $name
     */
    public $defaultEnd = null;

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
        <input class="form-control" name="{$name}" type="text" value="{$value}" {$readonly} data-form-date-role='daterange'>
    </div>
    <div class="col-sm-2 text-danger">
        {$errors}
    </div>
</div>
HTML;
    }

} 