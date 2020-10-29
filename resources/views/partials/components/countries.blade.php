<div class="field">
    <div class="ui fluid search selection dropdown">
        <input type="hidden" name="country_id" value="" />
        <i class="dropdown icon"></i>
        <div class="default text"><i class="map marker alternate icon"></i>Country</div>
        <div class="menu">
            @foreach ($countries as $country)
            <div class="item" data-value="{{$country->id}}"><i class="{{$country->code}} flag"></i>{{$country->name}}
            </div>
            @endforeach
        </div>
    </div>
</div>