<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function cities()
    {
        return $this->hasMany('App\City', 'country_id', 'country_iso_code');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'country_id');
    }

    public function entities()
    {
        return $this->hasMany('App\Entity', 'primary_country_id');
    }

    public function entities_secondary()
    {
        return $this->hasMany('App\Entity', 'secondary_country_id');
    }
}
