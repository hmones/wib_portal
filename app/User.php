<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'birth_year', 'title', 'phone_country_code', 'phone',
        'postal_code', 'sphere', 'activity', 'business_association_wom', 'gdpr_consent', 'newsletter', 'mena_diaspora', 'education', 'network', 'bio', 'city_id', 'country_id', 'approved_at', 'approved_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function approved_by()
    {
        return $this->belongsTo('App\Admin', 'approved_by');
    }

    public function entities()
    {
        return $this->belongsToMany('App\Entity', 'user_entity', 'user_id', 'entity_id')->withPivot('relation_type', 'relation_desc', 'relation_active', 'relation_date');
    }

    public function sectors()
    {
        return $this->belongsToMany('App\Sector', 'user_sector', 'user_id', 'sector_id');
    }


    public function avatar()
    {
        return $this->morphMany('App\ProfilePicture', 'profileable');
    }

    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }

    public function searching_for()
    {
        return $this->morphMany('App\SearchingForOption', 'searchable');
    }

    public function owned_entities()
    {
        return $this->hasMany('App\Entity', 'owned_by');
    }

    public function scopeFilter($query, \Illuminate\Http\Request $request)
    {
        if ($request) {
            if (isset($request->countries) && !empty(implode('',$request->countries))) {
                $query->whereIn('country_id', explode(",",$request->countries[0]));
            }
            if (isset($request->sectors) && !empty(implode('',$request->sectors))) {
                $query->whereHas('sectors', function ($q) use ($request) {
                    $q->whereIn('id', explode(",",$request->sectors[0]));
                });
            }
        }
        $query->latest();
        return $query;
    }
}
