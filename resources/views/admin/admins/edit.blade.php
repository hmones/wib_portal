@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Edit profile']]])

@section('content')
    <div class="ui centered container">
        <form action="{{route('admin.admins.update', $admin)}}" method="post">
            @csrf
            @method('patch')
            <div class="ui basic segment" style="margin:0 !important;">
                <div class="ui form">
                    <p><strong>Profile Information</strong></p>
                    <div class="field">
                        <input type="text" name="name" id="name" placeholder="Full name" value="{{$admin->name}}"/>
                        @error('name')
                        <div class="ui negative message">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="field">
                        <input type="text" name="email" id="email" placeholder="Email" value="{{$admin->email}}"/>
                        @error('email')
                        <div class="ui negative message">{{$message}}</div>
                        @enderror
                    </div>
                    <p><strong>Password</strong></p>
                    <div class="two fields">
                        <div class="field">
                            <input type="password" name="password" id="password"
                                   placeholder="Password minimum 8 charachters"/>
                            @error('password')
                            <div class="ui negative message">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   placeholder="Password confirmation"/>
                            @error('confirmPassword')
                            <div class="ui negative message">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui padded basic segment" style="margin:0px; padding-top: 0px">
                <button class="ui right floated blue button" type="submit">Update</button>
                <br><br>
            </div>
        </form>
    </div>
@endsection
