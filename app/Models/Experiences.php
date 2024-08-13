<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experiences extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ship_name',
        'flag',
        'ship_type',
        'rank',
        'GRT',
        'trade',
        'sign_on_date',
        'sign_off_date',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
