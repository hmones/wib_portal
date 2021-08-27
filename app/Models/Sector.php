<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectors';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_sector');
    }

    public function entities()
    {
        return $this->belongsToMany('App\Models\Entity', 'entity_sector');
    }
}
