@extends('layouts.admin')

@section('title', 'Proje Düzenle')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.projects.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Projelere Dön
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (Türkçe) *</label>
                    <input type="text" name="title[tr]" value="{{ old('title.tr', $project->title['tr'] ?? '') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (İngilizce)</label>
                    <input type="text" name="title[en]" value="{{ old('title.en', $project->title['en'] ?? '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hizmet Türü</label>
                    <select name="service_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                        <option value="">Seçiniz</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id', $project->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->getTranslatedName() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konum</label>
                    <input type="text" name="location" value="{{ old('location', $project->location) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Süre</label>
                    <input type="text" name="duration" value="{{ old('duration', $project->duration) }}" placeholder="Örn: 6 Ay"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">İşveren Kurum</label>
                    <input type="text" name="employer" value="{{ old('employer', $project->employer) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
            </div>

            <!-- Descriptions -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kısa Açıklama (Türkçe)</label>
                <textarea name="short_description[tr]" rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('short_description.tr', $project->short_description['tr'] ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Detaylı Açıklama (Türkçe)</label>
                <textarea name="description[tr]" rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('description.tr', $project->description['tr'] ?? '') }}</textarea>
            </div>

            <!-- Current Cover Image -->
            @if($project->cover_image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Kapak Fotoğrafı</label>
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="" class="w-48 h-auto rounded-lg">
                </div>
            @endif

            <!-- Media -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Yeni Kapak Fotoğrafı</label>
                    <input type="file" name="cover_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                    <p class="text-xs text-gray-500 mt-1">Boş bırakırsanız mevcut görsel korunur</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Video URL (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $project->video_url) }}" placeholder="https://youtube.com/watch?v=..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
            </div>

            <!-- Current Gallery Images -->
            @if($project->images->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Galeri Fotoğrafları</label>
                    <div class="grid grid-cols-4 gap-4" x-data>
                        @foreach($project->images as $image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="" class="w-full h-24 object-cover rounded-lg">
                                <button type="button" 
                                        @click="if(confirm('Bu görseli silmek istediğinize emin misiniz?')) { 
                                            fetch('{{ route('admin.project-images.destroy', $image) }}', { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                                            .then(() => $el.parentElement.remove()) 
                                        }"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Yeni Galeri Fotoğrafları Ekle</label>
                <input type="file" name="images[]" accept="image/*" multiple
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
            </div>

            <!-- SEO -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">SEO Ayarları</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Başlık (Türkçe)</label>
                        <input type="text" name="meta_title[tr]" value="{{ old('meta_title.tr', $project->meta_title['tr'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Açıklama (Türkçe)</label>
                        <textarea name="meta_description[tr]" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('meta_description.tr', $project->meta_description['tr'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Options -->
            <div class="flex items-center space-x-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                    <span class="ml-2 text-sm text-gray-600">Öne Çıkan Proje</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                    <span class="ml-2 text-sm text-gray-600">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    İptal
                </a>
                <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                    Güncelle
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
