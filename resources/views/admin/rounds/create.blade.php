@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Rounds', 'url'  => route('admin.rounds.index')], ['name' => isset($round) ? 'Edit Round' : 'New Round']]])

@section('content')
    @include('partials.semantic-component', ['componentName' => 'calendar'])
    <div class="ui centered container">
        <form class="ui form"
              action="{{isset($round) ? route('admin.rounds.update', $round) : route('admin.rounds.store')}}"
              method="post">
            @isset($round)@method('PUT')@endisset
            @csrf
            <div class="ui container">
                <div class="ui padded basic segment">
                    <div class="ui three column stackable grid">
                        <div class="column">
                            <div class="field">
                                <label for="description">Description</label>
                                <textarea id="description" rows="5" type="text" name="description"
                                          placeholder="Round description...">{{$round->description ?? old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="column">
                            <div class="required field">
                                <label for="from">From </label>
                                <div class="ui calendar">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input id="from" name="from" type="text" placeholder="Round opening date..."
                                               value="{{$round->from ?? old('from')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="required field">
                                <label for="to">To </label>
                                <div class="ui calendar">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input id="to" name="to" type="text" placeholder="Round closing date..."
                                               value="{{$round->to ?? old('to')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="required field">
                                <label for="max_applicants">Maximum number of applicants </label>
                                <input required id="max_applicants" type="text" name="max_applicants"
                                       placeholder="Maximum number of applicants..."
                                       value="{{$round->max_applicants ?? old('max_applicants')}}"/>
                            </div>
                            <div class="field">
                                <label for="status">Round status</label>
                                <select name="status" id="status">
                                    <option value="" {{isset($round->status) ? '' : 'selected'}} disabled hidden>Select
                                        status ...
                                    </option>
                                    @foreach(\App\Models\Round::STATUSES as $status)
                                        <option
                                            value="{{$status}}" {{($round->status ?? old('status')) === $status ? 'selected' : ''}}>
                                            {{Str::title($status)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui padded basic right floated segment">
                    <a href="{{route('admin.rounds.index')}}" class="ui red button"><i class="close icon"></i>Cancel</a>
                    <button type="submit" class="ui primary button"><i class="save icon"></i>Save</button>
                </div>
            </div>
        </form>
    </div>
    <br><br>
@endsection
@section('scripts')
    <script>
        $('.ui.calendar').calendar();
        $('select.dropdown').dropdown();
    </script>
@endsection
