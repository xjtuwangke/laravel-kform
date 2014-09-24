
<div class="form-group">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-2 tags-span">
        @foreach( $field->value() as $tag )
            <span class="label label-info" style="display:inline-block;margin-right:5px;">{{{ $tag }}}<a href="javascript:;" form-role="tag-remove" style="margin-left:10px;">x</a>
                <input style="display:none;" name="{{ $field->name() }}[]" value="{{{ $tag }}}">
            </span>
        @endforeach
        </div>
    </div>
    <label for="" class="control-label">{{ $field->label() }}</label>
    <div style="margin-top:20px;">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                    <a class="btn btn-default" href="javascript:;" form-role="add-tag" form-attr-field="{{ $field->name() }}[]">增加标签</a>
                </span>
            </div>
        </div>
    </div>
</div>