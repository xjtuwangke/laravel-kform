<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/24
 * Time: 03:48
 */

namespace Xjtuwangke\LaravelKform;

use \Illuminate\Validation\Validator;
use \Sms\SmServiceBase;

class KValidator extends Validator{

    public function validateMobile( $attribute , $value , $parameters ){
        return SmServiceBase::isMobile( $value );
    }


} 