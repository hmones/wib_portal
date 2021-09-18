@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Manage entities']]])

@section('content')
    <div class="ui centered container">
        <form action="{{route('admin.entities')}}" method="GET" class="ui form">
            @csrf
            <div class="sixteen fields">
                <div class="thirteen wide field">
                    <div class="ui icon input fluid field">
                        <input type="text" name="query" value="{{request()->has('query')?request()->input('query'):''}}" placeholder="Search ..."/>
                        <i class="search link icon"></i>
                    </div>
                </div>
                <div class="three wide field">
                    <a href="{{route('admin.entities', ['export' => 'xlsx'] + request()->input())}}"
                       class="ui fluid primary basic button">
                        <i class="download icon"></i> Download
                    </a>
                </div>
            </div>

        </form>
        @include('partials.filter_section', ['route' => route('admin.entities'), 'recent_online' => false])
        <table class="ui celled stackable table">
            <thead>
            <tr>
                <th class="four wide">Name</th>
                <th class="three wide">Email</th>
                <th class="one wide">Country</th>
                <th class="one wide">City</th>
                <th class="two wide">Created</th>
                <th class="one wide">Actions</th>
                <th class="one wide">Verify</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($entities as $entity)
                <tr>
                    <td>
                        <h4 class="ui image header">
                            @include('partials.components.avatar', ['type'=>'entity','entity'=>$entity])
                            <div class="content">
                                <a class="tooltip" href="{{$entity->path}}" data-content="{{$entity->name}}">
                                    {{Str::of($entity->name)->lower()->ucfirst()->limit(15,$end='..')}}
                                </a>
                                <br>
                                <div class="sub header">
                                    @if($entity->owned_by()->first())
                                        <a href="{{$entity->owned_by()->first()->path}}" class="tooltip"
                                           data-content="{{$entity->owned_by()->first()->name}}">
                                            {{Str::of($entity->owned_by()->first()->name)->lower()->ucfirst()->limit(15,$end='..')}}
                                        </a>
                                    @else
                                        No owner
                                    @endisset
                                </div>
                            </div>

                        </h4>
                    </td>
                    <td>
                        <a href="mailto:{{$entity->primary_email}}">{{$entity->primary_email}}</a>
                    </td>
                    <td>
                        {{$entity->primary_country()->exists() ? $entity->primary_country->name:'None'}}
                    </td>
                    <td>
                        {{$entity->primary_city()->exists() ? $entity->primary_city->name:'None'}}
                    </td>
                    <td>
                        {{$entity->created_at->diffForHumans()}}
                    </td>
                    <td class="center aligned">
                        <a href="#" onclick="handleViewEntity(event, {{$entity->id}});"><i
                                class="eye blue icon"></i></a>
                        <a href="#" onclick="handleDeleteEntity(event, {{$entity->id}});"><i
                                class="trash red icon"></i></a>
                    </td>
                    <td>
                        <div class="ui toggle checkbox">
                            <input class="verify entity checkbox" type="checkbox" data-value="{{$entity->id}}"
                                {{$entity->approved_at?'checked':''}}>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p>No entities registered currently!</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
    <br><br><br>
    <div class="ui centered grid">
        <div class="ui centered basic segment">
            {{ $entities->appends($_GET)->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
    <br><br>
    <div class="ui small modal">
        <div class="ui header">Entity Information</div>
        <div class="ui padded basic segment">
            <div class="entity information ui three column stackable grid">
                <div class="column"><strong>Name </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_name"></div>
                </div>
                <div class="column"><strong>Founding year </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_founding_year"></div>
                </div>
                <div class="column"><strong>Primary Address </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_primary_address"></div>
                </div>
                <div class="column"><strong>Entity created at </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_created_at"></div>
                </div>
                <div class="column"><strong>Information updated at </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_updated_at"></div>
                </div>
                <div class="column"><strong>Primary Email </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_primary_email"></div>
                </div>
                <div class="column"><strong>Secondary Email </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_secondary_email"></div>
                </div>
                <div class="column"><strong>Phone </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_phone"></div>
                </div>
                <div class="column"><strong>Entity size </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_entity_size"></div>
                </div>
                <div class="column"><strong>Business Type </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_business_type"></div>
                </div>
                <div class="column"><strong>Turn Over </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_turn_over"></div>
                </div>
                <div class="column"><strong>Balance Sheet </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_balance_sheet"></div>
                </div>
                <div class="column"><strong>Revenue </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_revenue"></div>
                </div>
                <div class="column"><strong>Members (for associations) </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_employees"></div>
                </div>
                <div class="column"><strong>Students </strong></br></br>
                    <div class="ui left-bordered basic segment" id="modal_students"></div>
                </div>
            </div>
        </div>
        <div class="ui actions">
            <div class="ui right floated red button" onclick="$('.ui.small.modal').modal('hide');">Close</div>
            <br><br>
        </div>
    </div>
    <form id="entity_delete_form" action="" method="POST">
        @csrf
        @method('DELETE')
    </form>
    <form id="entity_verify_form" action="" method="POST">
        @csrf
    </form>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#filter_form').show();
            $('.tooltip').popup();
        });
        $('.ui.checkbox').checkbox();
        $('.ui.small.modal').modal();

        function handleViewEntity(e, id) {
            e.preventDefault();
            var token = '{{Session::token()}}';
            var url = '/admin/api/entity/' + id;
            var users_url = '/admin/entities';
            $.ajax({
                method: "GET",
                url: url,
            }).done(function (msg) {
                if (msg['id'] === id) {
                    msg['created_at'] = new Date(msg['created_at']).toDateString();
                    msg['updated_at'] = new Date(msg['updated_at']).toDateString();
                    msg['phone'] = ((msg['phone'] != null) ? ('+(' + msg['phone_country_code'] + ') ' + msg['phone']) : null);
                    msg['name'] = msg['name'] + ((msg['name_additional'] != null) ? msg['name_additional'] : '');

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

        function handleDeleteEntity(e, id) {
            e.preventDefault();
            var url = '/admin/api/entity/' + id;
            $('#entity_delete_form').attr('action', url).submit();
        }

        $('.verify.entity.checkbox').change(function () {
            var url = '/admin/api/entity/' + $(this).attr('data-value');
            $('#entity_verify_form').attr('action', url).submit();
        });
    </script>
@endsection
