@extends('layouts.admin')

@section('title', isset($partner) ? 'Referans Düzenle' : 'Yeni Referans')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.partners.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Referans Listesine Dön
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ isset($partner) ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($partner))
                @method('PUT')
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Firma/Referans Adı *</label>
                <input type="text" name="name" value="{{ old('name', $partner->name ?? '') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <div>
                @if(isset($partner) && $partner->logo_path)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Logo</label>
                        <img src="{{ $partner->getLogoUrl() }}" alt="{{ $partner->name }}" class="h-16 w-auto bg-gray-100 p-2 rounded-lg">
                    </div>
                @endif
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ isset($partner) ? 'Yeni Logo' : 'Logo *' }}</label>
                <input type="file" name="logo" accept="image/*" {{ isset($partner) ? '' : 'required' }}
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                <p class="text-xs text-gray-500 mt-1">PNG veya SVG formatı önerilir (şeffaf arka plan)</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                <input type="url" name="url" value="{{ old('url', $partner->url ?? '') }}" placeholder="https://example.com"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sıra No</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                </div>
                <div class="flex items-end">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                        <span class="ml-2 text-sm text-gray-600">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4 border-t pt-6">
                <a href="{{ route('admin.partners.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">İptal</a>
                <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                    {{ isset($partner) ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
