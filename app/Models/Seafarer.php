<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seafarer extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // Update the formatted_id after the record has been created
            $model->formatted_id = 'SE-' . str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }
    protected $fillable = [
        'user_id',
        'role_id',
        'vessel_id',
        'status',
        'formatted_id',
        'fullname',
        'profile',
        'seaman_book',
        'seaman_book_place',
        'issue_date',
        'nationality',
        'religion',
        'dob',
        'weight',
        'height',
        'overall_size',
        'mobile_no',
        'email',
        'next_of_kin',
        'relationship',
        'next_of_kin_mobile',
        'sign_on',
        'sign_off'
    ];
    public function role(): BelongsTo{
        return $this->belongsTo(Roles::class);
    }
    public function vessel(): BelongsTo{
        return $this->belongsTo(Vessels::class);
    }
    public function passport(): HasMany
    {
        return $this->hasMany(Passport::class);
    }
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificates::class);
    }
    public function experiences(): HasMany
    {
        return $this->hasMany(Experiences::class);
    }
    public function medical_documents(): HasMany
    {
        return $this->hasMany(MedicalDocuments::class);
    }
    public function bank_accounts(): HasMany{
        return $this->hasMany(BankAccounts::class);
    }
    public function leaves(): HasMany{
        return $this->hasMany(Leave::class);
    }
}
