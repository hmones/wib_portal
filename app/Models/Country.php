<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function cities()
    {
        return $this->hasMany('App\Models\City', 'country_id', 'country_iso_code');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'country_id');
    }

    public function entities()
    {
        return $this->hasMany('App\Models\Entity', 'primary_country_id');
    }

    public function entities_secondary()
    {
        return $this->hasMany('App\Models\Entity', 'secondary_country_id');
    }
}
