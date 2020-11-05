<form action="{{route('web.search')}}" class="ui form" method="GET">
    @csrf
    <div class="ui right icon transparent input">
        <i class="search blue large icon"></i>
        <input type="text" placeholder="Search the portal ..." autocomplete="off" name="query"
            value="{{isset($data['query'])?$data['query']:''}}" />
    </div>
</form>