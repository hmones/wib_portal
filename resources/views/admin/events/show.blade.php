@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Events', 'url'  => route('admin.events.index')], ['name' => 'Event information']]])

@section('content')
    <div class="ui centered container">
        <div class="ui container">
            <div class="ui padded basic segment">
                <div class="ui three column stackable grid">
                    <div class="column">
                        <strong>Image </strong>
                        <br>
                        <img class="ui image" src="{{$event->image}}" alt="{{$event->title}}"/>
                    </div>
                    <div class="column">
                        <strong>Title </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->title}}</span>
                        </div>
                        <br>
                        <strong>Description </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{!! $event->description ?? '<span style="color:grey;">Not provided</span>' !!}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Location </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->location}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>From </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->from}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>To </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->to}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Button Text </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->button_text}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Created at </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->created_at}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Updated at </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$event->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui padded basic segment">
                <form action="{{route('admin.events.destroy', $event)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <a class="ui primary button" href="{{route('admin.events.edit', $event)}}">
                        <i class="pencil icon"></i>Edit
                    </a>
                    <button type="submit" class="ui red button"><i class="trash icon"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>
@endsection
