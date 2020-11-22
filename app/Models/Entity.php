<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use ElasticScoutDriverPlus\CustomSearch;
use App\Search\EntitySearchQueryBuilder;
use ElasticScoutDriverPlus\Builders\SearchRequestBuilder;

class Entity extends Model
{
    use HasFactory;
    use Searchable, CustomSearch;
    
    protected $table = 'entities';

    protected $guarded = [];


    public function type()
    {
        return $this->belongsTo('App\Models\EntityType', 'entity_type_id');
    }

    public function approved_by()
    {
        return $this->belongsTo('App\Models\Admin', 'approved_by');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_entity')->withPivot('relation_type', 'relation_desc', 'relation_active', 'relation_date');
    }

    public function owned_by()
    {
        return $this->belongsTo('App\Models\User', 'owned_by');
    }

    public function sectors()
    {
        return $this->belongsToMany('App\Models\Sector', 'entity_sector', 'entity_id', 'sector_id');
    }

    public function primary_country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'primary_country_id');
    }

    public function secondary_country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'secondary_country_id');
    }

    public function primary_city()
    {
        return $this->hasOne('App\Models\City', 'id', 'primary_city_id');
    }

    public function secondary_city()
    {
        return $this->hasOne('App\Models\City', 'id', 'secondary_city_id');
    }

    public function links()
    {
        return $this->morphMany('App\Models\Link', 'linkable');
    }

    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'photoable');
    }

    public function searching_for()
    {
        return $this->morphMany('App\Models\SearchingForOption', 'searchable');
    }

    public function scopeOwnedby($query, $userID)
    {
        $query->where('owned_by', $userID);
    }

    public function scopeFilter($query, array $data)
    {
        if (isset($data['countries'])) {
            $countries = explode(",",$data['countries']);
            $query->whereIn('primary_country_id', $countries);
        }
        if (isset($data['sectors'])) {
            $sectors = explode(',',$data['sectors']);
            $query->whereHas('sectors', function ($q) use ($sectors) {
                $q->whereIn('id', $sectors);
            });
        }
        if (isset($data['is_verified'])) {
            $query->whereNotNull('approved_at');
        }
        if (isset($data['name'])) {
            $query->orderBy('name', $data['name']);
        }
        return $query;
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'name_additional' => $this->name_additional,
        ];
    }

    public static function searchForm(): SearchRequestBuilder
    {
        return new SearchRequestBuilder(new static(), new EntitySearchQueryBuilder());
    }


}
