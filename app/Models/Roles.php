<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];
    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }
    public function seafarers(): HasMany{
        return $this->hasMany(Seafarer::class);
    }
}

