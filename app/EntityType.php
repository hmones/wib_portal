<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    protected $table = 'entity_types';
    protected $guarded = [];

    public function entities()
    {
        return $this->hasMany('App\Entity', 'entity_type_id');
    }
}
