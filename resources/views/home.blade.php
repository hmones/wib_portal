@extends('layouts.default')
@section('title', 'Home Page')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    @include('partials.home.image-slide', ['event' => $events->first()])
    <div class="ui hidden divider"></div>
    @include('partials.separator')
    @include('partials.home.upcoming-events')
    @include('partials.home.services')
    @includeWhen(auth()->check(), 'partials.home.signup')
    @include('partials.home.testimonial-slider')
    <br/>
@endsection

