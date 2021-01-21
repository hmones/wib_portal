<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportedLink extends Model
{
    protected $table = 'supported_links';

    public function links()
    {
        return $this->hasMany('App\Models\Link', 'type_id');
    }
}
