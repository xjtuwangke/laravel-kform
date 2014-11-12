
<div {{ $field->formgroup() }}>
    <div class="row">
        <label for="{{ $field->name() }}" class="control-label col-lg-12 col-md-12" style="text-align:left;">{{ $field->label() }}</label>
    </div>
    <div class="row">
        <div class="tags-span col-lg-12 col-md-12">
        @foreach( $field->value() as $tag )
            <span class="label label-info" style="display:inline-block;margin-right:5px;">{{{ $tag }}}<a href="javascript:;" form-role="tag-remove" style="margin-left:10px;">x</a>
                <input style="display:none;" name="{{ $field->name() }}[]" value="{{{ $tag }}}">
            </span>
        @endforeach
        </div>
    </div>
    <?php $id = 'tags-input-' . \Xjtuwangke\Random\KRandom::getRandStr();?>
    <div style="margin-top:20px;">
        <div class="">
            <div class="input-group">
                <input type="text" id="<?=$id?>" class="form-control">
                <span class="input-group-btn">
                    <a class="btn btn-default" href="javascript:;" form-role="add-tag" form-attr-field="{{ $field->name() }}[]">增加标签</a>
                </span>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            var substringMatcher = function(strs) {
              return function findMatches(q, cb) {
                var matches, substrRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                  if (substrRegex.test(str)) {
                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                  }
                });

                cb(matches);
              };
            };

            var suggetstions = <?=json_encode( $field->suggestions() , JSON_UNESCAPED_UNICODE )?>;

            $('#<?=$id?>').typeahead({
              hint: true,
              highlight: true,
              minLength: 1
            },
            {
              name: 'states',
              displayKey: 'value',
              source: substringMatcher(suggetstions)
            });
        });
    </script>
</div>