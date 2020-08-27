<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';

    protected $guarded = [];


    public function type()
    {
        return $this->belongsTo('App\EntityType', 'entity_type_id');
    }

    public function approved_by()
    {
        return $this->belongsTo('App\Admin', 'approved_by');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_entity')->withPivot('relation_type', 'relation_desc', 'relation_active', 'relation_date');
    }

    public function owned_by()
    {
        return $this->belongsTo('App\User', 'owned_by');
    }

    public function sectors()
    {
        return $this->belongsToMany('App\Sector', 'entity_sector', 'entity_id', 'sector_id');
    }

    public function primary_country()
    {
        return $this->hasOne('App\Country', 'id', 'primary_country_id');
    }

    public function secondary_country()
    {
        return $this->hasOne('App\Country', 'id', 'secondary_country_id');
    }

    public function primary_city()
    {
        return $this->hasOne('App\City', 'id', 'primary_city_id');
    }

    public function secondary_city()
    {
        return $this->hasOne('App\City', 'id', 'secondary_city_id');
    }

    public function logo()
    {
        return $this->morphMany('App\ProfilePicture', 'profileable');
    }

    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }

    public function photos()
    {
        return $this->morphMany('App\Photos', 'photoable');
    }

    public function searching_for()
    {
        return $this->morphMany('App\SearchingForOption', 'searchable');
    }

    public function scopeOwnedby($query, $userID)
    {
        $query->where('owned_by', $userID);
    }

    public function scopeFilter($query, \Illuminate\Http\Request $request)
    {
        if (isset($request->countries[0])) {
            $query->whereIn('primary_country_id', explode(",", $request->countries[0]));
        }
        if (isset($request->sectors[0])) {
            $query->whereHas('sectors', function ($q) use ($request) {
                $q->whereIn('id', explode(",", $request->sectors[0]));
            });
        }
        $query->latest();
        return $query;
    }


}
