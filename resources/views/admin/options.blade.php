@extends('layouts.auth', ['breadcrumbItems' => [['name' => 'Edit options']]])

@section('content')
    <div class="ui centered container">
        <table class="ui celled stackable table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Icon</th>
                <th class="center aligned">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($entityTypes as $entityType)
                <tr id="entity_type_{{$entityType->id}}">
                    <td>
                        {{$entityType->name}}
                        <input type="hidden" name="entityType_{{$entityType->id}}_name"
                               value="{{$entityType->name}}">
                    </td>
                    <td>
                        <i class="{{$entityType->icon}} icon"></i> ({{$entityType->icon}})
                        <input type="hidden" name="entityType_{{$entityType->id}}_icon"
                               value="{{$entityType->icon}}">
                    </td>
                    <td class="center aligned">
                        <button class="ui blue basic button"
                                onclick="handleUpdateEntityType('{{$entityType->id}}');">
                            <i class="pencil icon"></i>Edit
                        </button>
                        <button class="ui red basic button"
                                onclick="handleDeleteEntityType('{{$entityType->id}}');">
                            <i class="trash icon"></i>Remove
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p>No Entity types registered currently!</p>
                    </td>
                </tr>
            @endforelse
            <tr class="ui inverted grey table form">
                <td>
                    <input type="text" style="border-color:#d5d4d1;" name="entityType_name" id=""
                           placeholder="Name of entity type">
                </td>
                <td class="ui field">
                    @include('partials.iconsDropdown', ['iconFieldName'=>'entityType_icon'])
                </td>
                <td>
                    <button class="ui blue basic fluid button" onclick="handleAddEntityType();"><i
                            class="plus icon"></i>Create new
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <form id="entityType_delete_form" action="" method="POST">
            @method('DELETE')
            @csrf
        </form>
        <div class="ui small modal entityType">
            <div class="header">Edit Entity Type</div>
            <div class="content">
                <form id="entityType_update_form" action="" method="POST" class="ui form">
                    @csrf
                    @method('PUT')
                    <div class="two fields">
                        <div class="field">
                            <input type="text" name="entityType_update_name">
                        </div>
                        <div class="field">
                            @include('partials.iconsDropdown', ['iconFieldName'=>'entityType_update_icon'])
                        </div>
                    </div>
                    <button type="submit" class="ui blue button">Update</button>
                    <a class="ui red button" onclick="$('.ui.small.modal').modal('hide');">Cancel</a>
                </form>
            </div>
        </div>

        <form id="entityType_create_form" action="{{route('admin.entityType.store')}}" method="POST">
            @csrf
            <input type="hidden" name="entityType_create_name">
            <input type="hidden" name="entityType_create_icon">
        </form>
    </div>

    <br><br>
    <div class="ui centered container">
        <h2 class="ui blue header">Registered sectors</h2>
        <br>
        <table class="ui celled stackable table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Icon</th>
                <th class="center aligned">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($sectors as $sector)
                <tr>
                    <td>
                        {{$sector->name}}
                        <input type="hidden" name="sector_{{$sector->id}}_name" value="{{$sector->name}}">
                    </td>
                    <td>
                        <i class="{{$sector->icon}} icon"></i> ({{$sector->icon}})
                        <input type="hidden" name="sector_{{$sector->id}}_icon" value="{{$sector->icon}}">
                    </td>
                    <td class="center aligned">
                        <button class="ui blue basic button" onclick="handleUpdateSector('{{$sector->id}}');"><i
                                class="pencil icon"></i>Edit
                        </button>
                        <button class="ui red basic button" onclick="handleDeleteSector('{{$sector->id}}');"><i
                                class="trash icon"></i>Remove
                        </button>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p>No sectors registered already!</p>
                    </td>
                </tr>
            @endforelse
            <tr class="ui inverted grey table form">
                <td>
                    <input type="text" name="sector_name" id="" placeholder="Name of the sector"
                           style="border-color:#d5d4d1;">
                </td>
                <td class="ui field">
                    @include('partials.iconsDropdown', ['iconFieldName'=>'sector_icon'])
                </td>
                <td>
                    <button class="ui blue basic fluid button" onclick="handleAddSector();"><i
                            class="plus icon"></i>Create new
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <form id="sector_delete_form" action="" method="POST">
            @method('DELETE')
            @csrf
        </form>
        <div class="ui small modal sector">
            <div class="header">Edit Sector</div>
            <div class="content">
                <form id="sector_update_form" action="" method="POST" class="ui form">
                    @csrf
                    @method('PUT')
                    <div class="two fields">
                        <div class="field">
                            <label>
                                <input type="text" name="sector_update_name">
                            </label>
                        </div>
                        <div class="field">
                            @include('partials.iconsDropdown', ['iconFieldName'=>'sector_update_icon'])
                        </div>
                    </div>
                    <button type="submit" class="ui blue button">Update</button>
                    <a class="ui red button" onclick="$('.ui.small.modal.sector').modal('hide');">Cancel</a>
                </form>
            </div>
        </div>

        <form id="sector_create_form" action="{{route('admin.sector.store')}}" method="POST">
            @csrf
            <input type="hidden" name="sector_create_name">
            <input type="hidden" name="sector_create_icon">
        </form>
    </div>
    <br><br>
@endsection

@section('scripts')
    <script>
        function handleAddEntityType() {
            var name = $('input[name="entityType_name"]').val();
            var icon = $('input[name="entityType_icon"]').val();
            $('input[name="entityType_create_name"]').val(name);
            $('input[name="entityType_create_icon"]').val(icon);
            $('#entityType_create_form').submit();
        }

        function handleUpdateEntityType(entity_type_id) {
            var icon = $('input[name="entityType_' + entity_type_id + '_icon"]').val();
            var name = $('input[name="entityType_' + entity_type_id + '_name"]').val();
            $('input[name="entityType_update_name"]').val(name);
            $('.ui.dropdown.entityType_update_icon').dropdown('set selected', icon);
            $('#entityType_update_form').attr('action', '/admin/entityType/' + entity_type_id);
            $('.ui.small.modal.entityType').modal('show');
        }

        function handleDeleteEntityType(entity_type_id) {
            $('#entityType_delete_form').attr('action', '/admin/entityType/' + entity_type_id).submit();
        }

        function handleAddSector() {
            var name = $('input[name="sector_name"]').val();
            var icon = $('input[name="sector_icon"]').val();
            $('input[name="sector_create_name"]').val(name);
            $('input[name="sector_create_icon"]').val(icon);
            $('#sector_create_form').submit();
        }

        function handleUpdateSector(sector_id) {
            var icon = $('input[name="sector_' + sector_id + '_icon"]').val();
            var name = $('input[name="sector_' + sector_id + '_name"]').val();
            $('input[name="sector_update_name"]').val(name);
            $('.ui.dropdown.sector_update_icon').dropdown('set selected', icon);
            $('#sector_update_form').attr('action', '/admin/sector/' + sector_id);
            $('.ui.small.modal.sector').modal('show');
        }

        function handleDeleteSector(sector_id) {
            $('#sector_delete_form').attr('action', '/admin/sector/' + sector_id).submit();
        }
    </script>
@endsection
