@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Rounds']]])

@section('content')
    <script>
        function deleteRound(link) {
            $('#round_delete_form').attr('action', link).submit();
        }
    </script>
    <div class="ui centered container">
        <a href="{{route('admin.rounds.create')}}" class="ui right floated primary button"><i class="plus icon"></i>New</a>
        <br><br>
        <table class="ui celled stackable table" aria-describedby="Events table">
            <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Max Applicants</th>
                <th scope="col">Status</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($rounds as $round)
                <tr>
                    <td>
                        {{$round->from->format('d-m-Y')}}
                    </td>
                    <td>
                        {{$round->to->format('d-m-Y')}}
                    </td>
                    <td>
                        {{$round->max_applicants}}
                    </td>
                    <td>
                        {{Str::title($round->status)}}
                    </td>
                    <td>
                        {{$round->created_at->diffForHumans()}}
                    </td>
                    <td>
                        {{$round->updated_at->diffForHumans()}}
                    </td>
                    <td class="center aligned">
                        <a href="{{route('admin.rounds.show', $round)}}">
                            <i class="eye blue icon"></i>
                        </a>
                        <a href="{{route('admin.rounds.edit', $round)}}">
                            <i class="pencil blue icon"></i>
                        </a>
                        <a href="javascript:void(0);"
                           onclick="deleteRound('{{route('admin.rounds.destroy', $round)}}');">
                            <i class="trash red icon"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center aligned" colspan="7">
                        <p>No rounds created yet!</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <br><br><br>
    <div class="ui centered grid">
        <div class="ui centered basic segment">
            {{ $rounds->appends($_GET)->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
    <br><br>
    <form action="" method="post" id="round_delete_form">
        @method('DELETE')
        @csrf
    </form>
@endsection
