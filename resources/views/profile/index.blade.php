@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui centered container">
        <h1 class="ui blue header">Recently registered members</h1>
        <div class="ui basic segment">
            <table class="ui celled stackable table">
                <thead>
                <tr>
                    <th class="five wide">User</th>
                    <th class="four wide">Email</th>
                    <th class="two wide">Country</th>
                    <th class="two wide">City</th>
                    <th class="two wide">Created</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <h4 class="ui image header">
                                @if($user->avatar()->exists())
                                    <img src="{{$user->avatar()->thumbnail()->url}}" class="ui circular image" alt="{{$user->name}}'s avatar">
                                @else
                                    <i class="circular inverted grey user small icon"></i>
                                @endif
                                <div class="content">
                                    {{$user->name}}
                                    <div class="sub header">{{ $user->entities()->exists() ? $user->entities->first()->name:'No organization'}}
                                    </div>
                                </div>
                            </h4></td>
                        <td>
                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                        </td>
                        <td>
                            {{$user->country()->exists()? $user->country->name:'None'}}
                        </td>
                        <td>
                            {{$user->city()->exists()? $user->city->name:'None'}}
                        </td>
                        <td>
                            {{$user->created_at->diffForHumans()}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"><p>No users registered currently!</p></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <a href="{{route('profile.create')}}" class="ui right floated blue button">Create a new user</a>
        </div>
    </div>
    <br><br><br>

@endsection
