<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchingForOption extends Model
{
    protected $table = 'searching_for_options';

    public function users()
    {
        return $this->belongsToMany('App\User','user_search', 'search_id', 'user_id');
    }
    public function entities()
    {
        return $this->belongsToMany('App\Entity', 'entity_search', 'search_id', 'entity_id');
    }
}
