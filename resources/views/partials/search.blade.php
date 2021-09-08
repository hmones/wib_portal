<form action="{{route('web.search')}}" class="ui form item" method="GET">
    @csrf
    <div class="ui right icon transparent input"
         style="background-color: #f4f3f0;padding-left: 10px;border-radius:20px;">
        <i class="search inverted grey icon" style="margin-right:15px;"></i>
        <input type="text" placeholder="Search ..." autocomplete="off" name="query"
               value="{{isset($data['query'])?$data['query']:''}}" style="margin-left:11px;" />
    </div>
</form>
