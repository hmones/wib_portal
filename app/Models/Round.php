<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory;

    public const DRAFT = 'draft';
    public const OPEN = 'open';
    public const CLOSED = 'closed';
    public const STATUSES = [self::DRAFT, self::OPEN, self::CLOSED];

    protected $guarded = [];

    protected $casts = [
        'from' => 'datetime',
        'to'   => 'datetime'
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(B2bApplication::class);
    }
}
