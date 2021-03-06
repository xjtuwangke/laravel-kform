<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/9/25
 * Time: 03:07
 */

 $name = $field->name();
 $_name = str_replace( '[' , '__' , $name );
 $_name = str_replace( ']' , '___' , $_name );
 ?>
 <div {{ $field->formgroup() }}>
    <label for="{{ $_name }}" class="control-label">{{ $field->label() }}</label>
    <div class="row">
        <div class="div-image-upload" form-role="image-upload" uploadify-image-type="{{{ $field->type() }}}" uploadify-swf-path="{{ \KUrl::asset( 'uploadify/uploadify.swf' , null , false ) }}" uploadify-upload-url="{{ \URL::action( 'uploadify.image' ) }}">
            <img src="{{ $field->value() }}" class="img-responsive uploadify-image">
            <input hidden="hidden" class="hidden uploadify-input" name="{{ $field->name() }}" type="text" value="{{ $field->value() }}">
            <input id="_uploadify-image-{{ $_name }}" name="_uploadify" type="file">
            <a href="javascript:;" class="uploadify-remove-image"
               onclick="$(this).parents('div.div-image-upload').children('img').attr('src' , '');$(this).parents('div.div-image-upload').children('.uploadify-input').attr('value' , 'no-image');">x</a>
        </div>
    </div>
     <div class="text-danger">
         {{ $field->errors() }}
     </div>
 </div>