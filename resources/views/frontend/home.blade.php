@extends('layouts.frontend')

@section('content')
<!-- Hero Section (Parallax) -->
<section class="relative h-[200vh]" x-data="{ scroll: 0 }" @scroll.window="scroll = window.scrollY">
    <div class="sticky top-0 h-screen overflow-hidden">
        <!-- Layer 1: Background (Atmosphere) -->
        <div class="absolute inset-0 bg-gradient-to-b from-primary-900 to-primary-950 z-0">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1487887235947-a955ef187fcc?q=80&w=2555&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-transparent to-transparent"></div>
        </div>

        <!-- Layer 2: Background Machine (Behind Text) -->
        <div class="absolute inset-x-0 bottom-0 z-10 flex justify-center items-end"
             :style="'transform: translateY(' + (-scroll * 0.1) + 'px)'">
            <img src="{{ asset('images/hero-back.png') }}" 
                 alt="Background Machine" 
                 class="w-full max-w-[90%] object-contain drop-shadow-2xl brightness-90"
                 style="max-height: 90vh;">
        </div>

        <!-- Layer 3: Text (Middle - Sandwiched) -->
        <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none"
             :style="'transform: translateY(' + (scroll * 0.3) + 'px); opacity: ' + (1 - scroll/600)">
            <h1 class="font-display font-bold text-white tracking-tighter text-center leading-[0.8] drop-shadow-2xl"
                style="font-size: 15vw; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                TEMELDE<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-400 to-accent-600">GÜÇ</span> VAR.
            </h1>
        </div>

        <!-- Layer 4: Foreground Machine (Front of Text) -->
        <div class="absolute inset-x-0 bottom-0 z-30 flex justify-center items-end pointer-events-none"
             :style="'transform: translateY(' + (-scroll * 0.25) + 'px)'">
            <img src="{{ asset('images/hero-front.png') }}" 
                 alt="Foreground Machine" 
                 class="w-full max-w-[90%] object-contain drop-shadow-2xl brightness-110 contrast-115"
                 style="max-height: 90vh;">
        </div>
        
        <!-- Gradient Overlay at bottom to blend -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-primary-950 to-transparent z-30"></div>
    </div>
</section>

<!-- Content Wrapper relative to appear above the scroll space -->
<div class="relative z-40 bg-primary-950 -mt-32">
    
    <!-- Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -translate-y-1/2">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-primary-900/50 backdrop-blur-md border border-primary-800 p-8 rounded-2xl flex flex-col items-center justify-center text-center group hover:border-accent-500/50 transition-colors">
                <span class="text-5xl font-display font-bold text-white mb-2" x-data="{ count: 0 }" x-intersect="count = 150">
                    <span x-text="count"></span>+
                </span>
                <span class="text-primary-400 uppercase tracking-widest text-sm font-semibold">Tamanlanan Proje</span>
            </div>
             <div class="bg-primary-900/50 backdrop-blur-md border border-primary-800 p-8 rounded-2xl flex flex-col items-center justify-center text-center group hover:border-accent-500/50 transition-colors">
                <span class="text-5xl font-display font-bold text-white mb-2" x-data="{ count: 0 }" x-intersect="count = 5000">
                    <span x-text="count"></span>+
                </span>
                <span class="text-primary-400 uppercase tracking-widest text-sm font-semibold">Fore Kazık (m)</span>
            </div>
             <div class="bg-primary-900/50 backdrop-blur-md border border-primary-800 p-8 rounded-2xl flex flex-col items-center justify-center text-center group hover:border-accent-500/50 transition-colors">
                <span class="text-5xl font-display font-bold text-white mb-2" x-data="{ count: 0 }" x-intersect="count = 20">
                    <span x-text="count"></span>+
                </span>
                <span class="text-primary-400 uppercase tracking-widest text-sm font-semibold">Yıllık Tecrübe</span>
            </div>
        </div>
    </div>

    <!-- Services Section (Bento Grid) -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute top-1/4 left-0 w-96 h-96 bg-accent-500/10 rounded-full blur-[128px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-accent-500 font-bold tracking-widest uppercase mb-4 text-sm">Hizmetlerimiz</h2>
                <h3 class="text-4xl md:text-5xl font-display font-bold text-white">Mühendislik Çözümleri</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[300px]">
                @foreach($services as $index => $service)
                    <div class="group relative rounded-3xl overflow-hidden bg-primary-900 border border-primary-800 {{ $index === 0 || $index === 3 ? 'md:col-span-2' : '' }} hover:border-accent-500/50 transition-all duration-500"
                         x-data
                         @mousemove="$el.style.setProperty('--x', $event.clientX - $el.getBoundingClientRect().left); $el.style.setProperty('--y', $event.clientY - $el.getBoundingClientRect().top)">
                        
                        <!-- Spotlight Effect -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                             style="background: radial-gradient(600px circle at calc(var(--x) * 1px) calc(var(--y) * 1px), rgba(245, 158, 11, 0.15), transparent 40%);"></div>

                        <div class="absolute inset-0 p-8 flex flex-col justify-between z-10">
                            <div class="w-12 h-12 rounded-xl bg-accent-500/10 flex items-center justify-center text-accent-500 group-hover:bg-accent-500 group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            
                            <div>
                                <h4 class="text-2xl font-display font-bold text-white mb-2 group-hover:translate-x-2 transition-transform duration-300">{{ $service->getTranslatedName() }}</h4>
                                <p class="text-primary-400 text-sm line-clamp-3 group-hover:text-primary-300 transition-colors">{{ $service->getTranslatedDescription() }}</p>
                            </div>
                        </div>
                        
                        <!-- Grid Pattern Background -->
                         <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-20"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Section (Expandable Cards) -->
    <section class="py-24 bg-primary-900 border-y border-primary-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-accent-500 font-bold tracking-widest uppercase mb-4 text-sm">Portfolyo</h2>
                    <h3 class="text-4xl md:text-5xl font-display font-bold text-white">Seçkin Projeler</h3>
                </div>
                <a href="{{ route('projects') }}" class="hidden md:flex items-center text-white hover:text-accent-500 transition-colors font-medium">
                    Tümünü Gör
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="flex flex-col md:flex-row gap-4 h-[600px]">
                @foreach($recentProjects->take(4) as $project)
                    <div class="relative flex-1 group transition-all duration-500 ease-out hover:flex-[3] overflow-hidden rounded-2xl bg-primary-800 border border-primary-700">
                        @if($project->cover_image)
                            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->getTranslatedTitle() }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-60 group-hover:opacity-100">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 w-full p-8 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            @if($project->service)
                                <span class="text-accent-500 text-xs font-bold uppercase tracking-wider mb-2 block opacity-0 group-hover:opacity-100 transition-opacity delay-100">{{ $project->service->getTranslatedName() }}</span>
                            @endif
                            
                            <h3 class="text-2xl font-display font-bold text-white mb-2 whitespace-nowrap md:whitespace-normal">{{ $project->getTranslatedTitle() }}</h3>
                            
                             <div class="h-0 group-hover:h-auto overflow-hidden transition-all duration-500">
                                <p class="text-gray-300 text-sm mb-4 line-clamp-2">{{ $project->location }}</p>
                                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center text-white bg-accent-600 hover:bg-accent-700 px-6 py-2 rounded-lg transition-colors text-sm font-medium">
                                    İncele
                                </a>
                            </div>
                        </div>
                        
                        <!-- Vertical Text for collapsed state -->
                        <div class="absolute bottom-8 left-8 origin-bottom-left -rotate-90 group-hover:opacity-0 transition-opacity duration-300 md:block hidden">
                            <span class="text-xl font-display font-bold text-white/50 tracking-wider whitespace-nowrap">{{ Str::limit($project->getTranslatedTitle(), 20) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partners Section (Grayscale to Color) -->
    @if($partners->count() > 0)
    <section class="py-16 border-b border-primary-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-primary-500 text-sm font-semibold uppercase tracking-widest mb-10">Güçlü İş Ortakları</p>
             <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20 opacity-70">
                @foreach($partners as $partner)
                    <img src="{{ $partner->getLogoUrl() }}" alt="{{ $partner->name }}" class="h-12 w-auto grayscale hover:grayscale-0 transition-all duration-500 hover:scale-110 cursor-pointer">
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-accent-600/5"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-accent-500/10 rounded-full blur-[128px]"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-5xl md:text-7xl font-display font-bold text-white mb-8">PROJENİZİ <span class="text-accent-500">GÜÇLENDİRELİM</span></h2>
            <p class="text-xl text-primary-300 mb-12 max-w-2xl mx-auto font-light">
                Zorlu zemin koşullarında güvenli ve ekonomik çözümler sunuyoruz. Uzman kadromuzla hemen iletişime geçin.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('contact') }}" class="group relative px-8 py-4 bg-accent-500 text-white font-bold rounded-xl overflow-hidden shadow-[0_0_40px_-10px_rgba(245,158,11,0.5)] hover:shadow-[0_0_60px_-10px_rgba(245,158,11,0.7)] transition-shadow">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="relative flex items-center">
                        TEKLİF ALIN
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </span>
                </a>
                <a href="tel:05070093060" class="px-8 py-4 border border-primary-700 text-white font-medium rounded-xl hover:bg-primary-800 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    0 507 009 30 60
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }
</style>
@endsection
