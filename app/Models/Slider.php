<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'media_type',
        'media_path',
        'video_url',
        'button_text',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'is_active' => 'boolean',
    ];

    // Translatable helpers
    public function getTranslatedTitle(): ?string
    {
        $locale = app()->getLocale();
        return $this->title[$locale] ?? $this->title['tr'] ?? null;
    }

    public function getTranslatedSubtitle(): ?string
    {
        $locale = app()->getLocale();
        return $this->subtitle[$locale] ?? $this->subtitle['tr'] ?? null;
    }

    // Media URL helpers
    public function getMediaUrl(): ?string
    {
        if ($this->media_type === 'video' && $this->video_url) {
            return $this->video_url;
        }
        
        if ($this->media_path) {
            return asset('storage/' . $this->media_path);
        }
        
        return null;
    }

    public function getEmbedUrl(): ?string
    {
        if (!$this->video_url) return null;
        
        // Convert YouTube watch URL to embed
        if (str_contains($this->video_url, 'youtube.com/watch')) {
            return str_replace('watch?v=', 'embed/', $this->video_url);
        }
        
        // Convert youtu.be short URL to embed
        if (str_contains($this->video_url, 'youtu.be/')) {
            return str_replace('youtu.be/', 'youtube.com/embed/', $this->video_url);
        }
        
        return $this->video_url;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
