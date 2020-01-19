<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    public function links()
    {
        return $this->hasMany('App\Link');
    }
}
