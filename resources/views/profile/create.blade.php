@extends('layouts.default')
@section('title','Signup')
@section('content')
<div class="ui centered container">
    <div class="ui padded basic segment" style="padding-right: 0;padding-left: 0;">
        <h1 class="ui blue header"> Signup to the portal</h1>
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
                    <div class="title">Business Activities</div>
                    <div class="description">Information about your business activity</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui centered container">
    <div class="ui hidden message" id="flash_message"></div>
    <div class="ui padded segment">
        <form action="{{route('profile.store')}}" class="ui form" method="POST" enctype="multipart/form-data"
            id="user_form">
            @csrf
            <div id="personal_info_form" style="">
                <h4 class="ui dividing header">Personal Information</h4>
                <div class="ui stackable grid">
                    <div class="four wide column">
                        <div class="ui center aligned basic segment field">
                            <h4 class="ui header">Profile Picture</h4>
                            <label for="avatar">
                                <a href="#" id="avatar_upload_icon">
                                    <i class="circular inverted grey user huge icon"></i>
                                </a>
                            </label>
                            <div class="image description"><small>Image size 300px x 300px</small></div>
                            <input type="file" name="user[image]" accept="image/*" style="display: none;"
                                id="avatar_upload_input" value="{{old('user.image')}}">
                        </div>
                    </div>
                    <div class="twelve wide column">
                        <div class="fields">
                            <div class="required field">
                                <label for="user[title]">Title</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="user[title]" value="{{old('user.title')}}">
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
                            <div class="fifteen wide required field">
                                <label for="user[name]">Full Name</label>
                                <input type="text" name="user[name]" placeholder="Full Name"
                                    value="{{old('user.name')}}" />
                            </div>
                        </div>
                        <div class="four fields">
                            <div class="required field">
                                <label for="user[email]">Email</label>
                                <input required type="text" name="user[email]"
                                    placeholder="Email e.g. example@example.com" value="{{old('user.email')}}">
                            </div>
                            <div class="required field">
                                <label for="user[email_confirmation]">Confirm Email</label>
                                <input required type="text" name="user[email_confirmation]"
                                    placeholder="Confirm your email address" value="{{old('user.email_confirmation')}}">
                            </div>
                            <div class="required field">
                                <label for="user[password]">Password</label>
                                <input required type="password" name="user[password]" placeholder="Your portal password"
                                    value="{{old('user.password')}}">
                            </div>
                            <div class="required field">
                                <label for="user[password_confirmation]">Confirm Password</label>
                                <input required type="password" name="user[password_confirmation]"
                                    placeholder="Confirm your password" value="{{old('user.password_confirmation')}}" />
                            </div>

                        </div>
                    </div>
                </div>

                <div class=" five fields">
                    <div class="seven wide field">
                        <label for="user[bio]">Profile</label>
                        <textarea rows="2" name="user[bio]"
                            placeholder="Max. 2500 charachters">{{old('user.bio')}}</textarea>
                    </div>
                    <div class="required field">
                        <label for="user[education]">Educational Level</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="user[education]" value="{{old('user.education')}}" />
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
                    <div class="required field">
                        <label for="user[gender]">Gender</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="user[gender]" value="{{old('user.gender')}}" />
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
                        <input type="text" name="user[birth_year]" placeholder="e.g. 1980" maxlength="4"
                            value="{{old('user.birth_year')}}" />
                    </div>

                </div>
                <h4 class="ui dividing header">Web Links</h4>
                <div class="four fields">
                    @forelse ($supported_links as $link)
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="text" placeholder="{{$link->name}} Link" data-type="{{$link->id}}"
                                name="links[{{$loop->index}}][url]" value="{{old('links.'.$loop->index.'.url')}}" />
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
                        countrycode=1 value="{!! old('user.phone_country_code') !!}" />

                    <div class="five wide required field">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="user[phone]" placeholder="e.g. 15444444499" maxlength="15"
                            value="{{old('user.phone')}}">
                    </div>
                </div>
                <div class="three fields">
                    <x-Countries label="Country" class="required" fieldname="user[country_id]"
                        value="{!! old('user.country_id') !!}" />
                    <div class="required field">
                        <label for="user[city_id]">City, State</label>
                        <div class="ui fluid search selection dropdown" id="city_id">
                            <input type="hidden" name="user[city_id]" value="{{old('user.city_id')}}">
                            <i class="dropdown icon"></i>
                            <div class="default text">City, State</div>
                            <div class="menu">
                                <p>Please select a country first ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="user[postal_code]">Postal Code</label>
                        <input type="text" name="user[postal_code]" placeholder="e.g. AX113Z" maxlength="15"
                            value="{{old('user.postal_code')}}">
                    </div>
                </div>
                <div class="ui basic segment">
                    <a href="#" class="ui blue right labeled right floated icon button" onclick="portal_step();">Next <i
                            class="right angle icon"></i></a>
                </div>
                <br>

            </div>


            <div id="portal_info_form" style="display:none;">

                <h4 class="ui dividing header">Which fields are you currently working in?</h4>
                <div class="three fields">
                    <x-Sectors class="required" label="Field 1" fieldname="sectors[][sector_id]"
                        default-text="Working Field 1" value="{!! old('sectors.0.sector_id') !!}" />
                    <x-Sectors label="Field 2" fieldname="sectors[][sector_id]" default-text="Working Field 2"
                        empty-option="Not Applicable" value="{!! old('sectors.1.sector_id') !!}" />
                    <x-Sectors label="Field 3" fieldname="sectors[][sector_id]" default-text="Working Field 3"
                        empty-option="Not Applicable" value="{!! old('sectors.2.sector_id') !!}" />
                </div>
                <h4 class="ui dividing header">Which business women association are you member of?</h4>
                <div class="field">
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" name="user[business_association_wom]"
                            value="{{old('user.business_association_wom')}}" />
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
                            <input type="checkbox" name="user[mena_diaspora]" tabindex="0" class="hidden"
                                {{old('user.mena_diaspora')?'checked':''}} value="1" />
                            <label>Are you from the MENA region but living abroad?</label>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    <div class="field">
                        <div class="ui toggle checkbox">
                            <input type="checkbox" name="user[newsletter]" tabindex="0" class="hidden"
                                {{old('user.newsletter')?'checked':''}} value="1" />
                            <label>Would you like to receive a newsletter from Women in Business about the
                                recent
                                updates to the platform and updates in the network?</label>
                        </div>
                    </div>
                    <div class="required field">
                        <div class="ui toggle checkbox">
                            <input type="checkbox" name="user[gdpr_consent]" tabindex="0" class="hidden"
                                {{old('user.gdpr_consent')?'checked':''}} value="1" />
                            <label>I consent that I have read WiB privacy policy and agree to the <a
                                    href="https://gpp-wib-staging.frb.io/data-privacy" target="_blank">privacy
                                    statement</a> and that I would like to share my data with GPP on this
                                portal</label>
                        </div>
                    </div>
                </div>
                <div class="ui basic segment">
                    <a href="#" class="ui blue left labeled left floated icon button" onclick="person_step();"><i
                            class="left angle icon"></i> Back</a>
                    <a class="ui positive right labeled right floated icon button" id="user_submit">Submit
                        <i class="checkmark icon"></i></a>
                </div>
                <br>

            </div>
        </form>
    </div>
</div>

<br><br>
@endsection



@section('scripts')
<script>
    let app_url = "{{url('/')}}";
    let profile_store_url = "{{route('profile.store')}}";
    let login_url = "{{route('login')}}";
    let app_token = "{{Session::token()}}";
    let city_id = "{{old('user.city_id')}}";
</script>
<script src="{{asset('js/profile.create.js')}}" type="application/javascript"></script>
@endsection