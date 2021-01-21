<form action="{{route('web.search')}}" class="ui form item" method="GET" style="padding-bottom:22px;">
    @csrf
    <div class="ui left icon transparent input">
        <i class="search blue large icon"></i>
        <input type="text" placeholder="Search the portal ..." autocomplete="off" name="query"
            value="{{isset($data['query'])?$data['query']:''}}" style="margin-left:11px;" />
    </div>
</form>