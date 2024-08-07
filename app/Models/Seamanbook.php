<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seamanbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'seaman_book',
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
