@extends('layouts.default')
@section('title', 'Organizations and Businesses')
@section('content')
<div class="ui centered container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered Businesses and Organizations</h1>
    <br>
    @include('partials.filter_section', ['route' => route('entity.index')])
    <br><br>
    <div class="ui four column stackable grid">
        @forelse($entities as $entity)
        @include('partials.entity.card', $entity)
        @empty
        <div class="ui centered center aligned header"><i class="info circle teal icon"></i> No businesses or
            organizations to display
        </div>
        @endforelse
    </div>
</div>
<br><br><br>
<div class="ui centered grid">
    <div class="ui centered basic segment">
        {{ $entities->appends($_GET)->links('vendor.pagination.semantic-ui') }}
    </div>
</div>
<br><br>

@endsection