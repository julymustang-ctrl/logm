@extends('layouts.frontend')

@section('meta_title', 'Hakkımızda | LOG Makine A.Ş.')

@section('content')
<!-- Page Header -->
<section class="bg-primary-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $page->getTranslatedTitle() }}</h1>
        <nav class="text-primary-300">
            <a href="{{ route('home') }}" class="hover:text-white">Anasayfa</a>
            <span class="mx-2">/</span>
            <span>Hakkımızda</span>
        </nav>
    </div>
</section>

<!-- Content -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            {!! $page->getTranslatedContent() !!}
        </div>
    </div>
</section>

<!-- Services Accordion -->
@if($services->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-primary-800 mb-12 text-center">Uzmanlık Alanlarımız</h2>
        
        <div class="space-y-4" x-data="{ openItem: 0 }">
            @foreach($services as $index => $service)
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-4 flex items-center justify-between text-left">
                        <span class="text-lg font-semibold text-primary-800">{{ $service->getTranslatedName() }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" 
                             :class="{ 'rotate-180': openItem === {{ $index }} }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openItem === {{ $index }}" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-6 pb-4 text-gray-600">
                        {{ $service->getTranslatedDescription() }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Team Section -->
@if($teams->count() > 0)
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-primary-800 mb-12 text-center">İdari Kadromuz</h2>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($teams as $member)
                <div class="text-center">
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" 
                             alt="{{ $member->name }}" 
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                             loading="lazy">
                    @else
                        <div class="w-32 h-32 rounded-full mx-auto mb-4 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                    <h3 class="font-semibold text-primary-800">{{ $member->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $member->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
