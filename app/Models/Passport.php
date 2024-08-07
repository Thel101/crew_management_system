<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'passport_no',
        'place_of_issue',
        'issue_date',
        'expiry_date',
        'status'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
