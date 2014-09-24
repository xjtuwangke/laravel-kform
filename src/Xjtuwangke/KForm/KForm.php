<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 02:23
 */

namespace KForm;

use \Illuminate\Support\Facades\Form;
use \Illuminate\Support\Facades\Input;
use KForm\FormField\FormFieldBase;


/**
 * Class KForm
 * @examples:
 * $loginForm->addField( 'login' , 'required' )->setLabel('请输入用户名')->setType(KFormField::Type_Text);
 * $loginForm->addField( 'password' , 'required' )->setLabel('请输入密码')->setType(KFormField::Type_Password);
 * $loginForm->addField( 'checkgroup' , 'required' )->setLabel('asdasd')->setOptions([ 'a' , 'b' , 'c'])->setType(KFormField::Type_CheckGroup);
 * $loginForm->addField( 'multiSelect' , 'required' )->setLabel('xxxx')->setOptions( [ 'a' , 'b' , 'c' , 1 ,2 ,3,4,5,6,7,8,9,0 ] )->setType(KFormField::Type_MultiSelect);
 * $loginForm->addField( 'uploadify' )->setLabel('单图上传')->setFileGroup('test')->setType(KFormField::Type_Image);
 * $loginForm->addField( 'multi-image' )->setLabel('多图上传')->setFileGroup('test2')->setType(KFormField::Type_MultiImage);
 */
class KForm {

    /**
     * 保存表单的所有field
     * @var array
     */
    protected $fields = [];

    /**
     * 表单尾部
     * @var string
     */
    protected $tail = '';

    static function open( $options = [] ){
        if( array_key_exists( 'class' , $options ) ){
            $options['class'].= ' form-horizontal';
        }
        else{
            $options['class'] = 'form-horizontal';
        }
        if( array_key_exists( 'role' , $options ) ){

        }
        else{
            $options['role'] = 'form';
        }
        return Form::open( $options );
    }

    public function __construct(){
        $this->tail = Form::submit( '确定' ) . Form::close();
    }

    public function addField( FormFieldBase $field ){
        $this->fields[ $field->name() ] = $field;
        return $field;
    }

    public function field( $name ){
        if( array_key_exists( $name , $this->fields ) ){
            return $this->fields[ $name ];
        }
        else{
            return null;
        }
    }

    public function validate( $input = null ){
        if( is_null( $input ) ){
            $input = Input::all();
        }
        $pass = true;
        foreach( $this->fields as $name => $field ){
            if( isset( $input[ $name ] ) ){
                $value = $input[ $name ];
            }
            else{
                $value = null;
            }
            if( false == $field->validate( $value ) ){
                $pass = false;
            };
        }
        return $pass;
    }

    public function value( $name ){
        if( $field = $this->field( $name ) ){
            return $field->value();
        }
        else{
            return null;
        }
    }

    /**
     * 将Model数据设置为表单的default值
     * @param $model
     */
    public function modelToDefault( $model ){
        foreach( $this->fields as $field ){
            $value = $this->getModelValueAttribute( $field->name() , $model );
            if( $value ){
                $field->setDefault( $value );
            }
        }
    }

    /**
     * Get the model value that should be assigned to the field.
     *
     * @param $name
     * @param $model
     * @return mixed
     */
    protected function getModelValueAttribute($name , $model )
    {
        if (is_object($model))
        {
            return object_get($model, $this->transformKey( $name ) );
        }
        elseif (is_array($model))
        {
            return array_get($model, $this->transformKey( $name ) );
        }
    }

    /**
     * Transform key from array to dot syntax.
     *
     * @param  string  $key
     * @return string
     */
    protected function transformKey($key)
    {
        return str_replace(array('.', '[]', '[', ']'), array('_', '', '.', ''), $key);
    }

    /**
     * 自定义表单尾部按钮
     * @param $tail
     * @return $this
     */
    public function setTail( $tail ){
        $this->tail = $tail;
        return $this;
    }

    /**
     * draw a form
     * @return mixed
     */
    public function __toString(){
        $form = static::open();
        foreach( $this->fields as $field ){
            $form.= $field;
        }
        $form.= $this->tail;
        return $form;
    }
}