
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
                <input type="text" id="<?=$id?>" class="form-control input-tags">
                <span class="input-group-btn">
                    <a class="btn btn-default" href="javascript:;" form-role="add-tag" form-attr-field="{{ $field->name() }}[]">增加标签</a>
                </span>
            </div>
        </div>
    </div>
    <style>
    .typeahead,
    .tt-query,
    .tt-hint {
      width: 396px;
      height: 30px;
      padding: 8px 12px;
      font-size: 24px;
      line-height: 30px;
      border: 2px solid #ccc;
      -webkit-border-radius: 8px;
         -moz-border-radius: 8px;
              border-radius: 8px;
      outline: none;
    }

    .typeahead {
      background-color: #fff;
    }

    .typeahead:focus {
      border: 2px solid #0097cf;
    }

    .tt-query {
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
         -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-hint {
      color: #999
    }

    .tt-dropdown-menu {
      width: 422px;
      margin-top: 12px;
      padding: 8px 0;
      background-color: #fff;
      border: 1px solid #ccc;
      border: 1px solid rgba(0, 0, 0, 0.2);
      -webkit-border-radius: 8px;
         -moz-border-radius: 8px;
              border-radius: 8px;
      -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
         -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
              box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }

    .tt-suggestion {
      padding: 3px 20px;
      font-size: 18px;
      line-height: 24px;
    }

    .tt-suggestion.tt-cursor {
      color: #fff;
      background-color: #0097cf;

    }

    .tt-suggestion p {
      margin: 0;
    }
    </style>
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

            $("#<?=$id?>").keypress( function( data , handler ){
                if( data.charCode == 32 ){
                    $(this).parents(".input-group").find(".btn").trigger( 'click' );
                    return false;
                }
            })
        });
    </script>
</div>