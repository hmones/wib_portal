@extends('layouts.default')
@section('title','Signup for B2B event')
@section('content')
    <style>
        div.field label {
            font-size: 1.2rem !important;
            line-height: 2rem;
            font-weight: normal !important;
        }

        @media only screen and (max-width: 991.98px) {
            div.field label {
                font-size: 1rem !important;
            }
        }
    </style>
    <div class="ui container">
        <div class="ui stackable grid">
            <div class="seven wide column">
                <h1 class="ui page blue header">
                    B2B Supplier Application
                </h1>
                <div class="page subheader">
                    {{request()->round->text_application}}
                </div>
            </div>
        </div>
        <br>
        <form action="{{route('rounds.service-providers.store', request()->route('round'))}}" class="ui form"
              method="POST">
            @csrf
            <input type="hidden" name="type" value="provider"/>
            <div class="ui hidden divider"></div>
            <div class="two fields">
                <div class="required field">
                    <label for="entity">Select the company you want to apply with:</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="entity_id" id="entity">
                        <i class="dropdown icon"></i>
                        <div class="default text">Select a company</div>
                        <div class="scrollhint menu">
                            @foreach(auth()->user()->owned_entities as $entity)
                                <div class="item" data-value="{{$entity->id}}">{{$entity->name}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="computer only">&nbsp;</label>
                    <a href="{{route('entity.create')}}" target="_blank" rel="noopener" class="ui primary basic button">
                        <i class="plus icon"></i>Register your company
                    </a>
                </div>
            </div>
            <div class="required field">
                <label for="presentation">Please write a short presentation of your company</label>
                <textarea required name="data[presentation]" id="presentation" cols="30" rows="10"></textarea>
            </div>
            <div class="required field">
                <label for="motivation">What motivates you to be part of the B2B program</label>
                <textarea required name="data[motivation]" id="motivation" cols="30" rows="10"></textarea>
            </div>
            <div class="field">
                <label for="representative">Please mention the name of who will be representing your company in case you
                    will not
                    be present at the B2B</label>
                <input name="data[representative]" id="representative" type="text">
            </div>
            <div class="ui dividing header">Your Information</div>
            <div class="ui hidden divider"></div>
            <div class="fields">
                <x-Countries label="Country Code" class="four wide required"
                             fieldname="user[phone_country_code]"
                             countrycode=1 :value="auth()->user()->phone_country_code"/>
                <div class="twelve wide required field">
                    <label for="user[phone]">Phone Number</label>
                    <input required type="text" name="user[phone]" placeholder="e.g. 15444444499" maxlength="15"
                           value="{{auth()->user()->phone}}">
                </div>
            </div>
            <div class="four fields">
                @foreach ($links as $link)
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="text" placeholder="{{$link->name}} Link" data-type="{{$link->id}}"
                                   name="user[links][{{$loop->index}}][url]"
                                   value="{{isset(auth()->user()->links()->where('type_id',$link->id)->first()->url)?auth()->user()->links()->where('type_id',$link->id)->first()->url:''}}"/>
                            <input type="hidden" name="user[links][{{$loop->index}}][type_id]" value="{{$link->id}}">
                            <i class="{{ $link->icon }} icon"></i>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="required field">
                <label for="bio">Your personal bio (max 150 words)</label>
                <textarea required id="bio" rows="5" name="user[bio]"
                          placeholder="Max. 2500 charachters">{{auth()->user()->bio}}</textarea>
            </div>
            <div class="ui hidden divider"></div>
            <button type="submit" class="ui right labeled icon orange link large button">Apply <i class="send icon"></i>
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $('.ui.dropdown').dropdown();
    </script>
@endsection
