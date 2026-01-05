@extends('layouts.admin')

@section('title', isset($slider) ? 'Slider Düzenle' : 'Yeni Slider')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.sliders.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Slider Listesine Dön
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ isset($slider) ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ mediaType: '{{ $slider->media_type ?? 'image' }}' }">
            @csrf
            @if(isset($slider))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (Türkçe) *</label>
                    <input type="text" name="title[tr]" value="{{ old('title.tr', $slider->title['tr'] ?? '') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alt Başlık (Türkçe)</label>
                    <textarea name="subtitle[tr]" rows="2"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('subtitle.tr', $slider->subtitle['tr'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Media Type Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Medya Tipi *</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="media_type" value="image" x-model="mediaType"
                               class="w-4 h-4 text-accent-600 border-gray-300 focus:ring-accent-500">
                        <span class="ml-2 text-sm text-gray-600">Görsel</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="media_type" value="video" x-model="mediaType"
                               class="w-4 h-4 text-accent-600 border-gray-300 focus:ring-accent-500">
                        <span class="ml-2 text-sm text-gray-600">Video (YouTube/Vimeo)</span>
                    </label>
                </div>
            </div>

            <!-- Image Upload -->
            <div x-show="mediaType === 'image'" x-transition>
                @if(isset($slider) && $slider->media_path)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Görsel</label>
                        <img src="{{ asset('storage/' . $slider->media_path) }}" alt="" class="w-64 h-auto rounded-lg">
                    </div>
                @endif
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ isset($slider) ? 'Yeni Görsel' : 'Görsel' }}</label>
                <input type="file" name="media" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                <p class="text-xs text-gray-500 mt-1">16:9 formatında kırpılacak (önerilen: 1920x1080)</p>
            </div>

            <!-- Video URL -->
            <div x-show="mediaType === 'video'" x-transition>
                <label class="block text-sm font-medium text-gray-700 mb-2">Video URL (YouTube/Vimeo)</label>
                <input type="url" name="video_url" value="{{ old('video_url', $slider->video_url ?? '') }}" placeholder="https://youtube.com/watch?v=..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <!-- Button Settings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buton Metni</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text ?? '') }}" placeholder="Örn: Detaylı Bilgi"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buton Linki</label>
                    <input type="text" name="button_url" value="{{ old('button_url', $slider->button_url ?? '') }}" placeholder="/projeler"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
            </div>

            <!-- Options -->
            <div class="grid grid-cols-2 gap-6 border-t pt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sıra No</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $slider->sort_order ?? 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
                <div class="flex items-end">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                        <span class="ml-2 text-sm text-gray-600">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4 border-t pt-6">
                <a href="{{ route('admin.sliders.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">İptal</a>
                <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                    {{ isset($slider) ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
