@extends('layouts.admin')

@section('title', 'Referanslar')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Referanslar / Partner Logoları</h2>
    <a href="{{ route('admin.partners.create') }}" class="bg-accent-500 hover:bg-accent-600 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Yeni Referans</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sıra</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İsim</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Website</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($partners as $partner)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $partner->sort_order }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ $partner->getLogoUrl() }}" alt="{{ $partner->name }}" class="h-10 w-auto max-w-[120px] object-contain">
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $partner->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" class="text-accent-600 hover:underline">{{ parse_url($partner->url, PHP_URL_HOST) }}</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($partner->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Pasif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="text-accent-600 hover:text-accent-900 mr-3">Düzenle</a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="inline" onsubmit="return confirm('Bu referansı silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">Henüz referans eklenmemiş.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
