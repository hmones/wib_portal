@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Manage users']]])

@section('content')
    <div class="ui centered container">
        <form action="{{route('admin.users')}}" method="GET" class="ui form">
            @csrf
            <div class="sixteen fields">
                <div class="thirteen wide field">
                    <div class="ui icon input fluid field">
                        <input type="text" name="query" value="{{request()->has('query')?request()->input('query'):''}}"/>
                        <i class="search link icon"></i>
                    </div>
                </div>
                <div class="three wide field">
                    <a href="{{route('admin.users', ['export' => 'xlsx'] + request()->input())}}"
                       class="ui primary basic fluid button">
                        <i class="download icon"></i> Download
                    </a>
                </div>
            </div>
        </form>
        @include('partials.filter_section', ['route' => route('admin.users'), 'recent_online' => true])
        <table class="ui celled stackable table">
            <thead>
            <tr>
                <th class="five wide">User</th>
                <th class="three wide">Email</th>
                <th class="one wide">Completion</th>
                <th class="one wide">Country</th>
                <th class="one wide">City</th>
                <th class="two wide">Created</th>
                <th class="one wide">Actions</th>
                <th class="one wide">Verify</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        <h4 class="ui image header">
                            @include('partials.components.avatar', ['type'=>'user','user'=>$user])
                            <div class="content">
                                <a href="{{$user->path}}" class="tooltip" data-content="{{$user->name}}">
                                    {{Str::of($user->name)->lower()->ucfirst()->limit(13,$end='..')}}
                                </a>
                                <div class="sub header tooltip"
                                     data-content="{{optional($user->entities->first())->name}}">
                                    @if($user->entities()->exists())
                                        <a href="{{optional($user->entities->first())->path}}">
                                            {{Str::of($user->entities->first()->name)->lower()->ucfirst()->limit(13,$end='..')}}
                                        </a>
                                    @else
                                        No organization
                                    @endif
                                </div>
                            </div>
                        </h4>
                    </td>
                    <td>
                        <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                    </td>
                    <td>
                        {{$user->data_percent}}%
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
                        <a href="#" onclick="handleImpersonateUser(event, {{$user->id}});"><i
                                class="secret user blue icon"></i></a>
                        <a href="#" onclick="handleDeleteUser(event, {{$user->id}});"><i class="trash red icon"></i></a>
                    </td>
                    <td>
                        <div class="ui toggle checkbox">
                            <input class="verify user checkbox" type="checkbox" data-value="{{$user->id}}"
                                {{$user->approved_at?'checked':''}}>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p>No users registered currently!</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

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
                <div class="column"><strong>Name </strong></br></br>
                    <div class="ui grey small message" id="modal_name"></div>
                </div>
                <div class="column"><strong>Gender </strong></br></br>
                    <div class="ui grey small message" id="modal_gender"></div>
                </div>
                <div class="column"><strong>Birth Year </strong></br></br>
                    <div class="ui grey small message" id="modal_birth_year"></div>
                </div>
                <div class="column"><strong>Account created at </strong></br></br>
                    <div class="ui grey small message" id="modal_created_at"></div>
                </div>
                <div class="column"><strong>Information updated at </strong></br></br>
                    <div class="ui grey small message" id="modal_updated_at"></div>
                </div>
                <div class="column"><strong>Email </strong></br></br>
                    <div class="ui grey small message" id="modal_email"></div>
                </div>
                <div class="column"><strong>Email verified at</strong></br></br>
                    <div class="ui grey small message" id="modal_email_verified_at"></div>
                </div>
                <div class="column"><strong>Education </strong></br></br>
                    <div class="ui grey small message" id="modal_education"></div>
                </div>
                <div class="column"><strong>Mena Diaspora </strong></br></br>
                    <div class="ui grey small message" id="modal_mena_diaspora"></div>
                </div>
                <div class="column"><strong>Association </strong></br></br>
                    <div class="ui grey small message" id="modal_business_association_wom"></div>
                </div>
                <div class="column"><strong>Phone Number </strong></br></br>
                    <div class="ui grey small message" id="modal_phone"></div>
                </div>
                <div class="column"><strong>Subscribed to Newsletter? </strong></br></br>
                    <div class="ui grey small message" id="modal_newsletter"></div>
                </div>
            </div>
            <div class="ui stackable grid">
                <div class="column"><strong>Bio </strong></br></br>
                    <div class="ui grey small message" id="modal_bio"></div>
                </div>
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
    <form action="{{route('admin.impersonate.store')}}" id="user_impersonate_form" method="post">
        @csrf
        <input type="hidden" name="user_id" id="impersonation_id" value="">
    </form>
@endsection

@section('scripts')
    <script>
        $('.ui.checkbox').checkbox();
        $('.ui.small.modal').modal();

        function handleViewUser(e, id) {
            e.preventDefault();
            var token = '{{Session::token()}}';
            var url = '/admin/api/profile/' + id;
            var users_url = '/admin/users';
            $.ajax({
                method: "GET",
                url: url,
            }).done(function (msg) {
                if (msg['id'] === id) {
                    msg['created_at'] = new Date(msg['created_at']).toDateString();
                    msg['updated_at'] = new Date(msg['updated_at']).toDateString();
                    msg['email_verified_at'] = new Date(msg['email_verified_at']).toDateString();
                    msg['newsletter'] = ((msg['newsletter'] < 1) ? 'No' : 'Yes');
                    msg['mena_diaspora'] = ((msg['mena_diaspora'] < 1) ? 'No' : 'Yes');
                    msg['phone'] = ((msg['phone'] != null) ? ('+(' + msg['phone_country_code'] + ') ' + msg['phone']) : null);

                    function fill_modal(key, index) {
                        if (msg[key]) {
                            $('#modal_' + key).html(msg[key]);
                        } else {
                            $('#modal_' + key).html('None');
                        }
                        return true;
                    }

                    Object.keys(msg).map(fill_modal);
                    $('.ui.small.modal').modal('show');

                } else {
                    alert('User does not exist in the database');
                }
            });
        }

        function handleDeleteUser(e, id) {
            e.preventDefault();
            var url = '/admin/api/profile/' + id;
            $('#user_delete_form').attr('action', url).submit();
        }

        function handleImpersonateUser(e, id) {
            e.preventDefault();
            $('#impersonation_id').val(id);
            $('#user_impersonate_form').submit();
        }

        $('.verify.user.checkbox').change(function () {
            var url = '/admin/api/profile/' + $(this).attr('data-value');
            $('#user_verify_form').attr('action', url).submit();
        });
        $(function () {
            $('#filter_form').show();
            $('.tooltip').popup();
        });
    </script>
@endsection
