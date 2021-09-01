@extends('layouts.auth')

@section('content')
    <div class="ui centered container">
        <h2 class="ui left floated blue header">
            <a href="{{route('admin.events.index')}}">Events</a> > @isset($event) Edit @endisset Event
        </h2>
        <br><br>
        <form class="ui form" @isset($event) action="{{route('admin.events.update', $event)}}" method="post"
              @else action="{{route('admin.events.store')}}" method="post" @endisset>
            @isset($event)@method('PUT')@endisset
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
                            <div class="required field">
                                <br>
                                <input required id="title" type="text" name="title" placeholder="Event title..."
                                       value="{{$event->title ?? old('title')}}"/>
                            </div>
                            <strong><label for="description">Description</label> </strong>
                            <div class="field">
                                <br>
                                <textarea id="description" rows="16" type="text" name="description"
                                          placeholder="Event description...">{{$event->description ?? old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="column">
                            <strong><label for="location">Location </label></strong>
                            <div class="required field">
                                <br>
                                <input required id="location" type="text" name="location" placeholder="Event location..."
                                       value="{{$event->location ?? old('location')}}"/>
                            </div>
                            <strong><label for="from">From </label> </strong>
                            <div class="required field">
                                <br>
                                <input required id="from" type="text" name="from" placeholder="Event start date..."
                                       value="{{$event->from ?? old('from')}}"/>
                            </div>
                            <strong><label for="to">To </label> </strong>
                            <div class="required field">
                                <br>
                                <input required id="to" type="text" name="to" placeholder="Event end date..."
                                       value="{{$event->to ?? old('to')}}"/>
                            </div>
                            <strong><label for="link">Event Link </label></strong>
                            <div class="field">
                                <br>
                                <input id="link" type="text" name="link"
                                       placeholder="Event link..."
                                       value="{{$event->link ?? old('link')}}"/>
                            </div>
                            <strong><label for="button_text">Button Text </label></strong>
                            <div class="field">
                                <br>
                                <input id="button_text" type="text" name="button_text"
                                       placeholder="Event button text..."
                                       value="{{$event->button_text ?? old('button_text')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui padded basic segment">
                    <button type="submit" class="ui primary button"><i class="save icon"></i>Save</button>
                </div>
        </form>
    </div>
    <br><br>
@endsection
