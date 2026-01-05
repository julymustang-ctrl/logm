@extends('layouts.frontend')

@section('meta_title', 'Projeler | LOG Makine A.Ş.')

@section('content')
<!-- Page Header -->
<section class="bg-primary-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">Projeler</h1>
        <nav class="text-primary-300">
            <a href="{{ route('home') }}" class="hover:text-white">Anasayfa</a>
            <span class="mx-2">/</span>
            <span>Projeler</span>
        </nav>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($projects->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="group">
                        <div class="relative overflow-hidden rounded-xl aspect-video bg-gray-200">
                            @if($project->cover_image)
                                <img src="{{ asset('storage/' . $project->cover_image) }}" 
                                     alt="{{ $project->getTranslatedTitle() }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4">
                            @if($project->service)
                                <span class="text-xs font-medium text-accent-600 uppercase tracking-wide">
                                    {{ $project->service->getTranslatedName() }}
                                </span>
                            @endif
                            <h3 class="text-lg font-semibold text-primary-800 group-hover:text-accent-600 transition mt-1">
                                {{ $project->getTranslatedTitle() }}
                            </h3>
                            @if($project->location)
                                <p class="text-gray-500 text-sm mt-1">{{ $project->location }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-xl">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <p class="text-gray-500">Henüz proje eklenmemiş.</p>
            </div>
        @endif
    </div>
</section>
@endsection
