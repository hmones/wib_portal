<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityPhoto extends Model
{
    protected $table = 'entity_photos';

    public function entity()
    {
        return $this->belongsTo('App\Models\Entity');
    }

}
