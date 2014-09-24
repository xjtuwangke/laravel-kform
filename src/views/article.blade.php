
<div class="form-group">
    <label for="{{ $field->name() }}" class="control-label col-sm-2">{{ $field->label() }}</label>
    <div class="col-sm-6">
    <textarea form-data-role="wysiwyg" class="form-control" name="{{ $field->name() }}" rows="{{ $field->rows() }}">
    {{{ $field->value() }}}
    </textarea>
    </div>
    <div class="text-danger">
    </div>
</div>