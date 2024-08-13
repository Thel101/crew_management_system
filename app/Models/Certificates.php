<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificates extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'certificate_no',
        'issue_date',
        'expiry_date',
        'issuing_authority',
        'cert_image',
        'status'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
