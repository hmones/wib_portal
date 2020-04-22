@extends('layouts.auth')

@section('content')
    <style>
        .ui.grey.label{
            color: black !important;
        }
    </style>
    <br><br>
    <div class="ui centered container">
        <h3 class="ui blue header"> <i class="stop wib bullet icon"></i> Registered members</h3>
        <div class="ui basic segment">
            <table class="ui celled stackable table">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Created</th>
                    <th>Actions</th>
                    <th>Verify</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <h4 class="ui image header">
                                @if($user->avatar()->exists())
                                    <img src="{{$user->avatar()->thumbnail()->url}}" class="ui circular image" alt="{{$user->name}}'s avatar">
                                @else
                                    <i class="circular inverted grey user small icon"></i>
                                @endif
                                <div class="content">
                                    {{\Illuminate\Support\Str::limit($user->name, 22,$end='..')}}
                                    <div class="sub header">{{ $user->entities()->exists() ? \Illuminate\Support\Str::limit($user->entities->first()->name, 27,$end='..'):'No organization'}}
                                    </div>
                                </div>
                            </h4></td>
                        <td>
                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                        </td>
                        <td>
                            {{$user->country()->exists()? $user->country->name:'None'}}
                        </td>
                        <td>
                            {{$user->city()->exists()? $user->city->name:'None'}}
                        </td>
                        <td>
                            {{$user->created_at->diffForHumans()}}
                        </td>
                        <td class="center aligned">
                            <a href="#" onclick="handleViewUser(event, {{$user->id}});"><i class="eye blue icon"></i></a>
                            <a href="#" onclick="handleDeleteUser(event, {{$user->id}});"><i class="trash red icon"></i></a>
                        </td>
                        <td>
                            <div class="ui toggle checkbox">
                                <input class="verify user checkbox" type="checkbox" data-value="{{$user->id}}" {{$user->approved_at?'checked':''}}>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"><p>No users registered currently!</p></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br>
    <div class="ui centered grid">
        <div class="ui centered basic segment">
            {{ $users->appends($_GET)->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
    <br><br>
    <br><br><br>
    <div class="ui small modal">
        <div class="ui header">User Information</div>
        <div class="ui padded basic segment">
            <div class="user information ui three column stackable grid">

            </div>
        </div>
        <div class="ui actions">
            <div class="ui right floated red button" onclick="$('.ui.small.modal').modal('hide');">Close</div>
            <br><br>
        </div>
    </div>
    <form id="user_delete_form" action="" method="POST">
        @csrf
        @method('DELETE')
    </form>
    <form id="user_verify_form" action="" method="POST">
        @csrf
    </form>
@endsection

@section('scripts')
    <script>
        $('.ui.checkbox').checkbox();
        $('.ui.small.modal').modal();
        function handleViewUser(e, id){
            e.preventDefault();
            var token = '{{Session::token()}}';
            var url = '/admin/api/profile/'+id;
            var users_url = '/admin/users';
            $.ajax({
                method: "GET",
                url: url,
            }).done(function (msg) {
                if (msg['id'] === id) {
                    var html = '<div class="column"><strong>Name </strong></br></br><div class="ui grey large label">'+msg['title']+', '+msg['name']+'</div></div><div class="column"><strong>Gender </strong></br></br><div class="ui grey large label">'+msg['gender']+'</div></div><div class="column"><strong>Birth Year </strong></br></br><div class="ui grey large label">'+msg['birth_year']+'</div></div><div class="column"><strong>Account created at </strong></br></br><div class="ui grey large label">'+msg['created_at']+'</div></div><div class="column"><strong>Information updated at </strong></br></br><div class="ui grey large label">'+msg['updated_at']+'</div></div>'+'<div class="column"><strong>Email </strong></br></br><div class="ui grey large label">'+msg['email']+'</div></div><div class="column"><strong>Email verified at </strong></br></br><div class="ui grey large label">'+msg['email_verified_at']+'</div></div><div class="column"><strong>Education </strong></br></br><div class="ui grey large label">'+msg['education']+'</div></div><div class="column"><strong>Mena Diaspora </strong></br></br><div class="ui grey large label">'+msg['mena_diaspora']+'</div></div><div class="column"><strong>Association </strong></br></br><div class="ui grey large label">'+msg['business_association_wom']+'</div></div><div class="column"><strong>Phone Number </strong></br></br><div class="ui grey large label">+'+msg['phone_country_code']+msg['phone']+'</div></div><div class="column"><strong>Subscribed to Newsletter </strong></br></br><div class="ui grey large label">'+msg['newsletter']+'</div></div><div class="column"><strong>Profile </strong></br></br><div class="ui grey large label">'+msg['bio']+'</div></div>';
                    $('.user.information    ').html(html);
                    $('.ui.small.modal').modal('show');

                } else {
                    alert('User does not exist in the database');
                }
            });
        }
        function handleDeleteUser(e, id){
            e.preventDefault();
            var url = '/admin/api/profile/'+id;
            $('#user_delete_form').attr('action',url).submit();
        }
        $('.verify.user.checkbox').change(function () {
            var url = '/admin/api/profile/'+$(this).attr('data-value');
            $('#user_verify_form').attr('action',url).submit();
        });
    </script>
@endsection
