<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'clinic',
        'document_date',
        'result',
        'file',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
