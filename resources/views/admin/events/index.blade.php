@extends('layouts.auth')

@section('content')
    <script>
        function deleteEvent(link) {
            $('#event_delete_form').attr('action', link).submit();
        }
    </script>
    <div class="ui centered container">
        <h2 class="ui left floated blue header">
            Events
        </h2>
        <a href="{{route('admin.events.create')}}" class="ui right floated primary button"><i class="plus icon"></i>New</a>
        <br><br>
        <table class="ui celled stackable table" aria-describedby="Events table">
            <thead>
            <tr>
                <th scope="col" class="three wide">Title</th>
                <th scope="col" class="one wide">From</th>
                <th scope="col" class="one wide">To</th>
                <th scope="col" class="one wide">Location</th>
                <th scope="col" class="one wide">Created at</th>
                <th scope="col" class="one wide">Updated at</th>
                <th scope="col" class="one wide">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>
                        <a href="{{route('admin.events.show', $event)}}">
                            {{$event->title}}
                        </a>
                    </td>
                    <td>
                        {{$event->from->format('d-m-Y')}}
                    </td>
                    <td>
                        {{$event->to->format('d-m-Y')}}
                    </td>
                    <td>
                        {{$event->location}}
                    </td>
                    <td>
                        {{$event->created_at->diffForHumans()}}
                    </td>
                    <td>
                        {{$event->updated_at->diffForHumans()}}
                    </td>
                    <td class="center aligned">
                        <a href="{{route('admin.events.edit', $event)}}">
                            <i class="pencil blue icon"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="deleteEvent('{{route('admin.events.destroy', $event)}}');">
                            <i class="trash red icon"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center aligned" colspan="7">
                        <p>No events created yet!</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <br><br><br>
    <div class="ui centered grid">
        <div class="ui centered basic segment">
            {{ $events->appends($_GET)->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
    <br><br>
    <form action="" method="post" id="event_delete_form">
        @method('DELETE')
        @csrf
    </form>
@endsection