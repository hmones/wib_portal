<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use ElasticScoutDriverPlus\CustomSearch;
use ElasticScoutDriverPlus\Builders\SearchRequestBuilder;
use App\Search\PostSearchQueryBuilder;

class Post extends Model
{
    use HasFactory;
    use Searchable, CustomSearch;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment','commentable')->latest();
    }

    public function reactions(){
        return $this->morphMany('App\Models\Reaction','reactionable');
    }

    public function sector(){
        return $this->belongsTo('\App\Models\Sector', 'sector_id');
    }

    public function country(){
        return $this->belongsTo('\App\Models\Country','country_id');
    }

    public function toSearchableArray()
    {
        return [
            'content' => $this->content,
        ];
    }

    public static function searchForm(): SearchRequestBuilder
    {
        return new SearchRequestBuilder(new static(), new PostSearchQueryBuilder());
    }
}
