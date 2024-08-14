<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cvforms extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vacancy_id',
        'profile_pic',
        'fullname',
        'rank',
        'nationality',
        'expected_salary',
        'religion',
        'dob',
        'place_of_birth',
        'height',
        'weight',
        'overall_size',
        'safety_shoe_size',
        'mobile_no',
        'email',
        'next_of_kin',
        'relationship',
        'next_of_kin_phone',
        'next_of_kin_email',
        'next_of_kin_address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancies::class);
    }
}
