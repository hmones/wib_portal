@extends('layouts.default')
@section('title','Profile Settings')
@section('content')
<div class="ui centered container">
    <div class="ui padded basic segment" style="padding: 0px;">
        <div class="ui right floated center aligned basic segment" style="width: 25%;margin-top:-7px;">
            <span style="position: absolute;font-size: .9375em;font-weight: 700;left: -122px;">Profile Completion</span>
            <div class="ui active blue progress" data-percent="{{$user->data_percent}}">
                <div class="bar">
                    <div class="progress"></div>
                </div>
            </div>
        </div>
        <h1 class="ui blue header"><i class="stop wib bullet icon"></i>My Account</h1>
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
    <div class="ui padded basic segment">
        <form action="{{$user->path}}" class="ui form" method="POST" enctype="multipart/form-data" id="user_form">
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
                                    @if($user->image)
                                    <img class='ui circular centered small image' style='height:150px;'
                                        src='{{$user->image}}' />
                                    @else
                                    <i class="circular inverted grey user huge icon"></i>
                                    @endif
                                </a>
                            </label>
                            <div class="image description"><small>Image size 300px x 300px</small></div>
                            <input type="file" name="user[image]" accept="image/*" style="display: none;"
                                id="avatar_upload_input">
                        </div>
                    </div>
                    <div class="twelve wide column">
                        <div class="fields">
                            <div class="required field">
                                <label for="user[title]">Title</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="user[title]" value="{{$user->title}}">
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
                                <label for="user[name]">Full Name</label>
                                <input type="text" name="user[name]" value="{{$user->name}}" placeholder="Full Name">
                            </div>
                            <div class="required field">
                                <label for="user[gender]">Gender</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="user[gender]" value="{{$user->gender}}">
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
                                <label for="user[birth_year]">Birth Year</label>
                                <input type="text" name="user[birth_year]" value="{{$user->birth_year}}"
                                    placeholder="e.g. 1980" maxlength="4">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="required four wide field">
                                <label for="user[education]">Educational Level</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="user[education]" value="{{$user->education}}">
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
                                <label for="user[bio]">Profile</label>
                                <textarea rows="2" name="user[bio]"
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
                                name="links[{{$loop->index}}][url]"
                                value="{{isset($user->links()->where('type_id',$link->id)->first()->url)?$user->links()->where('type_id',$link->id)->first()->url:''}}" />
                            <input type="hidden" name="links[{{$loop->index}}][type_id]" value="{{$link->id}}">
                            <i class="{{ $link->icon }} icon"></i>
                        </div>
                    </div>
                    @empty
                    <p>No Supported links available ...</p>
                    @endforelse
                </div>
                <h4 class="ui dividing header">Contact Information</h4>
                <div class="fields">
                    <x-Countries label="Country Code" class="four wide required" fieldname="user[phone_country_code]"
                        countrycode=1 :value="$user->phone_country_code" />
                    <div class="twelve wide required field">
                        <label for="user[phone]">Phone Number</label>
                        <input type="text" name="user[phone]" placeholder="e.g. 15444444499" maxlength="15"
                            value="{{$user->phone}}">
                    </div>
                </div>
                <div class="three fields">
                    <x-Countries label="Country" class="required" :value="$user->country_id"
                        fieldname="user[country_id]" />
                    <div class="required field">
                        <label for="user[city_id]">City, State</label>
                        <div class="ui fluid search selection dropdown" id="city_id">
                            <input type="hidden" name="user[city_id]" value="{{$user->city_id}}">
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
                        <label for="user[postal_code]">Postal Code</label>
                        <input type="text" name="user[postal_code]" placeholder="e.g. AX113Z" maxlength="15"
                            value="{{$user->postal_code}}">
                    </div>
                </div>
                <h4 class="ui dividing header">Which fields are you currently working in?</h4>
                <div class="three fields">
                    <x-Sectors class="required" fieldname="sectors[][sector_id]" label="Field 1"
                        value="{!!isset($user->sectors[0]->id)?$user->sectors[0]->id:''!!}"
                        default-text="Working Field 1" />
                    <x-Sectors fieldname="sectors[][sector_id]" label="Field 2"
                        value="{!!isset($user->sectors[1]->id)?$user->sectors[1]->id:''!!}"
                        default-text="Working Field 2" empty-option="Not applicable" />
                    <x-Sectors fieldname="sectors[][sector_id]" label="Field 3"
                        value="{!!isset($user->sectors[2]->id)?$user->sectors[2]->id:''!!}"
                        default-text="Working Field 3" empty-option="Not applicable" />
                </div>
                <div class="ui hidden divider"></div>
                <a class="ui positive right labeled icon button" onclick="$('#user_submit').trigger('click');">
                    Save Changes
                    <i class="checkmark icon"></i>
                </a>

                <br />

            </div>

            <div id="portal_info_form" style="display:none;">
                <h4 class="ui dividing header"> Which business women association are you member of?</h4>
                <div class="field">
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" name="user[business_association_wom]"
                            value="{{$user->business_association_wom}}" />
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
                <div class="ui basic segment">
                    <div class="field">
                        <div class="ui toggle checkbox">
                            <input type="checkbox" name="user[mena_diaspora]" tabindex="0" class="hidden"
                                {{$user->mena_diaspora?'checked':''}} value=1 />
                            <label>Are you from the MENA region but living abroad?</label>
                        </div>
                    </div>
                </div>
                <div class="ui basic segment">
                    <div class="field">
                        <div class="ui toggle checkbox">
                            <input type="checkbox" name="user[newsletter]" tabindex="0" class="hidden"
                                {{$user->mena_diaspora?'checked':''}} value=1 />
                            <label>Would you like to receive a newsletter from Women in Business about the recent
                                updates to the platform and updates in the network?</label>
                        </div>
                    </div>
                </div>
                <h4 class="ui dividing header">Email Notifications</h4>
                <div class="four fields">
                    <div class="field">
                        <label for="user[notify_comment]">Comments on my posts</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="user[notify_comment]" value="{{$user->notify_comment}}" />
                            <i class="dropdown icon"></i>
                            <div class="default text">Get notified?</div>
                            <div class="menu">
                                <div class="item" data-value="1"><i class="check green icon"></i> Yes</div>
                                <div class="item" data-value="0"><i class="close red icon"></i>No</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="user[notify_message]">New message</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="user[notify_message]" value="{{$user->notify_message}}" />
                            <i class="dropdown icon"></i>
                            <div class="default text">Get notified?</div>
                            <div class="menu">
                                <div class="item" data-value="1"><i class="check green icon"></i> Yes</div>
                                <div class="item" data-value="0"><i class="close red icon"></i>No</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="user[notify_post]">New post in my field</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="user[notify_post]" value="{{$user->notify_post}}" />
                            <i class="dropdown icon"></i>
                            <div class="default text">Get notified?</div>
                            <div class="menu">
                                <div class="item" data-value="1"><i class="check green icon"></i> Yes</div>
                                <div class="item" data-value="0"><i class="close red icon"></i>No</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="user[notify_user]">New user in my field</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="user[notify_user]" value="{{$user->notify_user}}" />
                            <i class="dropdown icon"></i>
                            <div class="default text">Get notified?</div>
                            <div class="menu">
                                <div class="item" data-value="1"><i class="check green icon"></i> Yes</div>
                                <div class="item" data-value="0"><i class="close red icon"></i>No</div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="ui dividing header">Account details</h4>
                <div class="fields">
                    <div class="field">
                        <label for="user[email]">Account email</label>
                        <input disabled type="text" name="user[email]" value="{{$user->email}}">
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
                        <a onclick="$('.ui.modal').modal({inverted: true}).modal('show');"
                            class="ui basic red button">Delete
                            Account</a>
                    </div>
                </div>
                <div class="ui hidden divider"></div>
                <a class="ui positive right labeled icon button" id="user_submit">Save Changes <i
                        class="checkmark icon"></i></a>
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
        <form action="{{Auth::user()->path}}" method="POST">
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
    let profile_store_url = "{{$user->path}}";
    let profile_picture_store_url = "{{route('profilepicture.store')}}";
    let login_url = "{{$user->path . '/edit'}}";
    let app_token = "{{Session::token()}}";
    let city_id = "{{$user->city_id}}"
    $(function(){$('.ui.progress').progress();});
</script>
<script src="{{asset('js/profile.create.js')}}" type="application/javascript"></script>
@endsection