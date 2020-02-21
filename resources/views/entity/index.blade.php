@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui centered container">
        <h1 class="ui blue header">Recently registered Businesses and Organizations</h1>
        <br>
        <div class="ui four column stackable grid">
            @forelse($entities as $entity)
                @include('partials.entity.card', $entity)
            @empty
                <div class="ui centered center aligned header">There are currently no registered organizations</div>
            @endforelse
        </div>
    </div>
    <br><br><br>

@endsection
