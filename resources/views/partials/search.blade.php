<form action="{{route('web.search')}}" class="ui form item" method="GET">
    @csrf
    <div class="ui left icon transparent input"
         style="background-color: #f4f3f0;padding: 10px 0px 10px 0px;border-radius:20px;">
        <i class="search blue icon" style="margin-left:10px;opacity: 1;"></i>
        <input type="text" placeholder="Search ..." autocomplete="off" name="query"
               value="{{isset($data['query'])?$data['query']:''}}" style="margin-left:11px;"/>
    </div>
</form>
