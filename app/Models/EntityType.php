<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    protected $table = 'entity_types';
    protected $guarded = [];

    public function entities()
    {
        return $this->hasMany('App\Models\Entity', 'entity_type_id');
    }
}
