<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sectors';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_sector');
    }

    public function entities()
    {
        return $this->belongsToMany('App\Entity', 'entity_sector');
    }
}
