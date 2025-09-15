<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'book_id', 
        'penalty_type_id', 
        'amount',
        'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function penaltyType()
{
    return $this->belongsTo(PenaltyType::class);
}

public function scopeFilter($query, array $filters)
{
    $query->when($filters['search'] ?? null, function ($q, $search) {
        $q->whereHas('profile.user', function ($sub) use ($search) {
            $sub->where('name', 'like', "%{$search}%");
        });
    });

    if (isset($filters['sort'])) {
        match ($filters['sort']) {
            'today' => $query->whereDate('applied_at', now()),
            'yesterday' => $query->whereDate('applied_at', now()->subDay()),
            'last_week' => $query->whereBetween('applied_at', [now()->subWeek(), now()]),
            'last_month' => $query->whereBetween('applied_at', [now()->subMonth(), now()]),
            'last_year' => $query->whereBetween('applied_at', [now()->subYear(), now()]),
            default => null,
        };
    }

    return $query;
}


}
