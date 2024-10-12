<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vessels extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'flag',
        'type',
        'IMO_number',
        'built',
        'GRT',
        'DWT',
        'Engine',
        'BHP',
        'Trade'
    ];
    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }
    public function seafarers(): HasMany{
        return $this->hasMany(Seafarer::class, 'vessel_id');
    }
}
