<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Women in Business Portal | Users Listing</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('dist/semantic.min.css')}}" rel="stylesheet" type="text/css">
        <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        <script type="application/javascript" src="{{asset('dist/semantic.min.js')}}"></script>
    </head>
    <body>
        <div class="ui grid">
            <div class="ui container">
                <br><br>
                <img class="ui centered center aligned image" src="{{asset('images/logo.png')}}" alt="">
            </div>
        </div>
        <br>
        <div class="ui centered container">
            <div class="ui centered center aligned padded basic segment">
                <h1 class="ui centered header">Registration form for Women in Business</h1>
                <br>
                <div class="ui fluid stackable steps">
                    <div class="active step" id="personal_info">
                        <i class="ui info circle icon"></i>
                        <div class="content">
                            <div class="title">Personal Information</div>
                            <div class="description">Information about you</div>
                        </div>
                    </div>
                    <div class="step" id="organization_info">
                        <i class="dollar icon"></i>
                        <div class="content">
                            <div class="title">Organization Information</div>
                            <div class="description">Information about your organization</div>
                        </div>
                    </div>
                    <div class="step" id="portal_info">
                        <i class="info circle icon"></i>
                        <div class="content">
                            <div class="title">Portal Settings</div>
                            <div class="description">Settings for your profile on the portal</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui centered container">
            <div class="ui hidden message" id="flash_message"></div>
            <div class="ui padded segment" >
            <form action="/profile" class="ui form" method="post" enctype="multipart/form-data">
                @csrf
                <div id="personal_info_form" style="">
                    <h4 class="ui dividing header">Personal Information</h4>
                    <div class="ui stackable grid">
                        <div class="four wide column">
                            <div class="ui center aligned basic segment field">
                                <h4 class="ui header">Profile Picture</h4>
                                <label for="avatar"><a href="#"><i class="circular inverted grey image huge icon" id="avatar_upload_icon"></i></a></label>
                                <input type="file" name="avatar" style="display: none;" id="avatar_upload_input">
                                <input type="hidden" value="" name="avatar_url">
                            </div>
                        </div>
                        <div class="twelve wide column">
                            <div class="fields">
                                <div class="required field">
                                    <label for="title">Title</label>
                                    <div class="ui selection dropdown">
                                        <input type="hidden" name="title">
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
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="fields">
                                <div class="five wide required field">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" placeholder="Email e.g. example@example.com">
                                </div>
                                <div class="five wide required field">
                                    <label for="email_confirm">Confirm Email</label>
                                    <input type="text" name="email_confirm" placeholder="Confirm your email address">
                                </div>
                                <div class="required field">
                                    <label for="gender">Gender</label>
                                    <div class="ui selection dropdown">
                                        <input type="hidden" name="gender">
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
                                    <input type="text" name="birth_year" placeholder="e.g. 1980" maxlength="4">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="bio">About you</label>
                        <textarea rows="2" name="bio"></textarea>
                    </div>
                    <h4 class="ui dividing header">Web Links</h4>
                    <div class="four fields">
                        @forelse ($supported_links as $link)
                            <div class="field">
                                <div class="ui left icon input">
                                    <input type="text" placeholder="{{$link->name}} Link" data-type="{{$link->id}}" name="link_{{$link->id}}">
                                    <i class="{{ $link->icon }} icon"></i>
                                </div>
                            </div>
                        @empty
                            <p>No Supported links available ...</p>
                        @endforelse
                    </div>
                    <h4 class="ui dividing header">Contact Information</h4>
                    <div class="fields">
                        <div class="four wide required field">
                            <label for="phone_country_code">Country Code</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="phone_country_code">
                                <i class="dropdown icon"></i>
                                <div class="default text">Select Country</div>
                                <div class="menu">
                                    @forelse ($countries as $country)
                                        <div class="item" data-value="{{$country->code}}"><i class="{{$country->code}} flag"></i>{{$country->name}} (+{{$country->calling_code}})</div>
                                    @empty
                                        <p>No Supported phones currently ...</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                        <div class="five wide required field">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" placeholder="e.g. 15444444499" maxlength="15">
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="required field">
                            <label for="country_id">Country</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="country_id">
                                <i class="dropdown icon"></i>
                                <div class="default text">Country</div>
                                <div class="menu">
                                    @forelse ($countries as $country)
                                        <div class="item" data-value="{{$country->id}}">{{$country->name}}</div>
                                    @empty
                                        <p>No Supported countries currently ...</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="required field">
                            <label for="city_id">City, State</label>
                            <div class="ui fluid search selection dropdown" id="city_id">
                                <input type="hidden" name="city_id">
                                <i class="dropdown icon"></i>
                                <div class="default text">City, State</div>
                                <div class="menu">
                                    <p>Please select a country first ...</p>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label for="phone">Postal Code</label>
                            <input type="text" name="postal_code" placeholder="e.g. AX113Z" maxlength="15">
                        </div>
                    </div>
                    <a href="#" class="ui teal button" onclick="entity_step();">Next <i class="right angle icon"></i></a>
                </div>

                <div id="organization_info_form" style="display: none;">
                    <h4 class="ui dividing header">Which organizations are you affiliated to? </h4>
                    <p>You can choose up to 3 organizations, if the organization is not registered with us, please click below to register a new organization </p>
                    <a href="#" class="ui button" onclick="register_open();">Register a new organization</a>
                    <br><br><br>
                    @for($i=1;$i<4;$i++)
                        <div class="two fields">
                            <div class="field">
                                <label for="entity_{{$i}}">Organization {{$i}}</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="entity_{{$i}}">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Search for a registered organization</div>
                                    <div class="menu">
                                        @foreach ($entities as $entity)
                                            <div class="item" data-value="{{$entity->id}}">{{$entity->name}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="relation_{{$i}}">Affiliation to this organization</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="relation_{{$i}}">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">What is your relation to the organization?</div>
                                    <div class="menu">
                                        @foreach ($relations as $relation)
                                            <div class="item" data-value="{{$relation}}">{{$relation}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <a href="#" class="ui teal button" onclick="person_step();"><i class="left angle icon"></i> Back </a>
                    <a href="#" class="ui teal button" onclick="portal_step();">Next <i class="right angle icon"></i></a>
                </div>

                <div id="portal_info_form" style="display:none;">
                    <div class="required field">
                        <label for="education">Educational Level</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="education">
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
                    <h4 class="ui dividing header">Work Related Information</h4>
                    <div class="two fields">
                        <div class="required field">
                            <label for="activity">Your business activity</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="activity">
                                <i class="dropdown icon"></i>
                                <div class="default text">Business activity</div>
                                <div class="menu">
                                    @forelse ($activities as $activity)
                                        <div class="item" data-value="{{$activity}}">{{$activity}}</div>
                                    @empty
                                        <p>No Supported activity fields currently ...</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="required field">
                            <label for="sphere">Your main business sphere</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="sphere">
                                <i class="dropdown icon"></i>
                                <div class="default text">Business sphere</div>
                                <div class="menu">
                                    @forelse ($spheres as $sphere)
                                        <div class="item" data-value="{{$sphere}}">{{$sphere}}</div>
                                    @empty
                                        <p>No supported spheres currently ...</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="ui dividing header">Which sectors are you mostly affiliated with?</h4>
                    <div class="three fields">
                        @for ($i = 1; $i < 4; $i++)
                        <div class="field">
                            <label for="sector_{{$i}}">Business sector {{$i}}</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="sector_{{$i}}" >
                                <i class="dropdown icon"></i>
                                <div class="default text">Business sector {{$i}}</div>
                                <div class="menu">
                                    @forelse ($sectors as $sector)
                                        <div class="item" data-value="{{$sector->id}}">{{$sector->name}}</div>
                                    @empty
                                        No Supported sector fields currently ...
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="field">
                        <label for="business_association_wom">Business Woman Association</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="business_association_wom">
                            <i class="dropdown icon"></i>
                            <div class="default text">Business Woman Association</div>
                            <div class="menu">
                                @forelse ($associations as $association)
                                    <div class="item" data-value="{{$association}}">{{$association}}</div>
                                @empty
                                    <p>No supported women associations currently ...</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="ui segment">
                        <div class="field">
                            <div class="ui toggle checkbox">
                                <input type="checkbox" name="mena_diaspora" tabindex="0" class="hidden">
                                <label>Are you from the MENA region but living abroad?</label>
                            </div>
                        </div>
                    </div>
                    <div class="ui segment">
                        <div class="field">
                            <div class="ui toggle checkbox">
                                <input type="checkbox" name="" tabindex="0" class="hidden">
                                <label>Would you like to receive a newsletter from Women in Business about the recent updates to the platform and updates in the network?</label>
                            </div>
                        </div>
                        <div class="required field">
                            <div class="ui toggle checkbox">
                                <input type="checkbox" name="" tabindex="0" class="hidden">
                                <label>I consent that I have read WiB privacy policy and agree to the <a href="#">privacy statement</a>  and that I would like to share my data with GPP on this portal</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <a href="#" class="ui teal button" onclick="entity_step();"><i class="left angle icon"></i> Back</a>
                    <button type="submit" class="ui teal button">Submit</button>
                </div>
            </form>
            </div>
        </div>
        <div class="ui modal">
                <i class="close icon"></i>
                <div class="header">
                    Register a new organization
                </div>
                <div class="ui form padded basic segment">
                    <form id="entity_form" action="/entity" method="post" enctype="multipart/form-data">
                        <div class="ui stackable grid">
                            <div class="five wide column">
                                <div class="ui medium image">
                                    <div class="ui center aligned basic segment field">
                                        <h4 class="ui header">Organization logo</h4>
                                        <label for="logo"><a href="#"><i class="circular inverted grey image huge icon" id="logo_upload_icon"></i></a></label>
                                        <input type="file" name="logo" style="display: none;" id="logo_upload_input">
                                        <input type="hidden" value="" name="logo_url">
                                    </div>
                                </div>
                            </div>
                            <div class="eleven wide column ui form">
                                <div class="two fields">
                                    <div class="required field">
                                        <label for="entity_type_id">Type of Organization</label>
                                        <div class="ui fluid search selection dropdown">
                                            <input type="hidden" name="entity_type_id">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">Type of organizaiton</div>
                                            <div class="menu">
                                                @foreach ($entity_types as $entity_type)
                                                    <div class="item" data-value="{{$entity_type->id}}">{{$entity_type->name}}</div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="founding_year">Founding Year</label>
                                        <input type="text" name="founding_year" placeholder="e.g. 1980" maxlength="4">
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="required field">
                                        <label for="entity_name">Name of Organization</label>
                                        <input type="text" name="entity_name">
                                    </div>
                                    <div class="field">
                                        <label for="name_additional">Additional name</label>
                                        <input type="text" name="name_additional" placeholder="Additional organizaitonal name">
                                    </div>
                                </div>
                                <div class="two fields">
                                    @foreach($addresses as $address)
                                        <div class="{{$address=='primary'?'required':''}} field">
                                            <label for="name">Email ({{$address}})</label>
                                            <input type="text" name="{{$address}}_email">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <h4 class="ui dividing header">Contact Information</h4>
                        <div class="three fields">
                            <div class="field">
                                <label for="entity_phone_country_code">Country Code</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="entity_phone_country_code">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Select Country</div>
                                    <div class="menu">
                                        @foreach ($countries as $country)
                                            <div class="item" data-value="{{$country->code}}"><i class="{{$country->code}} flag"></i>{{$country->name}} (+{{$country->calling_code}})</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="entity_phone">Phone Number</label>
                                <input type="text" name="phone" placeholder="e.g. 15444444499" maxlength="15">
                            </div>
                            <div class="field">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" placeholder="e.g. 15444444499" maxlength="15">
                            </div>
                        </div>
                        <div class="four fields">
                            @forelse ($supported_links as $link)
                                <div class="field">
                                    <div class="ui left icon input">
                                        <input type="text" placeholder="{{$link->name}} Link" name="links[]">
                                        <i class="{{ $link->icon }} icon"></i>
                                    </div>
                                </div>
                            @empty
                                <p>No Supported links available ...</p>
                            @endforelse
                        </div>
                        @foreach($addresses as $address)
                        <h4 class="ui dividing header">Organization's {{$address}} address</h4>
                        <br>
                        <div class="five fields">
                            <div class="{{$address == 'primary'?'required':''}} field">
                                <label for="{{$address}}_address">Address</label>
                                <input type="text" name="{{$address}}_address">
                            </div>
                            <div class="required field">
                                <label for="{{$address}}_country_id">Country</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="{{$address}}_country_id">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Country</div>
                                    <div class="menu">
                                        @foreach ($countries as $country)
                                            <div class="item" data-value="{{$country->id}}">{{$country->name}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="required field">
                                <label for="{{$address}}_city_id">City, State</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="{{$address}}_city_id">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">City, State</div>
                                    <div class="menu">
                                        @foreach ($cities as $city)
                                            <div class="item" data-value="{{$city->id}}">{{$city->name}}, {{$city->state}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="phone">Post box</label>
                                <input type="text" name="{{$address}}_postbox" placeholder="e.g. AX113Z" maxlength="15">
                            </div>
                            <div class="field">
                                <label for="phone">Postal Code</label>
                                <input type="text" name="{{$address}}_postal_code" placeholder="e.g. AX113Z" maxlength="15">
                            </div>
                        </div>
                        @endforeach
                        <h4 class="ui dividing header">Which business sectors do the organization work in?</h4>
                        <div class="three fields">
                            @for ($i = 1; $i < 4; $i++)
                                <div class="field">
                                    <label for="entity_sector_{{$i}}">Business sector {{$i}}</label>
                                    <div class="ui fluid search selection dropdown">
                                        <input type="hidden" name="entity_sector_{{$i}}">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Business sector</div>
                                        <div class="menu">
                                            @foreach ($sectors as $sector)
                                                <div class="item" data-value="{{$sector->id}}">{{$sector->name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <h4 class="ui dividing header">About the organization</h4>
                        <div class="three fields">
                            <div class="field">
                                <label for="legal_form">Legal Form</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="legal_form">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Legal form</div>
                                    <div class="menu">
                                        <div class="item" data-value="Public">Public</div>
                                        <div class="item" data-value="Public">Private</div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="activity">Business activity</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="entity_activity">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Business activity</div>
                                    <div class="menu">
                                        @foreach ($activities as $activity)
                                            <div class="item" data-value="{{$activity}}">{{$activity}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="business_type">Business Type</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="business_type">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Business Type</div>
                                    <div class="menu">
                                        @foreach($business_options['business_type'] as $option)
                                            <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="three fields">
                            <div class="field">
                                <label for="entity_size">Size of organization</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="entity_size">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Size of organization</div>
                                    <div class="menu">
                                        @foreach($business_options['entity_size'] as $option)
                                        <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="employees">Employees</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="employees">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Number of Employees</div>
                                    <div class="menu">
                                        @foreach($business_options['employees'] as $option)
                                            <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="students">Students (for universities)</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="students">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Number of Students</div>
                                    <div class="menu">
                                        @foreach($business_options['students'] as $option)
                                            <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="ui dividing header">Financial Information</h4>
                        <div class="three fields">
                            <div class="field">
                                <label for="turnover">Annual turnover</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="turnover">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Annual turnover</div>
                                    <div class="menu">
                                        @foreach($business_options['turn_over'] as $option)
                                            <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="balance_sheet">Annual Balance Sheet</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="balance_sheet">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Annual Balance Sheet</div>
                                    <div class="menu">
                                        @foreach($business_options['balance_sheet'] as $option)
                                            <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="revenue">Annual Revenue</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="revenue">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Annual Revenue</div>
                                    <div class="menu">
                                        @foreach($business_options['revenue'] as $option)
                                            <div class="item" data-value="{{$option}}">{{$option}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui hidden error message" id="entity_form_errors"></div>
                        <div class="ui right floated basic segment">
                                <div class="ui black deny button" onclick="$('.ui.modal').modal('hide');">
                                    Cancel
                                </div>
                                <div class="ui positive right labeled icon button" id="entity_submit">
                                    Save
                                    <i class="checkmark icon"></i>
                                </div>
                        </div>
                    </form>
                </div>

        </div>
        <br><br>
    </body>
</html>




<script type="application/javascript">
    $(function() {
        $('.ui.dropdown')
            .dropdown()
        ;
        $('.checkbox').checkbox();
        $('#entity_form').form({
            on:'blur',
            inline: true,
            fields: {
                entity_type_id: {rules:[{type:'empty',prompt:'Please select an organization type'}]},
                founding_year: {optional:true,rules:[{type:'integer[1000..2050]', prompt:'Please enter a valid year'}]},
                name: {rules:[{type:'empty',prompt:'Please select an organization name'},{type:'maxLength[255]'}]},
                name_additional: {optional:true, rules:[{type:'maxLength[255]'}]},
                primary_email: {rules:[{type:'email', prompt:'Please enter a valid email'}]},
                secondary_email: {optional:true,rules:[{type:'email', prompt:'Please enter a valid email'}]},
                // phone_country_code: $('input[name="phone_country_code"]').val(),
                phone: {optional:true,rules:[{type:'maxLength[20]'},{type:'integer'}]},
                fax: {optional:true,rules:[{type:'maxLength[20]'},{type:'integer'}]},
                links: {identifier:'links[]',optional:true,rules:[{type:'url'}]},
                primary_address: {rules:[{type:'empty'},{type:'maxLength[100]'}]},
                primary_country_id: {rules:[{type:'empty'}]},
                primary_city_id: {rules:[{type:'empty'}]},
                primary_postbox: {optional:true, rules:[{type:'empty'},{type:'maxLength[100]'}]},
                primary_postal_code: {optional:true,rules:[{type:'empty'},{type:'maxLength[50]'}]},
                secondary_address: {optional:true,rules:[{type:'empty'},{type:'maxLength[100]'}]},
                secondary_postbox: {optional:true, rules:[{type:'empty'},{type:'maxLength[100]'}]},
                secondary_postal_code: {optional:true,rules:[{type:'empty'},{type:'maxLength[50]'}]},
            }
        });
    });
    function register_open(){
        $('.ui.modal')
            .modal('show')
        ;
    }
    $('input[name="country_id"]').change(function(){
        let value = this.value;
        let url = "{{url('/')}}"+"/country/"+value;
        console.log(url);
        $.ajax({
            method: 'GET',
            url: url,
        }).done(function(data){
            $('#city_id').dropdown('clear');
            $('#city_id').dropdown('setup menu', {
                values: data['data']['cities']
            });
        });
    });
    $('#entity_submit').click(function (){
        if( $('#entity_form').form('is valid')) {
            let web_links = [];
            $('input[name^="link_"]').each(function(){
                let temp = {
                    'link_type': $(this).attr('data-type'),
                    'url': $(this).val()
                };
                web_links.push(temp);
            });
            $.ajax({
                method: 'POST',
                url: "{{route('entity.store')}}",
                data: {
                    logo: $('input[name="logo"]').file,
                    entity_type_id: $('input[name="entity_type_id"]').val(),
                    founding_year: $('input[name="founding_year"]').val(),
                    name: $('input[name="entity_name"]').val(),
                    name_additional: $('input[name="name_additional"]').val(),
                    primary_email: $('input[name="primary_email"]').val(),
                    secondary_email: $('input[name="secondary_email"]').val(),
                    phone_country_code: $('input[name="entity_phone_country_code"]').val(),
                    phone: $('input[name="entity_phone"]').val(),
                    fax: $('input[name="fax"]').val(),
                    links: web_links,
                    primary_address: $('input[name="primary_address"]').val(),
                    primary_country_id: $('input[name="primary_country_id"]').val(),
                    primary_city_id: $('input[name="primary_city_id"]').val(),
                    primary_postbox: $('input[name="primary_postbox"]').val(),
                    primary_postal_code: $('input[name="primary_postal_code"]').val(),
                    secondary_address: $('input[name="secondary_address"]').val(),
                    secondary_country_id: $('input[name="secondary_country_id"]').val(),
                    secondary_city_id: $('input[name="secondary_city_id"]').val(),
                    secondary_postbox: $('input[name="secondary_postbox"]').val(),
                    secondary_postal_code: $('input[name="secondary_postal_code"]').val(),
                    sector_1: $('input[name="entity_sector_1"]').val(),
                    sector_2: $('input[name="entity_sector_2"]').val(),
                    sector_3: $('input[name="entity_sector_3"]').val(),
                    legal_form: $('input[name="legal_form"]').val(),
                    activity: $('input[name="entity_activity"]').val(),
                    business_type: $('input[name="business_type"]').val(),
                    entity_size:$('input[name="entity_size"]').val(),
                    employees: $('input[name="employees"]').val(),
                    students: $('input[name="students"]').val(),
                    turnover: $('input[name="turnover"]').val(),
                    balance_sheet: $('input[name="balance_sheet"]').val(),
                    revenue: $('input[name="revenue"]').val(),
                    _token: '{{Session::token()}}',
                }
            }).done(function(msg){
                console.log(msg['message']);
                $('.ui.modal').modal('hide');
                $('#flash_message').show()
                    .removeClass('negative')
                    .addClass("positive")
                    .text('Entity Saved Successfully!')
                    .delay(1500)
                    .fadeOut(400)
                ;
            });
        }else{
            $('#entity_form_errors').text('There are some errors with your input, please revise it and resubmit your form').show().delay(1500).fadeOut(400);
        }

    });
    $('#personal_info').click(function () {
        $('#personal_info_form').show();
        $('#organization_info_form').hide();
        $('#portal_info_form').hide();
        $('#personal_info').addClass('active');
        $('#organization_info').removeClass('active');
        $('#portal_info').removeClass('active');
    });
    $('#organization_info').click(function () {
        $('#personal_info_form').hide();
        $('#organization_info_form').show();
        $('#portal_info_form').hide();
        $('#personal_info').removeClass('active');
        $('#organization_info').addClass('active');
        $('#portal_info').removeClass('active');
    });
    $('#portal_info').click(function () {
        $('#personal_info_form').hide();
        $('#organization_info_form').hide();
        $('#portal_info_form').show();
        $('#personal_info').removeClass('active');
        $('#organization_info').removeClass('active');
        $('#portal_info').addClass('active');
    });
    $('#logo_upload_icon').click(function () {
        $('#logo_upload_input').trigger('click');
    });
    $('#avatar_upload_icon').click(function () {
        $('#avatar_upload_input').trigger('click');
    });
    $('#avatar_upload_input').change(function () {
        let file = $('input[name="avatar"]')[0].files[0];
        let form = new FormData();
        form.append('new_pp', file);
        form.append('old_pp', $('input[name="avatar_url"]').val());
        form.append('_token', "{{Session::token()}}");
        console.log(form);
        $.ajax({
            method: 'POST',
            url: "{{route('profilepicture.store')}}",
            contentType: false,
            processData: false,
            data: form,
            error: function() {
                alert("Error uploading the image, images should be png or jpg and less than 2MB");
            }
        }).done(function(link){
            let image_html = "<img class='ui circular centered small image' src='"+link+"'>";
            $('label[for="avatar"]').html(image_html);
            $('input[name="avatar_url"]').val(link);
        });
    });
    $('#logo_upload_input').change(function () {
        let file = $('input[name="logo"]')[0].files[0];
        let form = new FormData();
        form.append('new_pp', file);
        form.append('old_pp', $('input[name="logo_url"]').val());
        form.append('_token', "{{Session::token()}}");
        console.log(form);
        $.ajax({
            method: 'POST',
            url: "{{route('profilepicture.store')}}",
            contentType: false,
            processData: false,
            data: form,
            error: function() {
                alert("Error uploading the image, images should be png or jpg and less than 2MB");
            }
        }).done(function(link){
            let image_html = "<img class='ui circular centered small image' src='"+link+"'>";
            $('label[for="logo"]').html(image_html);
            $('input[name="logo_url"]').val(link);
        });
    });
    function entity_step(){
        $('#organization_info').trigger('click');
    }
    function person_step(){
        $('#personal_info').trigger('click');
    }
    function portal_step(){
        $('#portal_info').trigger('click');
    }

</script>
