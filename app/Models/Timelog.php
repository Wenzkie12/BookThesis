<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'time_in', 'time_out'];

    protected $casts = [
    'time_in' => 'datetime',
    'time_out' => 'datetime',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
