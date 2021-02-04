<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    use hasFactory;

    protected $table = 'entity_types';
    protected $guarded = [];

    public function entities()
    {
        return $this->hasMany('App\Models\Entity', 'entity_type_id');
    }
}
