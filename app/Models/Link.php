<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    protected $guarded = [];

    public function linkable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo('App\Models\SupportedLink');
    }
}
