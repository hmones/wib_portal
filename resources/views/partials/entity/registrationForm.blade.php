<div class="ui form padded basic segment">
    <div class="ui hidden message" id="flash_message"></div>
    <div class="ui hidden message" id="form_errors"></div>
    <form id="entity_form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($entity->id)@method('PUT')@endisset
        <div class="ui stackable grid">
            <div class="five wide column">
                <div class="ui medium image">
                    <div class="ui center aligned basic segment field">
                        <h4 class="ui header">Organization logo</h4>
                        <label for="logo">
                            <a href="#" id="logo_upload_icon">
                                @if($entity->logo()->exists())
                                <img class='ui circular centered small image'
                                    src='{{$entity->logo()->thumbnail()->url}}' alt="{{$entity->name}}">
                                @else
                                <i class="circular inverted grey image huge icon"></i>
                                @endif
                            </a>
                        </label>
                        <div class=""><small>Image size 300px x 300px</small></div>
                        <input type="file" name="logo" style="display: none;" id="logo_upload_input">
                        <input type="hidden"
                            value="{{isset($entity->logo()->thumbnail()->id)?$entity->logo()->thumbnail()->id:''}}"
                            name="logo_id">
                    </div>
                </div>
            </div>
            <div class="eleven wide column ui form">
                <div class="two fields">
                    <div class="required field">
                        <label for="entity_type_id">Type of Organization</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="entity_type_id" value="{{$entity->entity_type_id??''}}">
                            <i class="dropdown icon"></i>
                            <div class="default text">Type of organizaiton</div>
                            <div class="menu">
                                @foreach ($entity_types as $entity_type)
                                <div class="item" data-value="{{$entity_type->id}}">{{$entity_type->name}}</div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="required field">
                        <label for="relation">Your relation to the organization</label>
                        <div class="ui fluid search selection dropdown @error('relation') error @enderror">
                            <input required type="hidden" name="relation"
                                value="{{isset($entity->id)?$entity->users()->find(Auth::id())->pivot->relation_type:''}}">
                            <i class="dropdown icon"></i>
                            <div class="default text">Your relation to the organization..</div>
                            <div class="menu">
                                <div class="item">Select relationship</div>
                                @foreach ($relations as $relation)
                                <div class="item" data-value="{{$relation}}">{{$relation}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="three fields">
                    <div class="required field">
                        <label for="name">Name of Organization</label>
                        <input type="text" name="name" value="{{$entity->name??''}}">
                    </div>
                    <div class="field">
                        <label for="name_additional">Additional name</label>
                        <input type="text" name="name_additional" placeholder="Additional organizaitonal name"
                            value="{{$entity->name_additional??''}}">
                    </div>
                    <div class="required field">
                        <label for="founding_year">Founding Year</label>
                        <input type="text" required name="founding_year" placeholder="e.g. 1980" maxlength="4"
                            value="{{$entity->founding_year??''}}">
                    </div>
                </div>
                <div class="two fields">

                    <div class="required field">
                        <label for="name">Email</label>
                        <input type="text" name="primary_email" value="{{$entity->primary_email??''}}" />
                    </div>
                    <div class="field">
                        <label for="name">Additional email</label>
                        <input type="text" name="secondary_email" value="{{$entity->secondary_email??''}}" />
                    </div>

                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Contact Information</h4>
        <div class="three fields">
            <x-Countries countrycode=1 fieldname="entity_phone_country_code" label="Country Code"
                :value="$entity->phone_country_code" />
            <div class="field">
                <label for="entity_phone">Phone Number</label>
                <input type="text" name="entity_phone" placeholder="e.g. 15444444499" maxlength="15"
                    value="{{$entity->phone??''}}">
            </div>
            <div class="field">
                <label for="fax">Fax</label>
                <input type="text" name="fax" placeholder="e.g. 15444444499" maxlength="15"
                    value="{{$entity->fax??''}}">
            </div>
        </div>
        <div class="four fields">
            @forelse ($supported_links as $link)
            <div class="field">
                <div class="ui left icon input">
                    <input type="text" placeholder="{{$link->name}} Link" data-type="{{$link->id}}"
                        name="entity_link_{{$link->id}}"
                        value="{{isset($entity->links()->where('type_id',$link->id)->first()->url)?$entity->links()->where('type_id',$link->id)->first()->url:''}}">
                    <i class="{{ $link->icon }} icon"></i>
                </div>
            </div>
            @empty
            <p>No Supported links available ...</p>
            @endforelse
        </div>


        <h4 class="ui dividing header">Organization's primary address</h4>
        <br>
        <div class="five fields">
            <div class="required field">
                <label for="primary_address">Address</label>
                <input type="text" name="primary_address" value="{{$entity->primary_address??''}}">
            </div>
            <x-Countries fieldname="primary_country_id" label="Country" :value="$entity->primary_country_id"
                class="required" />
            <div class="required field">
                <label for="primary_city_id">City, State</label>
                <div class="ui fluid search selection dropdown" id="primary_city_id">
                    <input type="hidden" name="primary_city_id" value="{{$entity->primary_city_id??''}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">City, State</div>
                    <div class="menu">
                        @if($entity->primary_country()->exists())
                        @foreach($entity->primary_country->cities()->get() as $city)
                        <div class="item" data-value="{{$city->id}}">{{$city->name}}, {{$city->state}}</div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="primary_postbox">Post box</label>
                <input type="text" name="primary_postbox" placeholder="e.g. AX113Z" maxlength="15"
                    value="{{$entity->primary_postbox??''}}">
            </div>
            <div class="field">
                <label for="primary_postal_code">Postal Code</label>
                <input type="text" name="primary_postal_code" placeholder="e.g. AX113Z" maxlength="15"
                    {{$entity->primary_postal_code??''}}>
            </div>
        </div>

        <h4 class="ui dividing header">Organization's secondary address</h4>
        <br>
        <div class="five fields">
            <div class="field">
                <label for="secondary_address">Address</label>
                <input type="text" name="secondary_address" value="{{$entity->secondary_address??''}}">
            </div>
            <x-Countries fieldname="secondary_country_id" label="Country" :value="$entity->secondary_country_id" />
            <div class="field">
                <label for="secondary_city_id">City, State</label>
                <div class="ui fluid search selection dropdown" id="secondary_city_id">
                    <input type="hidden" name="secondary_city_id" value="{{$entity->secondary_city_id??''}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">City, State</div>
                    <div class="menu">
                        @if($entity->secondary_country()->exists())
                        @foreach($entity->secondary_country->cities()->get() as $city)
                        <div class="item" data-value="{{$city->id}}">{{$city->name}}, {{$city->state}}</div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="secondary_postbox">Post box</label>
                <input type="text" name="secondary_postbox" placeholder="e.g. AX113Z" maxlength="15"
                    value="{{$entity->secondary_postbox??''}}">
            </div>
            <div class="field">
                <label for="secondary_postal_code">Postal Code</label>
                <input type="text" name="secondary_postal_code" placeholder="e.g. AX113Z" maxlength="15"
                    {{$entity->secondary_postal_code??''}}>
            </div>
        </div>


        <h4 class="ui dividing header">Which field of activity does your organization work in?</h4>
        <div class="three fields">
            <x-sectors label="Field 1" fieldname="entity_sector_1" default-text="Field of activity" class="required"
                :value="$entity" />

            <x-sectors label="Field 2" fieldname="entity_sector_2" default-text="Field of activity" :value="$entity"
                offset=1 empty-option="Not applicable" />
            <x-sectors label="Field 3" fieldname="entity_sector_3" default-text="Field of activity"
                empty-option="Not applicable" :value="$entity" offset=2 />
        </div>
        <h4 class="ui dividing header">About the organization</h4>
        <div class="three fields">
            <div class="field">
                <label for="legal_form">Legal Form</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="legal_form" value="{{$entity->legal_form??''}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Legal form</div>
                    <div class="menu">
                        <div class="item" data-value="Public">Public</div>
                        <div class="item" data-value="Private">Private</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="activity">Business activity</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="entity_activity" value="{{$entity->activity??''}}">
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
                <label for="business_type">
                    Business Type
                    <div class="ui icon circular small basic grey button tooltip"
                        data-content="A start up is a company running for up to 2 years, a scale up is a company running up to 5 years, a traditional business is a company that is operational for more than 5 years."
                        data-variation="basic">
                        <i class="question blue small icon"></i>
                    </div>
                </label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="business_type" value="{{$entity->business_type??''}}">
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
                <label for="entity_size">Size of organization (employees)</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="entity_size" value="{{$entity->entity_size??''}}">
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
                <label for="employees">Members (for associations)</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="employees" value="{{$entity->employees??''}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Number of Members</div>
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
                    <input type="hidden" name="students" value="{{$entity->students??''}}">
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
                <label for="turnover">Annual turnover (USD)</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="turnover" value="{{$entity->turn_over??''}}">
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
                <label for="balance_sheet">Annual Balance Sheet (USD)</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="balance_sheet" value="{{$entity->balance_sheet??''}}">
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
                <label for="revenue">Annual Revenue (USD)</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="revenue" value="{{$entity->revenue??''}}">
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
        <h4 class="ui dividing header">Product images:</h4>
        <div id="photosContainer" class="ui five column stackable grid">
            <div class="column">
                <a id="uploadPhotoBtn" href="javascript:void(0);" style="min-height:253px;"
                    class="ui center aligned centered placeholder raised segment">
                    <div class="ui center aligned basic segment">
                        <i id="photosUploadIcon" class="blue upload cloud big icon"></i>
                    </div>
                </a>
                <input type="file" name="photos" id="PhotosUploadInput" style="display: none;" accept="image/*"
                    multiple />
            </div>
            @foreach ($images as $photo)
            <div class='column'>
                <div class='ui center aligned segment'>
                    <div class='ui image'>
                        <img src='{{ $photo->thumbnail }}' />
                    </div>
                    </br></br>
                    <input type='text' placeholder='Add a comment ...' class='field photo comment'
                        data-id="{{$photo->id}}" value="{{$photo->comment}}" />
                    <div class='floating ui red circular label'>
                        <i class='close icon image' data-id='{{$photo->id}}' style='margin-left:0px;'></i>
                    </div>
                </div>
                <input type='hidden' name='photosID[]' value='{{$photo->id}}'>
            </div>
            @endforeach
        </div>



        <div class="ui right floated basic segment">
            <a class="ui blue deny button" href="{{route('profile.entities')}}">
                Cancel
            </a>
            <div class="ui positive right labeled icon button" id="entity_submit">
                Save
                <i class="checkmark icon"></i>
            </div>
        </div>
    </form>
</div>