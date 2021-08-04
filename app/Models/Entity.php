<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Entity extends Model
{
    use HasFactory;

    public const ACTIVITIES = ['Export', 'Import', 'Production', 'Services', 'Trade'];
    public const BUSINESS_TYPE = ['Start-Up', 'Scale-Up', 'Traditional Business'];
    public const SIZE = ['1-25', '26-50', '51-100', '101-250', '>250'];
    public const EMPLOYEES = ['100-300', '150-200', '101-250', '250-500', '>500'];
    public const STUDENTS = [
        '<200',
        '201-500',
        '501-1000',
        '1001-5000',
        '5001-10000',
        '10001-20000',
        '20001-50000',
        '50001-100000',
        '>100000'
    ];
    public const TURNOVER = [
        '<25K',
        '25K-50K',
        '50K-100K',
        '100K-500K',
        '500K-1Mio',
        '1Mio-3Mio',
        '3Mio-5Mio',
        '5Mio-10Mio',
        '>10Mio'
    ];
    public const BALANCE_SHEET = [
        '<25Mio',
        '25Mio-50Mio',
        '50Mio-100Mio',
        '100Mio-500Mio',
        '500Mio-1Bil',
        '1Bil-3Bil',
        '3Bil-5Bil',
        '5Bil-10Bil',
        '>10Bil'
    ];
    public const REVENUE = [
        '<25K',
        '25K-50K',
        '50K-100K',
        '100K-500K',
        '500K-1Mio',
        '1Mio-3Mio',
        '3Mio-5Mio',
        '5Mio-10Mio',
        '>10Mio'
    ];
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

    public function getPathAttribute()
    {
        $path = url('/') . '/entity/' . $this->id . '-' . Str::slug($this->name);
        return $path;
    }

    public function scopeOwnedby($query, $userID)
    {
        $query->where('owned_by', $userID);
    }

    public function scopeFilter($query, array $data)
    {
        if (isset($data['countries'])) {
            $countries = explode(",", $data['countries']);
            $query->whereIn('primary_country_id', $countries);
        }
        if (isset($data['sectors'])) {
            $sectors = explode(',', $data['sectors']);
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
        if (isset($data['type'])) {
            if ($data['type'] == 'business') {
                $query->whereHas('type', function ($q) {
                    $q->where('name', 'Business');
                });
            } else {
                $query->whereHas('type', function ($q) {
                    $q->where('name', '!=', 'Business');
                });
            }
        }
        return $query;
    }

    public function toSearchableArray()
    {
        return [
            'name'            => $this->name,
            'name_additional' => $this->name_additional,
        ];
    }
}
