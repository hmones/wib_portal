<?php

namespace App\Models;

use App\Search\UserSearchQueryBuilder;
use ElasticScoutDriverPlus\Builders\SearchRequestBuilder;
use ElasticScoutDriverPlus\CustomSearch;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Searchable, CustomSearch;
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'gender', 'birth_year', 'title', 'phone_country_code', 'phone',
        'postal_code', 'sphere', 'activity', 'business_association_wom', 'gdpr_consent', 'newsletter',
        'mena_diaspora', 'education', 'network', 'bio', 'city_id', 'country_id', 'approved_at', 'approved_by',
        'last_login', 'image', 'notify_message', 'notify_post', 'notify_user', 'notify_comment',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public static function searchForm(): SearchRequestBuilder
    {
        return new SearchRequestBuilder(new static(), new UserSearchQueryBuilder());
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['last_login'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function approved_by()
    {
        return $this->belongsTo('App\Models\Admin', 'approved_by');
    }

    public function entities()
    {
        return $this->belongsToMany('App\Models\Entity', 'user_entity', 'user_id', 'entity_id')->withPivot('relation_type', 'relation_desc', 'relation_active', 'relation_date');
    }

    public function sectors()
    {
        return $this->belongsToMany('App\Models\Sector', 'user_sector', 'user_id', 'sector_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function reactions()
    {
        return $this->hasMany('App\Models\Reaction');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function links()
    {
        return $this->morphMany('App\Models\Link', 'linkable');
    }

    public function searching_for()
    {
        return $this->morphMany('App\Models\SearchingForOption', 'searchable');
    }

    public function owned_entities()
    {
        return $this->hasMany('App\Models\Entity', 'owned_by');
    }

    public function getPathAttribute()
    {
        return url('/') . '/profile/' . $this->id . '-' . Str::slug($this->name);
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['countries'])) {
            $countries = explode(",",$data['countries']);
            $query->whereIn('country_id', $countries);
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
        if (isset($data['last_login'])){
            $query->orderBy('last_login', $data['last_login']);
        }
        if (isset($data['name'])) {
            $query->orderBy('name', $data['name']);
        }
        return $query;
    }
}
