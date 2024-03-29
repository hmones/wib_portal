<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class B2bApplication extends Model
{
    use HasFactory;

    public const SUBMITTED = 'submitted';
    public const ACCEPTED = 'accepted';
    public const DECLINED = 'declined';
    public const STATUSES = [self::SUBMITTED, self::ACCEPTED, self::DECLINED];
    protected $guarded = [];
    protected $casts = [
        'data' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }
}
