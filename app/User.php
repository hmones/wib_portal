<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'gender', 'birth_year',
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

    public function entities()
    {
        return $this->belongsToMany('App\Entity', 'user_entity')->withPivot('relation_type','relation_desc', 'relation_active','relation_date');
    }

    public function sectors()
    {
        return $this->belongsToMany('App\Sector', 'user_sector', 'user_id', 'sector_id');
    }

    public function searching_for()
    {
        return $this->belongsToMany('App\SearchingForOption', 'user_search', 'user_id', 'search_id');
    }
    public function approved_by()
    {
        return $this->belongsTo('App\AdminUser', 'approved_by');
    }
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }
    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }
    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }
    public function avatar()
    {
        return $this->morphOne('App\ProfilePicture', 'profileable');
    }
}
