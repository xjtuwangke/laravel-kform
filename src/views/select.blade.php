
<div class="form-group">
    <label for="{{ $field->name() }}" class="control-label">分类</label>
    <div class="col-sm-6">
        {{ Form::select( $field->name() , $field->options() , $field->selected() , [ 'form-role'=>'single-select' ] ); }}
    </div>
    <div class="text-danger">
    </div>
</div>