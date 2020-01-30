<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'birth_year', 'title', 'phone_country_code', 'phone',
        'postal_code', 'sphere', 'activity', 'business_association_wom', 'gdpr_consent', 'newsletter', 'mena_diaspora', 'education', 'network', 'bio', 'city_id', 'country_id'
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
        return $this->belongsTo('App\AdminUser', 'approved_by');
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
}
