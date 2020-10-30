<div {{$attributes->merge(['class'=>'field'])}}>
    @if($label)
    <label for="{{$fieldname ? $fieldname:'country_id'}}">{{$label}}</label>
    @endif
    <div class="ui fluid {{$dropdownCss}} search selection dropdown">
        <input type="hidden" name="{{$fieldname ? $fieldname:'country_id'}}" value={{$value?$value:$countryList}} />
        <i class="dropdown icon"></i>
        <div class="default text"><i class="map marker alternate icon"></i>Country</div>
        <div class="menu">
            @foreach ($countries as $country)
            <div class="item" data-value="{{$countrycode?$country->calling_code:$country->id}}">
                <i class="{{$country->code}} flag"></i>{{$country->name}}
                @if($countrycode) (+{{$country->calling_code}})@endif
            </div>
            @endforeach
        </div>
    </div>
</div>