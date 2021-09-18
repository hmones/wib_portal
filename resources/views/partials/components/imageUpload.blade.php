<style>
    #image_upload_icon {
        display: block;
        background-repeat: no-repeat;
        background-position: center;
        background-image: url("{{data_get($options, 'value')}}");
        width: 100%;
        height: 420px;
    }
</style>
<div class="ui center aligned basic segment" style="min-height:420px">
    <div class="ui top left attached label" style="z-index: 1000;" id="image_upload_info">
        Image size {{data_get($options, 'width', 300)}}px x {{data_get($options, 'height', 300)}}px
    </div>
    <label for="image_upload_input">
        <a href="javascript:void(0);" id="image_upload_icon">
            @if(!isset($options['value']))
                <i style="margin-top:50%;"
                   class="{{data_get($options, 'shape', '')}} inverted grey images huge icon"></i>
            @endif
        </a>
    </label>
    <input type="file" name="{{data_get($options, 'field_name', 'image')}}" accept="image/*" style="display: none;"
           id="image_upload_input">
    <script>
        let width = '{{data_get($options, 'width', 300)}}';
        let height = '{{data_get($options, 'height', 300)}}';
        let field_name = '{{data_get($options, 'field_name', 'image')}}';
        let field_value = '{{data_get($options, 'field_value')}}';
        let shape = '{{data_get($options, 'shape')}}';
    </script>
    <script src="{{asset('js/imageUpload.js')}}" type="application/javascript"></script>
</div>
