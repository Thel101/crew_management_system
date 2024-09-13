<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable =[
        'seafarer_id',
        'base_salary',
        'bonus',
        'overtime_pay',
        'deduction',
        'total_salary',
        'start_date',
        'end_date',
        'payment_date',
        'status'
    ];
    public function seafarer() : BelongsTo{
        return $this->belongsTo(Seafarer::class);
    }
}
