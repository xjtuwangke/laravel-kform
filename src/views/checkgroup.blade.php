
<div {{ $field->formgroup() }}>
    <label for="{{ $field->name() }}[]" class="control-label">
        {{ $field->label() }}
    </label>
    <div class="col-md-12">
        @foreach( $field->options() as $key => $val )
        <div class="checkbox col-md-3">
            <label>
            @if( in_array( $key , $field->checked()) )
            {{ Form::checkbox( $field->name() . '[]' , $key , true  ) . $val }}
            @else
            {{ Form::checkbox( $field->name() . '[]' , $key , true  ) . $val }}
            @endif
            </label>
        </div>
        @endforeach
    </div>
    <div class="col-md-12 text-danger">
        {{ $field->errors() }}
    </div>
</div>