@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Manage admins']]])

@section('content')
    <div class="ui centered container">
        <livewire:show-admins/>
    </div>
@endsection
