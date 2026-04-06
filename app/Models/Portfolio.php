<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 'thumbnail',
        'images', 'category', 'technologies', 'demo_url', 'github_url',
        'is_featured', 'is_active', 'sort_order', 'completed_at',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'completed_at' => 'date',
        'sort_order' => 'integer',
    ];

    public function getTechnologiesArrayAttribute(): array
    {
        if (!$this->technologies) return [];
        return array_map('trim', explode(',', $this->technologies));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
