@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Events', 'url'  => route('admin.events.index')], ['name' => isset($event) ? 'Edit Event' : 'New Event']]])

@section('content')
    @include('partials.semantic-component', ['componentName' => 'calendar'])
    <div class="ui centered container">
        <form class="ui form"
              action="{{isset($event) ? route('admin.events.update', $event) : route('admin.events.store')}}"
              method="post" enctype="multipart/form-data">
            @isset($event)@method('PUT')@endisset
            @csrf
            <div class="ui container">
                <div class="ui padded basic segment">
                    <div class="ui three column stackable grid">
                        <div class="column">
                            <div class="required field">
                                <label>Image </label>
                                @include('partials.components.imageUpload', [
                                    'options' => [
                                        'value'  => isset($event) ? optional($event)->image : null,
                                        'width'  => 500,
                                        'height' => 700,
                                    ]
                                ])
                            </div>
                        </div>
                        <div class="column">
                            <div class="required field">
                                <label for="title">Title </label>
                                <input required id="title" type="text" name="title" placeholder="Event title..."
                                       value="{{$event->title ?? old('title')}}"/>
                            </div>
                            <div class="field">
                                <label for="description">Description</label>
                                <textarea id="description" rows="16" type="text" name="description"
                                          placeholder="Event description...">{{$event->description ?? old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="column">
                            <div class="required field">
                                <label for="location">Location </label>
                                <input required id="location" type="text" name="location"
                                       placeholder="Event location..."
                                       value="{{$event->location ?? old('location')}}"/>
                            </div>
                            <div class="required field">
                                <label for="from">From </label>
                                <div class="ui calendar">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input id="from" name="from" type="text" placeholder="Event start date..."
                                               value="{{$event->from ?? old('from')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="required field">
                                <label for="to">To </label>
                                <div class="ui calendar">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input id="to" name="to" type="text" placeholder="Event end date..."
                                               value="{{$event->to ?? old('to')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="link">Event Link </label>
                                <input id="link" type="text" name="link"
                                       placeholder="Event link..."
                                       value="{{$event->link ?? old('link')}}"/>
                            </div>
                            <div class="field">
                                <label for="button_text">Button Text </label>
                                <input id="button_text" type="text" name="button_text"
                                       placeholder="Event button text..."
                                       value="{{$event->button_text ?? old('button_text')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui padded basic right floated segment">
                    <a href="{{route('admin.events.index')}}" class="ui red button"><i class="close icon"></i>Cancel</a>
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
    </script>
@endsection
