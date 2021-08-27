<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedLink extends Model
{
    use HasFactory;

    protected $table = 'supported_links';

    public function links()
    {
        return $this->hasMany('App\Models\Link', 'type_id');
    }
}
