@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Rounds', 'url'  => route('admin.rounds.index')], ['name' => 'Round information']]])

@section('content')
    <div class="ui centered container">
        <div class="ui container">
            <div class="ui padded basic segment">
                <div class="ui three column stackable grid">
                    <div class="column">
                        <strong>Description </strong>
                        <br>
                        <div class="ui grey small message">
                            {!! $round->description ?? '<span style="color:grey;">Not provided</span>' !!}
                        </div>
                    </div>
                    <div class="column"><strong>From </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$round->from}}
                        </div>
                    </div>
                    <div class="column"><strong>To </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$round->to}}
                        </div>
                    </div>
                    <div class="column"><strong>Maximum number of applicants </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$round->max_applicants}}
                        </div>
                    </div>
                    <div class="column"><strong>Status </strong>
                        <br>
                        <div class="ui grey small message">
                            {{Str::title($round->status)}}
                        </div>
                    </div>
                    <div class="column"><strong>Created at </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$round->created_at}}
                        </div>
                    </div>
                    <div class="column"><strong>Updated at </strong>
                        <br>
                        <div class="ui grey small message">
                            {{$round->updated_at}}
                        </div>
                    </div>
                    <div class="column"><strong>Link </strong>
                        <br>
                        <div class="ui grey small message">
                            <a href="{{url('rounds/'.$round->id)}}">{{url('rounds/'.$round->id)}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui padded basic segment">
                <form action="{{route('admin.rounds.destroy', $round)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <a class="ui primary button" href="{{route('admin.rounds.edit', $round)}}">
                        <i class="pencil icon"></i>Edit
                    </a>
                    <button type="submit" class="ui red button"><i class="trash icon"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>
@endsection
