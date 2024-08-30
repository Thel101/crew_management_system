<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'vessel_id',
        'description',
        'count',
        'joining_date',
        'port',
        'basic_salary',
        'requirements'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Roles::class);
    }
    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessels::class);
    }
    public function seafarers(): HasMany
    {
        return $this->hasMany(Seafarer::class);
    }
}
