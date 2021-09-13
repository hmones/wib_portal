@extends('layouts.default')
@section('title', 'Home Page')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    @includeWhen($events->count() > 0, 'partials.home.image-slide', ['event' => $events->first()])
    <div class="ui hidden divider"></div>
    @includeWhen($events->count() > 0, 'partials.separator')
    @includeWhen($events->count() > 0, 'partials.home.upcoming-events')
    @include('partials.home.services')
    @includeWhen(auth()->guest(), 'partials.home.signup')
    @include('partials.home.testimonial-slider')
    <br/>
@endsection

