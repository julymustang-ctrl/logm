@extends('layouts.admin')

@section('title', isset($page) ? 'Sayfa Düzenle' : 'Yeni Sayfa')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Sayfalara Dön
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($page))
                @method('PUT')
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" required placeholder="ornek-sayfa"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                <p class="text-xs text-gray-500 mt-1">URL'de görünecek benzersiz tanımlayıcı</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (Türkçe) *</label>
                <input type="text" name="title[tr]" value="{{ old('title.tr', $page->title['tr'] ?? '') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (İngilizce)</label>
                <input type="text" name="title[en]" value="{{ old('title.en', $page->title['en'] ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">İçerik (Türkçe)</label>
                <textarea name="content[tr]" rows="10"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('content.tr', $page->content['tr'] ?? '') }}</textarea>
            </div>

            <!-- SEO -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">SEO Ayarları</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Başlık (Türkçe)</label>
                        <input type="text" name="meta_title[tr]" value="{{ old('meta_title.tr', $page->meta_title['tr'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Açıklama (Türkçe)</label>
                        <textarea name="meta_description[tr]" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('meta_description.tr', $page->meta_description['tr'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                <span class="ml-2 text-sm text-gray-600">Aktif</span>
            </label>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.pages.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">İptal</a>
                <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                    {{ isset($page) ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
