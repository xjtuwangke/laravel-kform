
<div {{ $field->formgroup() }}>
    <label for="{{ $field->name() }}[]" class="control-label">
        {{ $field->label() }}
    </label>
    <div>
        @foreach( $field->options() as $key => $val )
        <div class="checkbox">
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
    <div class="text-danger">
        {{ $field->errors() }}
    </div>
</div>