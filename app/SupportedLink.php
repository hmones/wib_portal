<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportedLink extends Model
{
    protected $table = 'supported_links';

    public function links()
    {
        return $this->hasMany('App\Link', 'type_id');
    }
}
