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
        <br><br>
        <table class="ui celled stackable table">
            <thead>
            <tr>
                <th class="three wide">Title</th>
                <th class="one wide">From</th>
                <th class="one wide">To</th>
                <th class="one wide">Location</th>
                <th class="one wide">Created at</th>
                <th class="one wide">Updated at</th>
                <th class="one wide">Action</th>
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
                        <a href="javascript:void(0);"
                           onclick="deleteEvent('{{route('admin.events.destroy', $event)}}');">
                            <i class="trash red icon"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
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
