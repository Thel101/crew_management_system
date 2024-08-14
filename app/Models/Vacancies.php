<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancies extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'vessel_id',
        'description',
        'requirements',
        'availability',
        'status'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Roles::class);
    }
    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessels::class);
    }
    public function cvforms(): HasMany
    {
        return $this->hasMany(cvforms::class);
    }
}
