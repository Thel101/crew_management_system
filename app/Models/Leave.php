<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;

    protected $fillable =[
        'seafarer_id',
        'leave_start',
        'leave_end',
        'reason',
        'count',
        'status'
    ];
    public function seafarer(): BelongsTo{
        return $this->belongsTo(Seafarer::class);
    }
}
