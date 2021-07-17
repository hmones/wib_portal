<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'from_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'to_id');
    }
}
