<form action="{{route('profile.index')}}" method="GET" class="ui form">
<div class="ui middle aligned centered center aligned stackable padded grid">
    <div class="grey column" style="border-radius: 5px;">
            @csrf
            <div class="fields" style="margin:0;">
                <div class="seven wide field">
                    <select class="ui fluid search dropdown" multiple="" name="countries[]">
                        <option value="">Select countries</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}"
                                    @isset($request->countries)
                                    @if(in_array($country->id, $request->countries))
                                    selected
                                @endif
                                @endisset>
                                {{$country->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="seven wide field">
                    <select class="ui fluid search dropdown" multiple="" name="sectors[]">
                        <option value="">Select sectors</option>
                        @foreach($sectors as $sector)
                            <option value="{{$sector->id}}"
                                    @isset($request->sectors)
                                    @if(in_array($sector->id, $request->sectors))
                                    selected
                                @endif
                                @endisset>
                                {{$sector->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="two wide field">
                    <button class="ui right labeled grey icon button" type="submit"><i class="filter teal icon"></i><span style="color:#1a4d99">Filter</span></button>
                </div>
            </div>



    </div>
</div>
</form>
