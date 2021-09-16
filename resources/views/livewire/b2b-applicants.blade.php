<div>
    <div id="showApplication" style="display: {{$isOpen ? 'block' : 'none'}};">
        @if($application)
            <div class="ui stackable grid">
                <div class="three wide column">
                    <img src="{{$application->user->image}}" alt="" class="ui circular image">
                </div>
                <div class="four wide column">
                    <strong>Name </strong>
                    <br>
                    <div class="ui grey small message">
                        <span class="ui black text"><a
                                href="{{$application->user->path}}">{{$application->user->name}}</a></span>
                    </div>
                    <br>
                    <strong>Company </strong>
                    <br>
                    <div class="ui grey small message">
                        <span class="ui black text">{{$application->entity->name}}</span>
                    </div>
                    <br>
                </div>
                <div class="five wide column">
                    <strong>Phone </strong>
                    <br>
                    <div class="ui grey small message">
                        <span
                            class="ui black text">+{{$application->user->phone_country_code}} {{$application->user->phone}}</span>
                    </div>
                    <br>
                    <strong>Email </strong>
                    <br>
                    <div class="ui grey small message">
                        <span class="ui black text"><a
                                href="mailto:{{$application->user->email}}">{{$application->user->email}}</a></span>
                    </div>
                    <br>
                </div>
                <div class="six wide column">
                    <strong>Profile </strong>
                    <br>
                    <div class="ui grey small message">
                        <span class="ui black text">{{$application->user->bio}}</span>
                    </div>
                    <br>
                    <strong>Company representative if the member is absent </strong>
                    <br>
                    <div class="ui grey small message">
                        <span
                            class="ui black text">{{data_get($application->data, 'representative') ?? 'Not provided'}}</span>
                    </div>
                    <br>
                </div>
                <div class="six wide column">
                    <strong>Motivation to join the B2B event </strong>
                    <br>
                    <div class="ui grey small message">
                        <span
                            class="ui black text">{{data_get($application->data, 'motivation') ?? 'Not provided'}}</span>
                    </div>
                    <br>
                    <strong>Breif presentation about the company</strong>
                    <br>
                    <div class="ui grey small message">
                        <span
                            class="ui black text">{{data_get($application->data, 'presentation') ?? 'Not provided'}}</span>
                    </div>
                    <br>
                </div>
            </div>
        @endif
        <div class="ui labeled icon blue basic button" wire:click="hideApplication()">
            <i class="left angle icon"></i>Back
        </div>
    </div>
    <div id="applicationsTable" style="display: {{$isOpen ? 'none' : 'block'}};">
        @if(session()->has('message'))
            <div class="ui success message">
                <div>{{session('message')}}</div>
            </div>
        @endif
        <table class="ui celled stackable table" aria-label="admin users table">
            <caption></caption>
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($applications as $application)
                <tr>
                    <td>
                        {{Str::of($application->user->name)->limit(50, $end='..')}}
                    </td>
                    <td>
                        <a href="mailto:{{$application->user->email}}">{{$application->user->email}}</a>
                    </td>
                    <td>
                        {{$application->entity->name}}
                    </td>
                    <td>
                        <select name="status" wire:model="status.{{$application->id}}"
                                wire:change="update({{$application->id}})" class="ui small dropdown">
                            @foreach(\App\Models\B2bApplication::STATUSES as $status)
                                <option
                                    value="{{$status}}" {{$application->status === data_get($status, $application->id) ? 'selected' : ''}}>
                                    {{Str::title($status)}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        {{$application->created_at->diffForHumans()}}
                    </td>
                    <td>
                        {{$application->updated_at->diffForHumans()}}
                    </td>
                    <td class="center aligned">
                        <a href="javascript:void(0)" wire:click="showApplication({{$application->id}})">
                            <i class="eye blue icon"></i>
                        </a>
                        <a href="javascript:void(0)" wire:click="destroy({{$application->id}})">
                            <i class="trash red icon"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $applications->links('vendor.pagination.semantic-ui-livewire') }}
    </div>
</div>