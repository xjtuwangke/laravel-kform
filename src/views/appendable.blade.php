
 <div {{ $field->formgroup() }}>
     <div class="control-label">{{ $field->label() }}</div>
     <div class="appendable-inputs">
        <a href="javascript:;" class="btn btn-info btn-sm" form-role="appendable" data-attr-append-url="{{{ $field->append_url() }}}">增加一条</a>
        {{ $field->html() }}
     </div>
 </div>
