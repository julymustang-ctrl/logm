@extends('layouts.frontend')

@section('meta_title', $project->getTranslatedMetaTitle() ?: $project->getTranslatedTitle() . ' | LOG Makine')
@section('meta_description', $project->getTranslatedMetaDescription() ?: $project->getTranslatedShortDescription())

@section('content')
<!-- Page Header -->
<section class="bg-primary-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($project->service)
            <span class="text-accent-400 text-sm font-medium uppercase tracking-wide">
                {{ $project->service->getTranslatedName() }}
            </span>
        @endif
        <h1 class="text-3xl lg:text-4xl font-bold mt-2 mb-4">{{ $project->getTranslatedTitle() }}</h1>
        <nav class="text-primary-300">
            <a href="{{ route('home') }}" class="hover:text-white">Anasayfa</a>
            <span class="mx-2">/</span>
            <a href="{{ route('projects') }}" class="hover:text-white">Projeler</a>
            <span class="mx-2">/</span>
            <span>{{ $project->getTranslatedTitle() }}</span>
        </nav>
    </div>
</section>

<!-- Project Content -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Cover Image or Video -->
                @if($project->video_url)
                    <div class="aspect-video rounded-xl overflow-hidden bg-gray-100 mb-8">
                        <iframe src="{{ str_replace('watch?v=', 'embed/', $project->video_url) }}" 
                                class="w-full h-full" 
                                frameborder="0" 
                                allowfullscreen></iframe>
                    </div>
                @elseif($project->cover_image)
                    <div class="aspect-video rounded-xl overflow-hidden bg-gray-100 mb-8">
                        <img src="{{ asset('storage/' . $project->cover_image) }}" 
                             alt="{{ $project->getTranslatedTitle() }}" 
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Description -->
                <div class="prose prose-lg max-w-none">
                    {!! $project->getTranslatedDescription() !!}
                </div>

                <!-- Gallery -->
                @if($project->images->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-xl font-semibold text-primary-800 mb-6">Proje Görselleri</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($project->images as $image)
                                <a href="{{ asset('storage/' . $image->path) }}" 
                                   target="_blank"
                                   class="aspect-video rounded-lg overflow-hidden bg-gray-100 hover:opacity-90 transition">
                                    <img src="{{ asset('storage/' . $image->path) }}" 
                                         alt="" 
                                         class="w-full h-full object-cover"
                                         loading="lazy">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <div class="bg-gray-50 rounded-xl p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-primary-800 mb-6">Proje Detayları</h3>
                    
                    <dl class="space-y-4">
                        @if($project->location)
                            <div>
                                <dt class="text-sm text-gray-500">Konum</dt>
                                <dd class="font-medium text-primary-800">{{ $project->location }}</dd>
                            </div>
                        @endif
                        
                        @if($project->duration)
                            <div>
                                <dt class="text-sm text-gray-500">Süre</dt>
                                <dd class="font-medium text-primary-800">{{ $project->duration }}</dd>
                            </div>
                        @endif
                        
                        @if($project->employer)
                            <div>
                                <dt class="text-sm text-gray-500">İşveren Kurum</dt>
                                <dd class="font-medium text-primary-800">{{ $project->employer }}</dd>
                            </div>
                        @endif
                        
                        @if($project->service)
                            <div>
                                <dt class="text-sm text-gray-500">Hizmet Türü</dt>
                                <dd class="font-medium text-primary-800">{{ $project->service->getTranslatedName() }}</dd>
                            </div>
                        @endif
                    </dl>

                    <hr class="my-6">

                    <a href="{{ route('contact') }}" class="block w-full bg-accent-500 hover:bg-accent-600 text-white text-center py-3 rounded-lg font-medium transition">
                        Benzer Proje Talep Et
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-primary-800 mb-8">Benzer Projeler</h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($relatedProjects as $related)
                <a href="{{ route('projects.show', $related) }}" class="group">
                    <div class="aspect-video rounded-xl overflow-hidden bg-gray-200">
                        @if($related->cover_image)
                            <img src="{{ asset('storage/' . $related->cover_image) }}" 
                                 alt="{{ $related->getTranslatedTitle() }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                 loading="lazy">
                        @endif
                    </div>
                    <h3 class="mt-4 font-semibold text-primary-800 group-hover:text-accent-600 transition">
                        {{ $related->getTranslatedTitle() }}
                    </h3>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
