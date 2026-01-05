@extends('layouts.admin')

@section('title', isset($service) ? 'Hizmet Düzenle' : 'Yeni Hizmet')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Hizmetlere Dön
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($service))
                @method('PUT')
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Hizmet Adı (Türkçe) *</label>
                <input type="text" name="name[tr]" value="{{ old('name.tr', $service->name['tr'] ?? '') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Hizmet Adı (İngilizce)</label>
                <input type="text" name="name[en]" value="{{ old('name.en', $service->name['en'] ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama (Türkçe)</label>
                <textarea name="description[tr]" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ old('description.tr', $service->description['tr'] ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">İkon (Lucide icon adı)</label>
                    <input type="text" name="icon" value="{{ old('icon', $service->icon ?? '') }}" placeholder="building"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sıra No</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
            </div>

            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                <span class="ml-2 text-sm text-gray-600">Aktif</span>
            </label>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.services.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">İptal</a>
                <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                    {{ isset($service) ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
