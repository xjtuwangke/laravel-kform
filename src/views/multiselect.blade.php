
<div class="form-group">
    <label for="{{ $field->name() }}" class="control-label">{{ $field->label() }}</label>
    <div class="col-sm-6">
        {{ Form::select( $field->name() , $field->options() , $field->checked() , [ 'multiple' , 'form-role'=>'multi-select' ] ); }}
    </div>
    <div class="text-danger">
    </div>
</div>