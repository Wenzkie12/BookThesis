<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'amount',
        'reference_number',
        'payment_date',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_profile_id');
    }

    public function scopeFilter($query, array $filters)
{
    $query->when($filters['search'] ?? null, function ($q, $search) {
        $q->whereHas('profile.user', function ($sub) use ($search) {
            $sub->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->orWhere('reference_number', 'like', "%{$search}%");
    });

    if (isset($filters['filter'])) {
        match ($filters['filter']) {
            'today' => $query->whereDate('payment_date', now()),
            'yesterday' => $query->whereDate('payment_date', now()->subDay()),
            'last_week' => $query->whereBetween('payment_date', [now()->subWeek(), now()]),
            'last_month' => $query->whereBetween('payment_date', [now()->subMonth(), now()]),
            'last_year' => $query->whereBetween('payment_date', [now()->subYear(), now()]),
            default => null,
        };
    }

    return $query;
}

}

