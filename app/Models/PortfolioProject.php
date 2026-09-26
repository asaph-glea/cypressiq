<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PortfolioProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'industry',
        'category',
        'summary',
        'description',
        'cover_image',
        'gallery_images',
        'technologies',
        'outcomes',
        'project_url',
        'duration',
        'completed_at',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'technologies'   => 'array',
        'outcomes'       => 'array',
        'is_featured'    => 'boolean',
        'is_published'   => 'boolean',
        'sort_order'     => 'integer',
        'completed_at'   => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (PortfolioProject $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

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
        return $query->orderBy('sort_order')->orderByDesc('completed_at');
    }
}
