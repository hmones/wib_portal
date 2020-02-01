@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui centered container">
        <h1 class="ui blue header">Recently registered organizations</h1>
        <div class="ui basic segment">
            <table class="ui celled stackable table">
                <thead>
                <tr>
                    <th class="five wide">Name</th>
                    <th class="four wide">Email</th>
                    <th class="two wide">Country</th>
                    <th class="two wide">City</th>
                    <th class="two wide">Created</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($entities as $entity)
                    <tr>
                        <td>
                            <h4 class="ui image header">
                                @if($entity->logo()->exists())
                                    <img src="{{$entity->logo()->thumbnail()->url}}" class="ui circular image" alt="{{$entity->name}}'s avatar">
                                @else
                                    <i class="circular inverted grey image small icon"></i>
                                @endif
                                <div class="content">
                                    {{$entity->name}}
                                    <div class="sub header">{{ $entity->users()->exists() ? $entity->users->first()->name:'No users'}}
                                    </div>
                                </div>
                            </h4></td>
                        <td>
                            <a href="mailto:{{$entity->primary_email}}">{{$entity->primary_email}}</a>
                        </td>
                        <td>
                            {{$entity->primary_country()->exists()? $entity->primary_country->name:'None'}}
                        </td>
                        <td>
                            {{$entity->primary_city()->exists()? $entity->primary_city->name:'None'}}
                        </td>
                        <td>
                            {{$entity->created_at->diffForHumans()}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"><p>No organizations registered currently!</p></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br>

@endsection
