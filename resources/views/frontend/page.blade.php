@extends('layouts.frontend')

@section('meta_title', $page->getTranslatedMetaTitle())
@section('meta_description', $page->getTranslatedMetaDescription())

@section('content')
<!-- Page Header -->
<section class="bg-primary-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $page->getTranslatedTitle() }}</h1>
        <nav class="text-primary-300">
            <a href="{{ route('home') }}" class="hover:text-white">Anasayfa</a>
            <span class="mx-2">/</span>
            <span>{{ $page->getTranslatedTitle() }}</span>
        </nav>
    </div>
</section>

<!-- Content -->
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            {!! $page->getTranslatedContent() !!}
        </div>
    </div>
</section>
@endsection
