<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id', 'country_iso_code');
    }
    public function users()
    {
        return $this->hasMany('App\User', 'city_id');
    }
    public function entities()
    {
        return $this->hasMany('App\Entity', 'primary_city_id');
    }
    public function entities_secondary()
    {
        return $this->hasMany('App\Entity', 'secondary_city_id');
    }
}
