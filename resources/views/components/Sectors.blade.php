<div {{$attributes->merge(['class'=>'field'])}}>
    @if($label)
    <label for="{{$fieldname ? $fieldname:'sector_id'}}">{{$label}}</label>
    @endif
    <div class="ui fluid search {{$dropdownCss}} selection dropdown">
        <input type="hidden" name="{{$fieldname ? $fieldname:'sector_id'}}" value="{{$value ? $value: $sectorList}}" />
        <i class="dropdown icon"></i>
        <div class="default text"><i class="map signs icon"></i> {{$defaultText ? $defaultText:'Field'}}</div>
        <div class="menu">
            @if($emptyOption)
            <div class="item" data-value="">{{$emptyOption}}</div>
            @endif
            @foreach ($sectors as $sector)
            <div class="item" data-value="{{$sector->id}}"><i class="{{$sector->icon}} icon"></i>{{$sector->name}}</div>
            @endforeach
        </div>
    </div>
</div>