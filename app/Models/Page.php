<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get translated title
     */
    public function getTranslatedTitle(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['tr'] ?? '';
    }

    /**
     * Get translated content
     */
    public function getTranslatedContent(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->content[$locale] ?? $this->content['tr'] ?? '';
    }

    /**
     * Get translated meta title
     */
    public function getTranslatedMetaTitle(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_title[$locale] ?? $this->meta_title['tr'] ?? '';
    }

    /**
     * Get translated meta description
     */
    public function getTranslatedMetaDescription(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_description[$locale] ?? $this->meta_description['tr'] ?? '';
    }

    /**
     * Auto-generate slug from title on create
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $title = $page->title['tr'] ?? $page->title['en'] ?? 'page';
                $page->slug = Str::slug($title);
            }
        });
    }
}
