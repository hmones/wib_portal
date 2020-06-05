<div class="ui form padded basic segment">
    <div class="ui hidden message" id="flash_message"></div>
    <div class="ui hidden message" id="form_errors"></div>
    <form id="entity_form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($entity)
            @method('PUT')
        @else
            @method('POST')
        @endisset
        <div class="ui stackable grid">
            <div class="five wide column">
                <div class="ui medium image">
                    <div class="ui center aligned basic segment field">
                        <h4 class="ui header">Organization logo</h4>
                        <label for="logo">
                            <a href="#" id="logo_upload_icon">
                                @isset($entity)
                                    @if($entity->logo()->exists())
                                        <img class='ui circular centered small image'
                                             src='{{$entity->logo()->thumbnail()->url}}' alt="{{$entity->name}}">
                                    @else
                                        <i class="circular inverted grey image huge icon"></i>
                                    @endif
                                @else
                                    <i class="circular inverted grey image huge icon"></i>
                                @endisset
                            </a>
                        </label>
                        <div class=""><small>Image size 300px x 300px</small></div>
                        <input type="file" name="logo" style="display: none;" id="logo_upload_input">
                        <input type="hidden"
                               value="@isset($entity){{isset($entity->logo()->thumbnail()->id)?$entity->logo()->thumbnail()->id:''}}@endisset"
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
                                   value="{{isset($entity)?$entity->users()->find(Auth::id())->pivot->relation_type:''}}">
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
                    @foreach($addresses as $address)
                        <div class="{{$address=='primary'?'required':''}} field">
                            <label for="name">Email ({{$address}})</label>
                            <input type="text" name="{{$address}}_email"
                                   value="@if($address='primary'){{$entity->primary_email??''}}@else{{$entity->secondary_email??''}}@endif">
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
                    <input type="hidden" name="entity_phone_country_code" value="{{$entity->phone_country_code??''}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Select Country</div>
                    <div class="menu">
                        @foreach ($countries as $country)
                            <div class="item" data-value="{{$country->calling_code}}"><i
                                    class="{{$country->code}} flag"></i>{{$country->name}} (+{{$country->calling_code}})
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
                               @isset($entity)value="{{isset($entity->links()->where('type_id',$link->id)->first()->url)?$entity->links()->where('type_id',$link->id)->first()->url:''}}"@endisset>
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
                    <input type="text" name="{{$address}}_address"
                           value="@if($address == 'primary'){{$entity->primary_address??''}}@else{{$entity->secondary_address??''}}@endif">
                </div>
                <div class="{{$address == 'primary'?'required':''}} field">
                    <label for="{{$address}}_country_id">Country</label>
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" name="{{$address}}_country_id"
                               value="@if($address == 'primary'){{$entity->primary_country_id??''}}@else{{$entity->secondary_country_id??''}}@endif">
                        <i class="dropdown icon"></i>
                        <div class="default text">Country</div>
                        <div class="menu">
                            @foreach ($countries as $country)
                                <div class="item" data-value="{{$country->id}}">{{$country->name}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="{{$address == 'primary'?'required':''}} field">
                    <label for="{{$address}}_city_id">City, State</label>
                    <div class="ui fluid search selection dropdown" id="{{$address}}_city_id">
                        <input type="hidden" name="{{$address}}_city_id"
                               value="@if($address == 'primary'){{$entity->primary_city_id??''}}@else{{$entity->secondary_city_id??''}}@endif">
                        <i class="dropdown icon"></i>
                        <div class="default text">City, State</div>
                        <div class="menu">
                            @isset($entity)
                                @if($address=='primary' && $entity->primary_country()->exists())
                                    @foreach($entity->primary_country->cities()->get() as $city)
                                        <div class="item" data-value="{{$city->id}}">{{$city->name}}</div>
                                    @endforeach
                                @elseif($address == 'secondary' && $entity->secondary_country()->exists())
                                    @foreach($entity->secondary_country->cities()->get() as $city)
                                        <div class="item" data-value="{{$city->id}}">{{$city->name}}</div>
                                    @endforeach
                                @endif
                            @else
                                @foreach ($cities as $city)
                                    <div class="item" data-value="{{$city->id}}">{{$city->name}}, {{$city->state}}</div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="{{$address}}_postbox">Post box</label>
                    <input type="text" name="{{$address}}_postbox" placeholder="e.g. AX113Z" maxlength="15"
                           value="@if($address == 'primary'){{$entity->primary_postbox??''}}@else{{$entity->secondary_postbox??''}}@endif">
                </div>
                <div class="field">
                    <label for="{{$address}}_postal_code">Postal Code</label>
                    <input type="text" name="{{$address}}_postal_code" placeholder="e.g. AX113Z"
                           maxlength="15" @if($address == 'primary'){{$entity->primary_postal_code??''}}@else{{$entity->secondary_postal_code??''}}@endif>
                </div>
            </div>
        @endforeach
        <h4 class="ui dividing header">Which field of activity does your organization work in?</h4>
        <div class="three fields">
            @for ($i = 1; $i < 4; $i++)
                <div class="{{$i==1?'required':''}} field">
                    <label for="entity_sector_{{$i}}">Field {{$i}}</label>
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" name="entity_sector_{{$i}}"
                               @isset($entity)value="{{isset($entity->sectors[$i-1]->id) ? $entity->sectors[$i-1]->id: ""}}"@endisset>
                        <i class="dropdown icon"></i>
                        <div class="default text">Field of activity</div>
                        <div class="menu">
                            @if($i != 1)
                                <div class="item" data-value=""></div>
                            @endif
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
                    <div class="ui icon circular small basic grey button tooltip" data-content="A start up is a company running for up to 2 years, a scale up is a company running up to 5 years, a traditional business is a company that is operational for more than 5 years." data-variation="basic">
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
        @isset($entity)
            <h4 class="ui dividing header">Product images:</h4>
            <div class="ui fluid basic segment" id="ImageUpload">
                <form id="uploadPhotos" action="{{route('image.upload', ['entity'=>$entity])}}" method="POST"
                      enctype="multipart/form-data">
                    <div class="ui middle aligned four column centered grid">
                        <div onclick="upload_images();" class="row" id="styledUploader">
                            <div class="ui basic center aligned segment sixteen wide column">
                                <i class="upload big blue icon"></i>
                                <br><br>
                                Click here to select product photos to upload
                            </div>
                        </div>

                    </div>
                </form>
                <form id="uploadPhotos" action="{{route('image.upload', ['entity'=>$entity])}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input style="display: none;" id="photoSelection" type="file" name="file[]" multiple>
                    <br><br>
                </form>
            </div>
            <br>
            <div class="ui stackable five column centered grid">
                @forelse($images as $image)
                    <div class="column">
                        <form method="POST" action="{{route('images.delete',['entity'=>$entity,'photo'=>$image])}}">
                            @method('DELETE')
                            @csrf
                            <div class="ui rounded image">
                                <button type="submit" class="ui red right corner label">
                                    <i class="close icon" style="top: -0.7em;"></i>
                                </button>
                                <img src="{{$image->thumbnail}}" class="ui image" alt="">
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="ten wide center aligned centered column">
                        <i class="info circle teal icon"></i> No product images to display
                    </div>
                @endforelse
            </div>
        @endisset
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