
<div {{ $field->formgroup() }}>
    <label for="{{ $field->name() }}" class="control-label">{{ $field->label() }}</label>
    <div>
    <textarea form-data-role="wysiwyg" class="form-control" name="{{ $field->name() }}" rows="{{ $field->rows() }}">
    {{{ $field->value() }}}
    </textarea>
    </div>
    <div class="text-danger">
    </div>
</div>