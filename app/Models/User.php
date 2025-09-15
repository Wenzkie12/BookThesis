<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'student_id',
        'department_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class);
    }

    public function timelogs()
    {
        return $this->hasMany(Timelog::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeSearch(Builder $query, $value)
    {
        if (!$value) {
            return $query;
        }

        return $query->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', "%{$value}%")
                  ->orWhere('email', 'LIKE', "%{$value}%")
                  ->orWhere(function ($query) use ($value) {
                      if (strtolower($value) === 'verified') {
                          $query->whereNotNull('email_verified_at');
                      } elseif (in_array(strtolower($value), ['not verified', 'unverified'])) {
                          $query->whereNull('email_verified_at');
                      }
                  })
                  ->orWhereHas('roles', function ($q) use ($value) {
                      $q->where('name', 'LIKE', "%{$value}%");
                  });
        });
    }
}
