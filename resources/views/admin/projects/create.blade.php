@extends('layouts.admin')

@section('title', 'Yeni Proje')

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
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (Türkçe) *</label>
                    <input type="text" name="title[tr]" value="{{ old('title.tr') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (İngilizce)</label>
                    <input type="text" name="title[en]" value="{{ old('title.en') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hizmet Türü</label>
                    <select name="service_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                        <option value="">Seçiniz</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->getTranslatedName() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konum</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Süre</label>
                    <input type="text" name="duration" value="{{ old('duration') }}" placeholder="Örn: 6 Ay"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">İşveren Kurum</label>
                    <input type="text" name="employer" value="{{ old('employer') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
            </div>

            <!-- Descriptions -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kısa Açıklama (Türkçe)</label>
                <textarea name="short_description[tr]" rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('short_description.tr') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Detaylı Açıklama (Türkçe)</label>
                <textarea name="description[tr]" rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('description.tr') }}</textarea>
            </div>

            <!-- Media -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapak Fotoğrafı</label>
                    <input type="file" name="cover_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                    <p class="text-xs text-gray-500 mt-1">Otomatik olarak 16:9 oranında kırpılacak</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Video URL (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Fotoğrafları (Maks. 10)</label>
                <input type="file" name="images[]" accept="image/*" multiple
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                <p class="text-xs text-gray-500 mt-1">Tüm görseller 16:9 oranında kırpılacak ve WebP formatına dönüştürülecek</p>
            </div>

            <!-- SEO -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">SEO Ayarları</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Başlık (Türkçe)</label>
                        <input type="text" name="meta_title[tr]" value="{{ old('meta_title.tr') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Açıklama (Türkçe)</label>
                        <textarea name="meta_description[tr]" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('meta_description.tr') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Options -->
            <div class="flex items-center space-x-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                    <span class="ml-2 text-sm text-gray-600">Öne Çıkan Proje</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                    <span class="ml-2 text-sm text-gray-600">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    İptal
                </a>
                <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                    Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
