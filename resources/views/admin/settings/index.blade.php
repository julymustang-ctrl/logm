@extends('layouts.admin')

@section('title', 'Site Ayarları')

@section('content')
<div class="max-w-4xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Site Ayarları</h2>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach($settings as $group => $groupSettings)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 capitalize">
                    @switch($group)
                        @case('general')
                            Genel Ayarlar
                            @break
                        @case('contact')
                            İletişim Bilgileri
                            @break
                        @case('social')
                            Sosyal Medya
                            @break
                        @case('footer')
                            Footer & Yasal
                            @break
                        @default
                            {{ $group }}
                    @endswitch
                </h3>
                
                <div class="space-y-4">
                    @foreach($groupSettings as $setting)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                @switch($setting->key)
                                    @case('site_name') Site Adı @break
                                    @case('site_description') Site Açıklaması @break
                                    @case('logo') Logo @break
                                    @case('logo_white') Logo (Beyaz) @break
                                    @case('phone') Telefon @break
                                    @case('email') E-posta @break
                                    @case('address') Adres @break
                                    @case('maps_embed') Google Maps Embed Kodu @break
                                    @case('facebook') Facebook @break
                                    @case('instagram') Instagram @break
                                    @case('linkedin') LinkedIn @break
                                    @case('twitter') Twitter @break
                                    @case('footer_text') Footer Metni @break
                                    @case('kvkk_text') KVKK Metni @break
                                    @case('cookie_text') Çerez Politikası @break
                                    @default {{ $setting->key }}
                                @endswitch
                            </label>

                            @if($setting->type === 'image')
                                @if($setting->value)
                                    <div class="mb-2">
                                        <img src="{{ asset($setting->value) }}" alt="" class="h-12">
                                    </div>
                                @endif
                                <input type="file" name="{{ $setting->key }}" accept="image/*"
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                            @elseif($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">{{ $setting->value }}</textarea>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-accent-500 hover:bg-accent-600 text-white rounded-lg transition">
                Kaydet
            </button>
        </div>
    </form>
</div>
@endsection
