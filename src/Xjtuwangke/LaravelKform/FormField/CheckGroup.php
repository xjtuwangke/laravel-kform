<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 23:29
 */

namespace Xjtuwangke\LaravelKform\FormField;


class CheckGroup extends FormFieldBase{

    /**
     * checkbox val=>html对
     * @var array
     */
    protected $options = array();

    /**
     * checkbox 被选中的值
     * @var array
     */
    protected $checked = array();

    /**
     * 获取checkbox的 options
     * @return array
     */
    public function options(){
        return $this->options;
    }

    /**
     * 获取checked
     * @return array
     */
    public function checked(){
        return $this->checked;
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
     * @param $checked
     * @return $this
     */
    public function setChecked( $checked ){
        $this->checked = $checked;
        return $this;
    }

    public function value(){
        $value = parent::value();
        if( ! $value ){
            $value = array();
        }
        return $value;
    }


} 