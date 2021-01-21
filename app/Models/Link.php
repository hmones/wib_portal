<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $guarded = [];

    /**
     * Get the owning linkable model.
     */
    public function linkable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo('App\Models\SupportedLink');
    }


}
