<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_role',
        'client_company',
        'client_avatar',
        'quote',
        'rating',
        'product_or_solution',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'is_published'  => 'boolean',
        'rating'        => 'integer',
        'sort_order'    => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('created_at');
    }
}
