<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 02:25
 */

namespace Xjtuwangke\LaravelKform\FormField;

use Xjtuwangke\LaravelKform\KForm;
use Xjtuwangke\LaravelKform\KValidator;
use \Illuminate\Support\Facades\HTML;

/**
 * 表单域基类
 * @class FormFieldBase
 * @package KForm\FormField
 */
class FormFieldBase {

    /**
     * @var bool 是否隐藏
     */
    protected $hide = false;

    /**
     * @var bool 是否readonly
     */
    protected $readonly = false;

    /**
     * @var string
     */
    protected $placeholder = '';

    /**
     * @var string fieldname
     */
    protected $name = '';

    /**
     * @var null
     */
    protected $form = null;

    /**
     * @var array 错误信息
     */
    protected $errors = array();

    /**
     * @var null 默认值
     */
    protected $default = null;

    /**
     * @var null 固定值
     */
    protected $fixed = null;

    /**
     * @var string 验证规则
     */
    protected $rules = '';

    /**
     * @var array 验证不通过的提示
     */
    public $errorMessage = array(
        'mobile' => '请输入一个合法的手机号码' ,
    );

    /**
     * @var array 验证函数
     */
    protected $validateFuncArray = array();

    /**
     * @var null Validator类验证后得到的messagebag
     */
    protected $message = null;

    /**
     * @var null field value
     */
    protected $value = null;

    /**
     * @var string label
     */
    protected $label = '';

    /**
     * @var callable 绑定存储数据的闭包
     */
    protected $bindFuncArray = array();

    /**
     * @var array
     */
    protected $form_group = array(
        'class' => 'form-group' ,
        'style' => 'margin-top:10px;' ,
    );

    /**
     * @param $name
     */
    public function __construct( $name ){
        $this->name = $name;
        $this->bindFunc = function( $item , $field ){
            $name = $field->name;
            $item->$name = $this->form->value( $name );
            return $item;
        };
    }

    /**
     * @param $fieldname
     * @return static
     */
    public static function create( $fieldname ){
        return new static( $fieldname );
    }

    public function belongsToForm( KForm $form ){
        $this->form = $form;
        return $this;
    }

    /**
     * @return string
     */
    public function name(){
        return $this->name;
    }

    /**
     * @param $label
     * @return $this
     */
    public function setLabel( $label ){
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function label(){
        $label = $this->label;
        if( in_array( 'email' , $this->rules ) ){
            $label.= static::tooltip( '一个合法的邮箱' , 'envelope' );
        }
        if( in_array( 'required' , $this->rules ) ){
            $label.= static::tooltip( '必填' , 'asterisk' );
        }
        if( in_array( 'mobile' , $this->rules) ){
            $label.= static::tooltip( '手机' , 'phone' );
        }
        if( in_array( 'numeric' , $this->rules ) ){
            $label.= static::tooltip( '数字' , 'exclamation-sign' );
        }
        return $label;
    }

    /**
     * @param $string
     * @return $this
     */
    public function setPlaceholder( $string ){
        $this->placeholder = $string;
        return $this;
    }

    /**
     * @return string
     */
    public function placeholder(){
        if( ! $this->placeholder ){
            return $this->label;
        }
        else{
            return $this->placeholder;
        }
    }

    /**
     * @param $class
     * @return $this
     */
    public function addFormgroupClass( $class ){
        $this->form_group['class'].= ' ' . $class;
        return $this;
    }

    /**
     * @return mixed
     */
    public function formgroup(){
        $hidden = $this->isHide()?'display:none;':'';
        $hasError = $this->hasError()?'has-error':'';
        $options = $this->form_group;
        $options['class'].= ' '.$hasError;
        $options['style'].= $hidden;
        return HTML::attributes( $options );
    }

    /**
     * @param bool $hide
     * @return $this
     */
    public function hide( $hide = true ){
        $this->hide = (boolean) $hide;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHide(){
        return ( true == $this->hide );
    }

    /**
     * @param bool $readonly
     * @return $this
     */
    public function readonly( $readonly = true ){
        $this->readonly = (boolean) $readonly;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReadonly(){
        return ( true == $this->readonly );
    }

    /**
     * 设置数据绑定函数
     * @param $func callable function( $item , $form , $field ){}
     * @return $this
     */
    public function setSaveFunc( $func ){
        if( is_callable( $func ) ){
            $this->bindFuncArray[] = $func;
        }
        return $this;
    }

    /**
     * 将form数据保存到item
     * @param      $item
     * @param null $form
     * @return mixed
     */
    public function valueToModel( $item , $form = null ){
        $func = $this->bindFunc;
        return $func( $item , $form , $this );
    }

    /**
     * 设置验证过滤规则
     * @param $rules array|string
     * @return $this
     */
    public function setRules( $rules ){
        if( ! is_array( $rules ) ){
            $rules = explode( '|' , $rules );
        }
        foreach( $rules as $rule ){
            if( strtolower( $rule ) == 'trim' ){
                $this->validateFuncArray[] = function(){
                    $this->value = trim( $this->value() );
                    return true;
                };
                continue;
            }
            if( strtolower( $rule ) == 'xss' ){
                $this->validateFuncArray[] = function(){
                    $this->value = e( $this->value() );
                    return true;
                };
                continue;
            }
            $this->rules[] = $rule;
        }
        return $this;
    }

    /**
     * @param string $pattern 需要匹配的正则表达式
     * @param string $msg 匹配不通过的错误提示
     * @return $this
     */
    public function setRegxRule( $pattern , $msg = '输入不符合规则'){
        $this->rules[] = 'regex:' . $pattern;
        $this->errorMessage['regex'] = $msg;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setDefault( $value ){
        $this->default = $value;
        return $this;
    }

    /**
     * @param $fixed
     * @return $this
     */
    public function setFixed( $fixed ){
        $this->fixed = $fixed;
        return $this;
    }

    /**
     * @param $value
     * @return bool
     */
    public function validate( $value ){
        $this->value = $value;
        foreach( $this->validateFuncArray as $func ){
            $this->value = $func();
        }
        if( null == $value ){
            $input = [];
        }
        else{
            $input = [ $this->name => $this->value ];
        }
        $validator = KValidator::make(
            $input ,
            [ $this->name => $this->rules ] ,
            $this->errorMessage
        );
        if( $validator->fails() ){
            $this->message = $validator->messages();
            $this->errors = $this->message->get( $this->name );
            return false;
        }
        else{
            $this->message = null;
            $this->error = null;
            return true;
        }
    }

    /**
     * 返回表单域的值
     * @return null
     */
    public function value(){
        if( null !== $this->fixed ){
            return $this->fixed;
        }
        if( null == $this->value && null != $this->default ){
            return $this->default;
        }
        return $this->value;
    }

    /**
     * @return bool
     */
    public function hasError(){
        return ! empty( $this->errors );
    }

    /**
     * 以字符串的形式返回所有错误
     * @param string $glue
     * @return string
     */
    public function errors( $glue=';' ){
        return implode( $glue , $this->errors );
    }

    /**
     * push一条错误信息
     * @param $error string
     * @return $this
     */
    public function pushError( $error ){
        $this->errors[] = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(){
        $class_name = strtolower( get_class( $this ) );
        return \Illuminate\Support\Facades\View::make( 'laravel-kform::' . $class_name )->with( 'field' , $this );
    }

    /**
     * 基于bootstrap3显示tooltip
     * @param $message
     * @param $icon
     * @return string
     */
    static function tooltip( $message , $icon ){
        $message = str_replace( "\"" , "&quot;" , $message );
        $html = <<<HTML
<span class="glyphicon glyphicon-{$icon}" style="margin-left: 8px " data-toggle="tooltip" data-placement="top" title="{$message}"></span>
HTML;
        return $html;
    }


} 