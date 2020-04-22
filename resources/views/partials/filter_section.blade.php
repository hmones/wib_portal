<form action="{{$route}}" method="GET" class="ui form">
<div class="ui middle aligned centered center aligned stackable padded grid">
    <div class="grey column" style="border-radius: 5px;">
            @csrf
            <div class="fields" style="margin:0;">
                <div class="seven wide field">
                    <div class="ui fluid multiple search selection dropdown">
                        <input type="hidden" name="countries[]"
                               value="@isset($request->countries){{implode(', ', $request->countries)}}@endisset"/>
                        <i class="dropdown icon"></i>
                        <div class="default text">Select countries</div>
                        <div class="menu">
                            @foreach($countries as $country)
                                <div class="item" data-value="{{$country->id}}">
                                    {{$country->name}}
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="seven wide field">
                    <div class="ui fluid multiple search selection dropdown" name="sectors[]">
                        <input type="hidden" name="sectors[]"
                               value="@isset($request->sectors){{implode(', ', $request->sectors)}}@endisset"/>
                        <i class="dropdown icon"></i>
                        <div class="default text">Select sectors</div>
                        <div class="menu">
                            @foreach($sectors as $sector)
                                <div class="item" data-value="{{$sector->id}}">
                                    {{$sector->name}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="two wide field">
                    <button class="ui right labeled grey icon button" type="submit"><i class="filter teal icon"></i><span style="color:#1a4d99">Filter</span></button>
                </div>
            </div>



    </div>
</div>
</form>
