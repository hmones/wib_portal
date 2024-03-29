<form action="{{$route}}" method="GET" class="ui form" id="filter_form"
    style="{{request()->hasAny(['countries','sectors','is_verified','last_login','name'])?'':'display: none;'}}">
    <br />
    <div class="ui middle aligned centered center aligned stackable padded grid">
        <div class="grey column" style="border-radius: 5px;">
            @csrf
            <div class="fields" style="margin:0px;">
                <x-Countries class="six wide" fieldname="countries" dropdown-css="multiple"/>
                <x-Sectors class="six wide" fieldname="sectors" dropdown-css="multiple"/>
            </div>
            <br/>
            <div class="fields" style="margin:0px;">
                <div class="four wide field">
                    <div class="ui slider checkbox" style="margin-top: 0.5em;">
                        <input type="checkbox" name="is_verified" value="1"
                                {{request('is_verified',false)?'checked':''}}>
                        <label>Show only verified</label>
                    </div>
                </div>
                @if($recent_online)
                    <div class="four wide field">
                        <div class="ui slider checkbox" style="margin-top: 0.5em;">
                            <input type="checkbox" name="last_login" value="desc"
                                    {{request('last_login',false)?'checked':''}}>
                        <label>Sort by recently online</label>
                    </div>
                </div>
                @else
                <div class="four wide field">
                    <div class="ui selection dropdown">
                        <input type="hidden" name="type" value={{request('type',null)}}>
                        <i class="dropdown icon"></i>
                        <div class="default text">Filter types</div>
                        <div class="menu">
                            <div class="item" data-value="">Select type ...</div>
                            <div class="item" data-value="business">Companies</div>
                            <div class="item" data-value="organization">Organizations</div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="six wide field">
                    <div class="ui selection dropdown">
                        <input type="hidden" name="name" value={{request('name',null)}}>
                        <i class="dropdown icon"></i>
                        <div class="default text">Sort by name</div>
                        <div class="menu">
                            <div class="item" data-value="">Order by name ...</div>
                            <div class="item" data-value="asc">Assending order (A-Z)</div>
                            <div class="item" data-value="desc">Descending order (Z-A)</div>
                        </div>
                    </div>
                </div>
                <div class="two wide field">
                    <button class="ui blue fluid button" type="submit"><i class="send icon"></i></button>
                </div>
            </div>
        </div>
    </div>
    <br />
</form>
