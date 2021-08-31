<div class="ui center aligned basic segment" style="height:{{data_get($options, 'height', 300)}}px">
    <label for="image_upload_input">
        <a href="javascript:void(0);" id="image_upload_icon">
            @isset($options['value'])
                <img class='ui {{data_get($options, 'shape', '')}} centered small image'
                     src='{{$options['value']}}' alt=""/>
            @else
                <i style="margin-top:50%;"
                   class="{{data_get($options, 'shape', '')}} inverted grey images huge icon"></i>
            @endisset
        </a>
    </label>
    <div class="image description"><small>Image size {{data_get($options, 'width', 300)}}px
            x {{data_get($options, 'height', 300)}}px</small></div>
    <input type="file" name="{{data_get($options, 'field_name', 'image')}}" accept="image/*" style="display: none;"
           id="image_upload_input" value="{{data_get($options, 'field_value')}}">
    <script>
        let width = '{{data_get($options, 'width', 300)}}';
        let height = '{{data_get($options, 'height', 300)}}';
        let field_name = '{{data_get($options, 'field_name', 'image')}}';
        let field_value = '{{data_get($options, 'field_value')}}';
        let shape = '{{data_get($options, 'shape')}}';
    </script>
    <script src="{{asset('js/imageUpload.js')}}" type="application/javascript"></script>
</div>
