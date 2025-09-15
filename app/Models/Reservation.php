<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'pickup_date',
        'due_date',
        'initial_duedate',
        'claimed_at',
        'claimed_by',
        'returned_by',
        'completed_at',
        'cancelled_at',
        'lost_status',       
        'lost_declared',
        'pickup_date_edited',
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
        'due_date' => 'datetime',
        'initial_duedate' => 'datetime',
        'claimed_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

public function claimedBy()
{
    return $this->belongsTo(User::class, 'claimed_by');
}

public function returnedBy()
{
    return $this->belongsTo(User::class, 'returned_by');
}

public static function userCannotReserveDueToIncompleteProfile(): bool
{
    $profile = Auth::user()->profile;

    return !$profile ||
        is_null($profile->phone) ||
        is_null($profile->province) ||
        is_null($profile->city) ||
        is_null($profile->barangay);
}
}
