@extends('layouts.auth')

@section('content')
    <div class="ui centered container">
        <h2 class="ui left floated blue header">
            <a href="{{route('admin.events.index')}}">Events</a> > @isset($event) Edit @endisset Event
        </h2>
        <br><br>
        <form class="ui form" action="{{route('admin.events.create')}}" method="post">
            @csrf
            <div class="ui container">
                <div class="ui padded basic segment">
                    <div class="ui three column stackable grid">
                        <div class="column">
                            <strong>Image </strong>
                            <div class="ui grey small message">
                                @include('partials.components.imageUpload', [
                                'options' => [
                                    'value'  => isset($event) ? optional($event)->image : null,
                                    'width'  => 300,
                                    'height' => 500,
                                ]
                            ])
                            </div>
                        </div>
                        <div class="column">
                            <strong><label for="title">Title </label></strong>
                            <div class="field">
                                <br>
                                <input id="title" type="text" name="title" placeholder="Event title..."
                                       value="{{$event->title ?? old('title')}}"/>
                            </div>
                            <strong><label for="description">Description</label> </strong>
                            <div class="field">
                                <br>
                                <textarea id="description" rows="4" type="text" name="description"
                                          placeholder="Event description...">
                                    {{$event->description ?? old('description')}}
                                </textarea>
                            </div>
                            <strong><label for="location">Button Text </label></strong>
                            <div class="field">
                                <br>
                                <input id="button_text" type="text" name="button_text"
                                       placeholder="Event button text..."
                                       value="{{$event->button_text ?? old('button_text')}}"/>
                            </div>
                        </div>
                        <div class="column">
                            <strong><label for="location">Location </label></strong>
                            <div class="field">
                                <br>
                                <input id="location" type="text" name="location" placeholder="Event location..."
                                       value="{{$event->location ?? old('location')}}"/>
                            </div>
                            <strong><label for="location">From </label> </strong>
                            <div class="field">
                                <br>
                                <input id="from" type="text" name="from" placeholder="Event start date..."
                                       value="{{$event->from ?? old('from')}}"/>
                            </div>
                            <strong><label for="location">To </label> </strong>
                            <div class="field">
                                <br>
                                <input id="to" type="text" name="to" placeholder="Event end date..."
                                       value="{{$event->to ?? old('to')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <br><br>
@endsection
