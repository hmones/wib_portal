<div class="ui container">

    <div class="ui breadcrumb">
        <div class="divider"><i class="circle small icon"></i></div>
        <a class="section" href="{{route('admin.home')}}">Home</a>
        <div class="divider"><i class="right angle icon"></i></div>
        @foreach($breadcrumbItems as $index => $item)
            @if ($index === (count($breadcrumbItems) - 1))
                <div class="active section">{{data_get($item, 'name')}}</div>
            @else
                <a class="section" href="{{data_get($item, 'url')}}">{{data_get($item, 'name')}}</a>
                <div class="divider"><i class="right angle icon"></i></div>
            @endif
        @endforeach
    </div>
</div>
<br><br>
