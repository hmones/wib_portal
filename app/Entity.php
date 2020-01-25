<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }
    public function photos()
    {
        return $this->morphMany('App\Photos', 'photoable');
    }
    public function logo()
    {
        return $this->morphOne('App\ProfilePicture', 'profileable');
    }
    public function type()
    {
        return $this->belongsTo('App\EntityType', 'entity_type_id');
    }
    public function approved_by()
    {
        return $this->belongsTo('App\AdminUser', 'approved_by');
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_entity')->withPivot('relation_type','relation_desc', 'relation_active','relation_date');
    }
    public function sectors()
    {
        return $this->belongsToMany('App\Sector', 'entity_sector', 'entity_id', 'sector_id');
    }
    public function searching_for()
    {
        return $this->belongsToMany('App\SearchingForOption', 'entity_search', 'entity_id', 'search_id');
    }
    public function primary_country()
    {
        return $this->hasOne('App\Country', 'primary_country_id');
    }
    public function secondary_country()
    {
        return $this->hasOne('App\Country', 'secondary_country_id');
    }
    public function primary_city()
    {
        return $this->hasOne('App\City', 'primary_city_id');
    }
    public function secondary_city()
    {
        return $this->hasOne('App\City', 'secondary_city_id');
    }


}
