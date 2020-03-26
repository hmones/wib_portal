@extends('layouts.auth')

@section('content')
<div class="ui center aligned container">
    <br>
    <h3 class="ui centered center aligned blue horizontal divider header"> <i class="home blue large icon"></i>  Dashboard</h3>
    <div class="ui left aligned basic very padded segment">
        <table class="ui stackable table">
            <tr>
                <td class="one wide">
                    <i class="users blue icon"></i>
                </td>
                <td class="thirteen wide">
                     Registered Users
                </td>
                <td class="three wide">
                    <div class="ui basic fluid center aligned label">{{$users}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <i class="blue building icon"></i>
                </td>
                <td>
                    Registered Businesses/Organizations
                </td>
                <td>
                    <div class="ui basic fluid center aligned label">{{$entities}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <i class="blue tasks icon"></i>
                </td>
                <td>
                    Entity Types Supported by the Platform
                </td>
                <td>
                    <div class="ui basic fluid center aligned label">{{$entityTypes}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <i class="blue folder icon"></i>
                </td>
                <td>
                    Sectors Supported by the Platform
                </td>
                <td>
                    <div class="ui basic fluid center aligned label">{{$sectors}}</div>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
