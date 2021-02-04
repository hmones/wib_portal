<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use hasFactory;

    public $timestamps = false;
    protected $table = 'cities';

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'country_iso_code');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'city_id');
    }

    public function entities()
    {
        return $this->hasMany('App\Models\Entity', 'primary_city_id');
    }

    public function entities_secondary()
    {
        return $this->hasMany('App\Models\Entity', 'secondary_city_id');
    }
}
