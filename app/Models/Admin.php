<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'approved_by');
    }

    public function entities()
    {
        return $this->hasMany('App\Models\Entity', 'approved_by');
    }
}
