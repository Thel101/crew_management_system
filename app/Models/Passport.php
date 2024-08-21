<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passport extends Model
{
    use HasFactory;
    protected $fillable = [
        'seafarer_id',
        'passport_no',
        'place_of_issue',
        'issue_date',
        'expiry_date',
        'status'
    ];
    public function seafarer(): BelongsTo
    {
        return $this->belongsTo(Seafarer::class);
    }
}
