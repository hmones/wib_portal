<div class="ui fluid search selection dropdown">
    <input type="hidden" name="sector_id" id="sector_id" />
    <i class="dropdown icon"></i>
    <div class="default text"><i class="map signs icon"></i> Field</div>
    <div class="menu">
        @foreach ($sectors as $sector)
        <div class="item" data-value="{{$sector->id}}"><i class="{{$sector->icon}} icon"></i>{{$sector->name}}</div>
        @endforeach
    </div>
</div>