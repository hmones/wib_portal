<div id="adminCreate">
    <a wire:click="showForm()" class="ui blue basic button">
        <i class="plus icon"></i>Create New Admin
    </a>
    <div class="ui raised segment" id="adminCreateForm" style="display: {{$isOpen ? 'block;' : 'none;'}}">
        <form wire:submit.prevent="store" method="POST">
            <div class="ui basic segment" style="margin:0 !important;">
                <div class="ui form">
                    <p><strong>Profile Information</strong></p>
                    <div class="field">
                        <input type="text" wire:model.lazy="name" id="name" placeholder="Full name"/>
                        @error('name')
                        <div class="ui negative message">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="field">
                        <input type="text" wire:model.lazy="email" id="email" placeholder="Email"/>
                        @error('email')
                        <div class="ui negative message">{{$message}}</div>
                        @enderror
                    </div>
                    <p><strong>Password</strong></p>
                    <div class="two fields">
                        <div class="field">
                            <input type="password" wire:model.lazy="password" id="password"
                                   placeholder="Password minimum 8 charachters"/>
                            @error('password')
                            <div class="ui negative message">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="password" wire:model.lazy="confirmPassword" id="confirmPassword"
                                   placeholder="Password confirmation"/>
                            @error('confirmPassword')
                            <div class="ui negative message">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui padded basic segment" style="margin:0px; padding-top: 0px">
                <div class="ui right floated red button" wire:click="hideForm()">Close</div>
                <button class="ui right floated blue button" type="submit">Create</button>
                <br><br>
            </div>
        </form>
    </div>
    <br>
    @if($success)
        <div class="ui success message">
            <div>{{$success}}</div>
        </div>
    @endif
    <table class="ui celled stackable table" aria-label="admin users table">
        <caption></caption>
        <thead>
        <tr>
            <th class="four wide" id="name_column">Name</th>
            <th class="four wide" id="email_column">Email</th>
            <th class="two wide" id="created_column">Created</th>
            <th class="one wide" id="actions_column">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{Str::of($user->name)->limit(50, $end='..')}}
                </td>
                <td>
                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                </td>
                <td>
                    {{$user->created_at->diffForHumans()}}
                </td>
                <td class="center aligned">
                    <a href="javascript:void(0)" wire:click="destroy({{$user->id}})">
                        <i class="trash red icon"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
