<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'age',
        'bio',
        'avatar',
        'birthdate',
        'penalty',
        'province',
        'city',
        'barangay',
        'qr_code',
    ];

    protected $casts = [
        'penalty' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::saving(function ($profile) {
            if ($profile->user && $profile->user->student_id) {
                $profile->qr_code = $profile->user->student_id;
            } else {
                $profile->qr_code = 'NO-STUDENT-ID';
            }
        });
    }
}
