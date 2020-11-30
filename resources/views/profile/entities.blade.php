@extends('layouts.default')
@section('title','My Companies and Organizations')
@section('content')
<br>
<div class="ui centered container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>My Companies and Organizations</h1>
    <br>
    <table class="ui middle aligned centered center aligned very basic table">
        <thead>
            <tr>
                <th colspan="2" class="ui blue center aligned header">Organization name</th>
                <th class="ui blue center aligned header">Relationship to the organization</th>
                <th class="ui blue center aligned header">Actions</th>
            </tr>
        </thead>
        @forelse($owned_entities as $entity)
        <tr>
            <td>
                @if($entity->image)
                <img class="ui tiny circular centered image" src="{{$entity->image}}" alt="{{$entity->name}}">
                @else
                <i class="circular grey inverted image big icon"></i>
                @endif

            </td>
            <td>
                {{$entity->name}}
            </td>
            <td>
                {{isset($entity->users()->where('id',Auth::id())->first()->pivot->relation_type)?$entity->users()->where('id',Auth::id())->first()->pivot->relation_type:'No relationship'}}
            </td>
            <td>
                <a href="{{$entity->path . '/edit'}}" class="ui basic blue button"> <i class="pencil icon"></i> Edit</a>
                <a data-text="{{$entity->path}}" class="ui basic red button delete entity"> <i class="trash icon"></i>
                    Remove</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">You have no organization registered</td>
        </tr>
        @endforelse
        <tr class="ui inverted grey table">
            <td colspan="4">
                <div class="ui basic centered center aligned basic segment">
                    <a class="ui teal basic button" href="{{route('entity.create')}}"> <i class="plus icon"></i>
                        Register an organization</a>
                </div>
            </td>
        </tr>
    </table>
    <br><br>
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Other Companies and Organizations</h1>
    <br>
    <table class="ui middle aligned centered center aligned very basic table">
        <thead>
            <tr>
                <th class="center aligned ui blue header" colspan="2">Organization name</th>
                <th class="center aligned ui blue header">Relationship to the organization</th>
                <th class="center aligned ui blue header">Actions</th>
            </tr>
        </thead>
        @forelse($other_entities as $entity)
        <tr>
            <td>
                @if($entity->image)
                <img class="ui tiny circular centered image" src="{{$entity->image}}" alt="{{$entity->name}}">
                @else
                <i class="circular grey inverted image big icon"></i>
                @endif
            </td>
            <td>
                {{$entity->name}}
            </td>
            <td>
                {{isset($entity->users()->find(Auth::id())->pivot->relation_type)?$entity->users()->find(Auth::id())->pivot->relation_type:'No relationship'}}
            </td>
            <td>
                <a data-text="{{$entity->id}}" class="ui basic red button disassociate entity"> <i
                        class="trash icon"></i> Remove</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">You have no organization registered</td>
        </tr>
        @endforelse
        <tr class="ui inverted grey table">
            <form id="entity_associate_form" action="{{route('profile.entities.associate',['profile'=> Auth::user()])}}"
                method="POST">
                @csrf
                <td colspan="2">
                    <div class="required field">
                        <div id="entity_search_dropdown"
                            class="ui fluid search selection dropdown entity_search_dropdown @error('other_entity_name') error @enderror">
                            <input required type="hidden" name="other_entity_name">
                            <i class="search icon" style="padding-top:10px;"></i>
                            <div class="default text">Search for a registered organization</div>
                            <div class="menu">
                                <div class="item">Select an organization</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="required field">
                        <div class="ui fluid search selection dropdown @error('other_entity_relation') error @enderror">
                            <input required type="hidden" name="other_entity_relation">
                            <i class="dropdown icon"></i>
                            <div class="default text">What is your relation to the organization?</div>
                            <div class="menu">
                                <div class="item">Select relationship</div>
                                @foreach ($relations as $relation)
                                <div class="item" data-value="{{$relation}}">{{$relation}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="submit" class="ui teal button"><i class="plus icon"></i> Add</button>
                </td>
            </form>
        </tr>
    </table>
</div>
<br><br><br>
<form id="entity_disassociate" action="" method="POST">
    @csrf
    @method('POST')
</form>
<form id="entity_delete" action="" method="POST">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script type="application/javascript">
    $('.ui.basic.red.button.disassociate.entity').click(function () {
            let disassociated_entity = $(this).attr('data-text');
            if (disassociated_entity !== '') {
                let disassociate_url = '/profile/entities/' + disassociated_entity + '/disassociate';
                $('#entity_disassociate').attr('action', disassociate_url).submit();
            }
        });
        $('.ui.basic.red.button.delete.entity').click(function () {
            let delete_url = $(this).attr('data-text');
            if (delete_url !== '') {
                $('#entity_delete').attr('action', delete_url).submit();
            }
        });
        $(function () {
            $('#entity_search_dropdown').dropdown('destroy').dropdown({
                minCharacters: 1,
                saveRemoteData: false,
                apiSettings: {
                    on: 'change',
                    method: 'GET',
                    // this url parses query server side and returns filtered results
                    url: '/entities/search/?query={query}',
                    data: {
                        _token: "{{Session::token()}}",
                    }
                },
                onResponse: function (response) {
                    console.log('onresp');
                    console.log(response)
                },
                onSuccess: function (response, element) {
                    console.log('suc');
                    console.log(response);
                    // valid response and response.success = true
                },
                onFailure: function (response, element) {
                    console.log('fail');
                },
            });
        });


        $('select[name=problems]').dropdown('destroy').dropdown({
            minCharacters: 3,
            saveRemoteData: false,
            apiSettings: {
                on: 'change',
                url: '/ajax/contest.getProblemQuery/',
                method: 'post',
                data: {
                    argv: {
                        page: 0,
                        limit: 1000
                    }
                },
                beforeSend: function (settings) {
                    settings.data.argv.q = settings.urlData.query;
                    return settings;
                },
                beforeXHR: function (xhr) {
                    console.log('xhr');
                    console.log(xhr);
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('X-CSRFToken', $.cookie('csrftoken'));
                    return xhr;
                },
                onResponse: function (response) {
                    console.log('onresp');
                    if (response != 'F' && response.length != 0) {
                        var list = {results: [], success: true};
                        for (var i = 0; i < response.items.length; ++i) {
                            list.results.push({
                                value: response.items[i][0],
                                name: response.items[i][1] + ' - ' + response.items[i][2],
                                text: response.items[i][1] + ' - ' + response.items[i][2]
                            });
                        }
                        return list;
                    } else
                        return {success: false};
                },
                successTest: function (response) {
                    return response.success || false;
                },
                onComplete: function (response, element, xhr) {
                    // always called after XHR complete
                },
                onSuccess: function (response, element) {
                    console.log('suc');
                    console.log(response);
                    // valid response and response.success = true
                },
                onFailure: function (response, element) {
                    console.log('fail');
                },
                onError: function (errorMessage, element, xhr) {
                    // invalid response
                },
                onAbort: function (errorMessage, element, xhr) {
                    // navigated to a new page, CORS issue, or user canceled request
                }
            }
        });
</script>
@endsection