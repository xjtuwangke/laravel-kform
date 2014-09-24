
 <div class="form-group">
 <div class="control-label">{{ $field->label() }}</div>
 <div class="appendable-inputs col-sm-6">
    <a href="javascript:;" class="btn btn-info btn-sm col-sm-offset-2" form-role="appendable" data-attr-append-url="{{{ $field->append_url() }}}">增加一条</a>
    {{ $field->html() }}
 </div>
 </div>
