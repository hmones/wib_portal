<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Women in Business Portal | Users Listing</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/semantic.min.css')}}" rel="stylesheet" type="text/css">
        <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        <script type="application/javascript" src="{{asset('js/semantic.min.js')}}"></script>
    </head>
    <body>
        <div class="ui grid">
            <div class="ui container">
                <br><br>
                <img class="ui centered center aligned image" src="{{asset('images/logo.png')}}" alt="">
            </div>
        </div>
        <br>
        <div class="ui centered container">
            <div class="ui centered center aligned very padded basic segment">
                <h1 class="ui centered header">Currently registered users</h1>
                <br>
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
                        <td>
                            <h4 class="ui image header">
                                <img src="{{url('storage/app/wib_uploads/users/avatar/90x90/')}}{{$user->avatar}}" class="ui mini rounded image" alt="{{$user->name}}'s avatar">
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
                    @empty
                        <tr>
                            <td colspan="4"><p>No users registered currently!</p></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <a href="{{route('profile.create')}}" class="ui left floated button">Create a new user</a>
            </div>
        </div>

    </body>
</html>
