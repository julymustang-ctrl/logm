<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $projects = Project::with('service')->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $services = Service::active()->ordered()->get();
        return view('admin.projects.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'title.tr' => 'required|string|max:255',
            'short_description.tr' => 'nullable|string',
            'description.tr' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'cover_image' => 'nullable|image|max:10240',
            'images.*' => 'nullable|image|max:10240',
            'meta_title.tr' => 'nullable|string|max:255',
            'meta_description.tr' => 'nullable|string',
        ]);

        $slug = Str::slug($request->input('title.tr'));

        $data = [
            'service_id' => $request->service_id,
            'slug' => $slug,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'location' => $request->location,
            'duration' => $request->duration,
            'employer' => $request->employer,
            'video_url' => $request->video_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ];

        // Process cover image
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageService->processAndStore(
                $request->file('cover_image'),
                'projects/covers'
            );
        }

        $project = Project::create($data);

        // Process gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $this->imageService->processAndStore($image, 'projects/gallery');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proje başarıyla oluşturuldu.');
    }

    public function edit(Project $project)
    {
        $services = Service::active()->ordered()->get();
        $project->load('images');
        return view('admin.projects.edit', compact('project', 'services'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'title.tr' => 'required|string|max:255',
            'short_description.tr' => 'nullable|string',
            'description.tr' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'cover_image' => 'nullable|image|max:10240',
            'images.*' => 'nullable|image|max:10240',
            'meta_title.tr' => 'nullable|string|max:255',
            'meta_description.tr' => 'nullable|string',
        ]);

        $slug = Str::slug($request->input('title.tr'));

        $data = [
            'service_id' => $request->service_id,
            'slug' => $slug,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'location' => $request->location,
            'duration' => $request->duration,
            'employer' => $request->employer,
            'video_url' => $request->video_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ];

        // Process cover image
        if ($request->hasFile('cover_image')) {
            // Delete old cover
            if ($project->cover_image) {
                $this->imageService->delete($project->cover_image);
            }
            $data['cover_image'] = $this->imageService->processAndStore(
                $request->file('cover_image'),
                'projects/covers'
            );
        }

        $project->update($data);

        // Process new gallery images
        if ($request->hasFile('images')) {
            $currentMaxOrder = $project->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = $this->imageService->processAndStore($image, 'projects/gallery');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'path' => $path,
                    'sort_order' => $currentMaxOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proje başarıyla güncellendi.');
    }

    public function destroy(Project $project)
    {
        // Delete cover image
        if ($project->cover_image) {
            $this->imageService->delete($project->cover_image);
        }

        // Delete gallery images
        foreach ($project->images as $image) {
            $this->imageService->delete($image->path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proje başarıyla silindi.');
    }

    /**
     * Delete a single gallery image
     */
    public function deleteImage(ProjectImage $image)
    {
        $this->imageService->delete($image->path);
        $image->delete();

        return response()->json(['success' => true]);
    }
}
