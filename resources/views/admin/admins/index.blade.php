@extends('layouts.auth')

@section('content')
    <div class="ui centered container">
        <h2 class="ui blue header">Admin Users</h2>
        <livewire:show-admins/>
    </div>
@endsection
