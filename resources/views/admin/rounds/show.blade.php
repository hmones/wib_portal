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
                            <span
                                class="ui black text">{!! $round->description ?? '<span style="color:grey;">Not provided</span>' !!}</span>
                        </div>
                    </div>
                    <div class="column"><strong>From </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$round->from}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>To </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$round->to}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Maximum number of applicants </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$round->max_applicants}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Status </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{Str::title($round->status)}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Created at </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$round->created_at}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Updated at </strong>
                        <br>
                        <div class="ui grey small message">
                            <span class="ui black text">{{$round->updated_at}}</span>
                        </div>
                    </div>
                    <div class="column"><strong>Link </strong>
                        <br>
                        <div class="ui grey small message">
                            <a href="{{route('rounds.service-providers.index', $round)}}">
                                {{route('rounds.service-providers.index', $round)}}
                            </a>
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
