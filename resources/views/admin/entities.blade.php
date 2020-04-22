@extends('layouts.auth')

@section('content')
    <style>
        .ui.grey.label{
            color: black !important;
        }
    </style>
    <br><br>
    <div class="ui centered container">
        <h3 class="ui blue header"> <i class="stop wib bullet icon"></i> Registered Entities</h3>
        <div class="ui basic segment">
            <table class="ui celled stackable table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Created</th>
                    <th>Actions</th>
                    <th>Verify</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($entities as $entity)
                    <tr>
                        <td>
                            <h4 class="ui image header">
                                @if($entity->logo()->exists())
                                    <img src="{{$entity->logo()->thumbnail()->url}}" class="ui circular image" alt="{{$entity->name}}'s avatar">
                                @else
                                    <i class="circular inverted grey image small icon"></i>
                                @endif
                                <div class="content">
                                    {{\Illuminate\Support\Str::limit($entity->name, 27,$end='..')}}
                                    <br>
                                    <div class="sub header">
                                        @if($entity->owned_by()->first())
                                            {{\Illuminate\Support\Str::limit($entity->owned_by()->first()->name, 27,$end='..')}}
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
                            <a href="#" onclick="handleViewEntity(event, {{$entity->id}});"><i class="eye blue icon"></i></a>
                            <a href="#" onclick="handleDeleteEntity(event, {{$entity->id}});"><i class="trash red icon"></i></a>
                        </td>
                        <td>
                            <div class="ui toggle checkbox">
                                <input class="verify entity checkbox" type="checkbox" data-value="{{$entity->id}}" {{$entity->approved_at?'checked':''}}>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"><p>No entities registered currently!</p></td>
                    </tr>
                @endforelse
                    </tbody>
                    </table>
    </div>
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
        $('.ui.checkbox').checkbox();
        $('.ui.small.modal').modal();
        function handleViewEntity(e, id){
            e.preventDefault();
            var token = '{{Session::token()}}';
            var url = '/admin/api/entity/'+id;
            var users_url = '/admin/entities';
            $.ajax({
                method: "GET",
                url: url,
            }).done(function (msg) {
                if (msg['id'] === id) {
                    var html = '<div class="column"><strong>Name </strong></br></br><div class="ui grey large label">'+msg['name']+', '+msg['additional_name']+'</div></div><div class="column"><strong>Founding year </strong></br></br><div class="ui grey large label">'+msg['founding_year']+'</div></div><div class="column"><strong>Primary Address </strong></br></br><div class="ui grey large label">'+msg['primary_address']+'</div></div><div class="column"><strong>Entity created at </strong></br></br><div class="ui grey large label">'+msg['created_at']+'</div></div><div class="column"><strong>Information updated at </strong></br></br><div class="ui grey large label">'+msg['updated_at']+'</div></div>'+'<div class="column"><strong>Primary Email </strong></br></br><div class="ui grey large label">'+msg['primary_email']+'</div></div><div class="column"><strong>Secondary Email </strong></br></br><div class="ui grey large label">'+msg['secondary_email']+'</div></div><div class="column"><strong>Phone </strong></br></br><div class="ui grey large label">+'+msg['phone_country_code']+msg['phone']+'</div></div><div class="column"><strong>Entity size </strong></br></br><div class="ui grey large label">'+msg['entity_size']+'</div></div><div class="column"><strong>Business Type </strong></br></br><div class="ui grey large label">'+msg['business_type']+'</div></div><div class="column"><strong>Turn Over </strong></br></br><div class="ui grey large label">+'+msg['turn_over']+msg['phone']+'</div></div><div class="column"><strong>Balance Sheet </strong></br></br><div class="ui grey large label">'+msg['balance_sheet']+'</div></div><div class="column"><strong>Revenue </strong></br></br><div class="ui grey large label">'+msg['revenue']+'</div></div><div class="column"><strong>Members (for associations) </strong></br></br><div class="ui grey large label">'+msg['employees']+'</div></div><div class="column"><strong>Students </strong></br></br><div class="ui grey large label">'+msg['students']+'</div></div>';
                    $('.entity.information').html(html);
                    $('.ui.small.modal').modal('show');

                } else {
                    alert('User does not exist in the database');
                }
            });
        }
        function handleDeleteEntity(e, id){
            e.preventDefault();
            var url = '/admin/api/entity/'+id;
            $('#entity_delete_form').attr('action',url).submit();
        }
        $('.verify.entity.checkbox').change(function () {
            var url = '/admin/api/entity/'+$(this).attr('data-value');
            $('#entity_verify_form').attr('action',url).submit();
        });
    </script>
@endsection
