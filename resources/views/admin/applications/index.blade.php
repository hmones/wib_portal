@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Manage B2B applications']]])

@section('content')
    <div class="ui centered container">
        <livewire:b2b-applicants/>
    </div>
@endsection
