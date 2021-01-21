<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchingForOption extends Model
{
    protected $table = 'searching_for_options';

    public function users()
    {
        return $this->morphTo();
    }

    public function entities()
    {
        return $this->morphTo();
    }
}
