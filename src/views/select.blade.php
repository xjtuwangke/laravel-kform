
<div {{ $field->formgroup() }}>
    <label for="{{ $field->name() }}" class="control-label">{{ $field->label() }}</label>
    <div>
        {{ Form::select( $field->name() , $field->options() , $field->selected() , [ 'form-role'=>'single-select' ] ); }}
    </div>
    <div class="text-danger">
    </div>
</div>