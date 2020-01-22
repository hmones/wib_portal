<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    public function entity()
    {
        return $this->belongsTo('App\Entity');
    }
    public function type()
    {
        return $this->belongsTo('App\SupportedLink');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
