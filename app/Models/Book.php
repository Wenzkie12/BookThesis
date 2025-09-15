<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'author', 'date_published', 'quantity', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $filters)
{
    $query->when($filters['search'] ?? null, function ($q, $search) {
        $q->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('author', 'LIKE', "%{$search}%")
              ->orWhere('date_published', 'LIKE', "%{$search}%")
              ->orWhereHas('category', fn ($sub) =>
                  $sub->where('name', 'LIKE', "%{$search}%")
              );
        });
    });

    $query->when($filters['category'] ?? null, fn ($q, $category) =>
        $q->where('category_id', $category)
    );
}

}
