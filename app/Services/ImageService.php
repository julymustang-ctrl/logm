<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Process and store an uploaded image
     * Crops to 16:9 aspect ratio and converts to WebP
     */
    public function processAndStore(UploadedFile $file, string $directory = 'uploads'): string
    {
        $image = $this->manager->read($file->getPathname());
        
        // Calculate dimensions for 16:9 crop
        $originalWidth = $image->width();
        $originalHeight = $image->height();
        
        $targetRatio = 16 / 9;
        $currentRatio = $originalWidth / $originalHeight;
        
        if ($currentRatio > $targetRatio) {
            // Image is wider, crop width
            $newWidth = (int) ($originalHeight * $targetRatio);
            $newHeight = $originalHeight;
        } else {
            // Image is taller, crop height
            $newWidth = $originalWidth;
            $newHeight = (int) ($originalWidth / $targetRatio);
        }
        
        // Center crop to 16:9
        $image->cover($newWidth, $newHeight);
        
        // Resize to max 1920x1080
        if ($newWidth > 1920) {
            $image->scale(width: 1920);
        }
        
        // Convert to WebP
        $encoded = $image->toWebp(quality: 85);
        
        // Generate unique filename
        $filename = Str::uuid() . '.webp';
        $path = $directory . '/' . $filename;
        
        // Store the file
        Storage::disk('public')->put($path, $encoded->toString());
        
        return $path;
    }

    /**
     * Process thumbnail (smaller version)
     */
    public function processAndStoreThumbnail(UploadedFile $file, string $directory = 'thumbnails'): string
    {
        $image = $this->manager->read($file->getPathname());
        
        // Calculate dimensions for 16:9 crop
        $originalWidth = $image->width();
        $originalHeight = $image->height();
        
        $targetRatio = 16 / 9;
        $currentRatio = $originalWidth / $originalHeight;
        
        if ($currentRatio > $targetRatio) {
            $newWidth = (int) ($originalHeight * $targetRatio);
            $newHeight = $originalHeight;
        } else {
            $newWidth = $originalWidth;
            $newHeight = (int) ($originalWidth / $targetRatio);
        }
        
        $image->cover($newWidth, $newHeight);
        
        // Resize to thumbnail size (480px width)
        $image->scale(width: 480);
        
        $encoded = $image->toWebp(quality: 80);
        
        $filename = Str::uuid() . '.webp';
        $path = $directory . '/' . $filename;
        
        Storage::disk('public')->put($path, $encoded->toString());
        
        return $path;
    }

    /**
     * Process team photo (square crop for avatars)
     */
    public function processTeamPhoto(UploadedFile $file, string $directory = 'teams'): string
    {
        $image = $this->manager->read($file->getPathname());
        
        // Square crop for team photos
        $size = min($image->width(), $image->height());
        $image->cover($size, $size);
        
        // Resize to reasonable size
        if ($size > 400) {
            $image->scale(width: 400);
        }
        
        $encoded = $image->toWebp(quality: 85);
        
        $filename = Str::uuid() . '.webp';
        $path = $directory . '/' . $filename;
        
        Storage::disk('public')->put($path, $encoded->toString());
        
        return $path;
    }

    /**
     * Delete an image from storage
     */
    public function delete(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
