<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntityPhoto extends Model
{
    protected $table = 'entity_photos';

    public function entity()
    {
        return $this->belongsTo('App\Entity');
    }

}
