<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $sliders = Slider::ordered()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title.tr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'subtitle.tr' => 'nullable|string|max:500',
            'subtitle.en' => 'nullable|string|max:500',
            'media_type' => 'required|in:image,video',
            'media' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slider = new Slider();
        $slider->title = $request->input('title');
        $slider->subtitle = $request->input('subtitle');
        $slider->media_type = $validated['media_type'];
        $slider->video_url = $validated['video_url'] ?? null;
        $slider->button_text = $validated['button_text'] ?? null;
        $slider->button_url = $validated['button_url'] ?? null;
        $slider->sort_order = $validated['sort_order'] ?? 0;
        $slider->is_active = $request->boolean('is_active');

        if ($request->hasFile('media')) {
            $slider->media_path = $this->imageService->processAndStore(
                $request->file('media'),
                'sliders'
            );
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla eklendi.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title.tr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'subtitle.tr' => 'nullable|string|max:500',
            'subtitle.en' => 'nullable|string|max:500',
            'media_type' => 'required|in:image,video',
            'media' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slider->title = $request->input('title');
        $slider->subtitle = $request->input('subtitle');
        $slider->media_type = $validated['media_type'];
        $slider->video_url = $validated['video_url'] ?? null;
        $slider->button_text = $validated['button_text'] ?? null;
        $slider->button_url = $validated['button_url'] ?? null;
        $slider->sort_order = $validated['sort_order'] ?? 0;
        $slider->is_active = $request->boolean('is_active');

        if ($request->hasFile('media')) {
            // Delete old image
            if ($slider->media_path) {
                $this->imageService->delete($slider->media_path);
            }
            $slider->media_path = $this->imageService->processAndStore(
                $request->file('media'),
                'sliders'
            );
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla güncellendi.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->media_path) {
            $this->imageService->delete($slider->media_path);
        }
        
        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla silindi.');
    }
}
