@extends('layouts.auth')

@section('content')
    <div class="ui centered container">
        <h2 class="ui left floated blue header">
            <a href="{{route('admin.events.index')}}">Events</a> > Event Information
        </h2>
        <br><br>
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
                            {{$event->title}}
                        </div>
                        <br>
                        <strong>Description </strong>
                        <br>
                        <div class="ui grey small message">
                            {!! $event->description ?? '<span style="color:grey;">Not provided</span>' !!}
                        </div>
                    </div>
                    <div class="column"><strong>Location </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$event->location}}
                        </div>
                    </div>
                    <div class="column"><strong>From </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$event->from}}
                        </div>
                    </div>
                    <div class="column"><strong>To </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$event->to}}
                        </div>
                    </div>
                    <div class="column"><strong>Button Text </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$event->button_text}}
                        </div>
                    </div>
                    <div class="column"><strong>Created at </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$event->created_at}}
                        </div>
                    </div>
                    <div class="column"><strong>Updated at </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$event->updated_at}}
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
