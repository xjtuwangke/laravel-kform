<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 23:49
 */

namespace Xjtuwangke\LaravelKform\FormField;


class RadioGroup extends FormFieldBase{

    /**
     * checkbox val=>html对
     * @var array
     */
    protected $options = array();

    /**
     * @var null
     */
    protected $selected = null;

    /**
     * 获取checkbox的 options
     * @return array
     */
    public function  options(){
        return $this->options;
    }

    /**
     * 获取checked
     * @return array
     */
    public function selected(){
        return $this->selected;
    }

    /**
     * @param $options
     * @return $this
     */
    public function setOptions( $options ){
        $this->options = $options;
        return $this;
    }

    /**
     * @param $selected
     * @return $this
     */
    public function setSelected( $selected ){
        $this->selected = $selected;
        return $this;
    }

}