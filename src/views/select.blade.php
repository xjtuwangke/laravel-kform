
<div class="form-group">
    <label for="{{ $field->name() }}" class="control-label col-sm-3">{{ $field->label() }}</label>
    <div class="col-sm-6">
        {{ Form::select( $field->name() , $field->options() , $field->selected() , [ 'form-role'=>'single-select' ] ); }}
    </div>
    <div class="text-danger">
    </div>
</div>