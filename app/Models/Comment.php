<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the owning photos model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function reactions(){
        return $this->morphMany('App\Models\Reaction','reactionable');
    }
}
