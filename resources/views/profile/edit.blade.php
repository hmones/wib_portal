@extends('layouts.default')
@section('title','Profile Settings')
@section('content')
<div class="ui centered container">
    <div class="ui padded basic segment" style="padding-right: 0;padding-left: 0;">
        <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Profile settings</h1>
        <br>
        <div class="ui fluid stackable steps">
            <div class="active step" id="personal_info">
                <i class="address card outline blue icon"></i>
                <div class="content">
                    <div class="title">Personal Information</div>
                    <div class="description">Information about you</div>
                </div>
            </div>
            <div class="step" id="portal_info">
                <i class="tasks blue icon"></i>
                <div class="content">
                    <div class="title">Account Settings</div>
                    <div class="description">Information about your account</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui centered container">
    <div class="ui hidden message" id="flash_message"></div>
    <div class="ui padded segment">
        <form action="{{route('profile.update',['profile'=>$user])}}" class="ui form" method="POST"
            enctype="multipart/form-data" id="user_form">
            @csrf
            @method('PUT')
            <div id="personal_info_form" style="">
                <h4 class="ui dividing header">Personal Information</h4>
                <div class="ui stackable grid">
                    <div class="four wide column">
                        <div class="ui center aligned basic segment field">
                            <h4 class="ui header">Profile Picture</h4>
                            <label for="avatar">
                                <a href="#" id="avatar_upload_icon">
                                    @if($user->avatar()->exists())
                                    <img class='ui circular centered small image'
                                        src='{{$user->avatar()->thumbnail()->url}}' alt="{{$user->name}}">
                                    @else
                                    <i class="circular inverted grey user huge icon"></i>
                                    @endif
                                </a>
                            </label>
                            <div class=""><small>Image size 300px x 300px</small></div>
                            <input type="file" name="avatar" style="display: none;" id="avatar_upload_input">
                            <input type="hidden"
                                value="{{$user->avatar()->exists()?$user->avatar()->thumbnail()->id:''}}"
                                name="avatar_id">
                        </div>
                    </div>
                    <div class="twelve wide column">
                        <div class="fields">
                            <div class="required field">
                                <label for="title">Title</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="title" value="{{$user->title}}">
                                    <div class="default text">Title</div>
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <div class="item" data-value="Mr.">
                                            Mr.
                                        </div>
                                        <div class="item" data-value="Ms.">
                                            Ms.
                                        </div>
                                        <div class="item" data-value="Ms.">
                                            Prof.
                                        </div>
                                        <div class="item" data-value="Ms.">
                                            Dr.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="required field">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" value="{{$user->name}}" placeholder="Full Name">
                            </div>
                            <div class="required field">
                                <label for="gender">Gender</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="gender" value="{{$user->gender}}">
                                    <div class="default text">Gender</div>
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <div class="item" data-value="Female">
                                            Female
                                        </div>
                                        <div class="item" data-value="Male">
                                            Male
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="required field">
                                <label for="birth_year">Birth Year</label>
                                <input type="text" name="birth_year" value="{{$user->birth_year}}"
                                    placeholder="e.g. 1980" maxlength="4">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="required four wide field">
                                <label for="education">Educational Level</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="education" value="{{$user->education}}">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Education</div>
                                    <div class="menu">
                                        @forelse ($education as $record)
                                        <div class="item" data-value="{{$record}}">{{$record}}</div>
                                        @empty
                                        <p>No Supported education fields currently ...</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="twelve wide field">
                                <label for="bio">Profile</label>
                                <textarea rows="2" name="bio"
                                    placeholder="Max. 2500 charachters">{{$user->bio}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="ui dividing header">Web Links</h4>
                <div class="four fields">
                    @forelse ($supported_links as $link)
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="text" placeholder="{{$link->name}} Link" data-type="{{$link->id}}"
                                name="link_{{$link->id}}"
                                value="{{isset($user->links()->where('type_id',$link->id)->first()->url)?$user->links()->where('type_id',$link->id)->first()->url:''}}">
                            <i class="{{ $link->icon }} icon"></i>
                        </div>
                    </div>
                    @empty
                    <p>No Supported links available ...</p>
                    @endforelse
                </div>
                <h4 class="ui dividing header">Contact Information</h4>
                <div class="fields">
                    <x-Countries label="Country Code" class="four wide required" fieldname="phone_country_code"
                        countrycode=1 :value="$user->phone_country_code" />
                    <div class="twelve wide required field">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" placeholder="e.g. 15444444499" maxlength="15"
                            value="{{$user->phone}}">
                    </div>
                </div>
                <div class="three fields">
                    <x-Countries label="Country" class="required" :value="$user->country_id" />
                    <div class="required field">
                        <label for="city_id">City, State</label>
                        <div class="ui fluid search selection dropdown" id="city_id">
                            <input type="hidden" name="city_id" value="{{$user->city_id}}">
                            <i class="dropdown icon"></i>
                            <div class="default text">City, State</div>
                            <div class="menu">
                                @foreach($user->country->cities()->get() as $city)
                                <div class="item" data-value="{{$city->id}}">{{$city->name}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="phone">Postal Code</label>
                        <input type="text" name="postal_code" placeholder="e.g. AX113Z" maxlength="15"
                            value="{{$user->postal_code}}">
                    </div>
                </div>
                <h4 class="ui dividing header">Which fields are you currently working in?</h4>
                <div class="three fields">
                    @for ($i = 1; $i < 4; $i++) <div class="{{$i==1?'required':''}} field">
                        <label for="sector_{{$i}}">Field {{$i}}</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="sector_{{$i}}"
                                value="{{isset($user->sectors[$i-1]->id) ? $user->sectors[$i-1]->id: ""}}">
                            <i class="dropdown icon"></i>
                            <div class="default text">Working field {{$i}}</div>
                            <div class="menu">
                                @if($i != 1)
                                <div class="item" data-value="">Not Applicable</div>
                                @endif
                                @forelse ($sectors as $sector)
                                <div class="item" data-value="{{$sector->id}}">{{$sector->name}}</div>
                                @empty
                                No Supported fields currently ...
                                @endforelse
                            </div>
                        </div>
                </div>
                @endfor
            </div>
            <div class="ui basic segment">
                <a class="ui positive right labeled right floated icon button"
                    onclick="$('#user_submit').trigger('click');">Save Changes <i class="checkmark icon"></i></a>
            </div>
            <br>

    </div>

    <div id="portal_info_form" style="display:none;">
        <h4 class="ui dividing header">Which business women association are you member of?</h4>
        <div class="field">
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="business_association_wom" value="{{$user->business_association_wom}}">
                <i class="dropdown icon"></i>
                <div class="default text">Business Woman Association</div>
                <div class="menu">
                    <div class="item" data-value="">None</div>
                    @forelse ($associations as $association)
                    <div class="item" data-value="{{$association}}">{{$association}}</div>
                    @empty
                    <p>No supported women associations currently ...</p>
                    @endforelse
                    <div class="item" data-value="Other">Other</div>
                </div>
            </div>
        </div>
        <div class="ui segment">
            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="mena_diaspora" tabindex="0" class="hidden"
                        {{$user->mena_diaspora?'checked':''}}>
                    <label>Are you from the MENA region but living abroad?</label>
                </div>
            </div>
        </div>
        <div class="ui segment">
            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="newsletter" tabindex="0" class="hidden"
                        {{$user->mena_diaspora?'checked':''}}>
                    <label>Would you like to receive a newsletter from Women in Business about the recent
                        updates to the platform and updates in the network?</label>
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Account details</h4>
        <div class="fields">
            <div class="field">
                <label for="email">Account email</label>
                <input disabled type="text" name="email" value="{{$user->email}}">
            </div>
            <div class="field">
                <label for="">Change your email</label>
                <button class="ui button" disabled>Enter a new email</button>
            </div>
        </div>
        <div class="fields">
            <div class="field">
                <label>Forgot your password?</label>
                <a href="{{route('password.request')}}" class="ui basic blue button">Reset Password</a>
            </div>
            <div class="field">
                <label>This action is not reversable</label>
                <a onclick="$('.ui.modal').modal({inverted: true}).modal('show');" class="ui basic red button">Delete
                    Account</a>
            </div>
        </div>
        <div class="ui basic segment">
            <a class="ui positive right labeled right floated icon button" id="user_submit">Save Changes <i
                    class="checkmark icon"></i></a>
        </div>
        <br>

    </div>
    </form>
</div>
</div>
<br><br>
<div class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        Are you sure you want to delete your account?
    </div>
    <div class="content">
        <div class="description">
            This will delete all your account information from our database (this action is none reversable)
        </div>
    </div>
    <div class="actions">
        <form action="{{route('profile.destroy',['profile'=>Auth::user()])}}" method="POST">
            @csrf
            @method('DELETE')
            <a class="ui blue button" onclick="$('.ui.modal').modal('hide');">No</a>
            <button class="ui red submit button" type="submit">I'm sure</button>
        </form>
    </div>
</div>
@endsection



@section('scripts')
<script type="application/javascript">
    let app_url = "{{url('/')}}";
        let profile_store_url = "{{route('profile.update',['profile'=>$user])}}";
        let profile_picture_store_url = "{{route('profilepicture.store')}}";
        let login_url = "{{route('profile.edit',['profile'=>$user])}}";
        let app_token = "{{Session::token()}}";
</script>
<script src="{{asset('js/profile.create.js')}}" type="application/javascript"></script>
@endsection