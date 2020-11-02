<form action="{{$route}}" method="GET" class="ui form">
    <div class="ui middle aligned centered center aligned stackable padded grid">
        <div class="grey column" style="border-radius: 5px;">
            @csrf
            <div class="fields" style="margin:0;">
                <x-Countries class="seven wide" dropdown-css="multiple" fieldname="countries[]" />
                <x-Sectors class="seven wide" fieldname="sectors[]" dropdown-css="multiple" />
                <div class="two wide field">
                    <button class="ui right labeled grey icon button" type="submit"><i
                            class="filter teal icon"></i><span style="color:#1a4d99">Filter</span></button>
                </div>
            </div>
        </div>
    </div>
</form>