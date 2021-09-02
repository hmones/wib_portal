@extends('layouts.auth')

@section('content')
    <link rel="stylesheet" href="{{asset('css/calendar.min.css')}}"/>
    <script src="{{asset('js/calendar.min.js')}}"></script>
    <div class="ui centered container">
        <h2 class="ui left floated blue header">
            <a href="{{route('admin.events.index')}}">Rounds</a> > @isset($event) Edit @else New @endisset Round
        </h2>
        <br><br>
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
                                <textarea id="description" rows="16" type="text" name="description"
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
                                               value="{{$event->from ?? old('from')}}">
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
                                    <option value="{{\App\Models\Round::DRAFT}}">Draft</option>
                                    <option value="{{\App\Models\Round::PUBLISHED}}">Published</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui padded basic segment">
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
