<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccounts extends Model
{
    use HasFactory;
    protected $fillable=[
        'seafarer_id',
        'account_no',
        'bank_branch',
        'account_holder',
        'holder_phone'
    ];
    public function seafarer() : BelongsTo{
        return $this->belongsTo(Seafarer::class);
    }
}
