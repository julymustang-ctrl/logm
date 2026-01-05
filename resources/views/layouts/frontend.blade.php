<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('meta_title', 'LOG Makine A.Ş. | Zemin Güçlendirme ve Mühendislik')</title>
    <meta name="description" content="@yield('meta_description', 'LOG Makine A.Ş. - Fore kazık, iksa sistemleri, zemin güçlendirme ve mühendislik hizmetleri')">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('head')
    
    {{-- Google Analytics 4 --}}
    @php
        $gaId = \App\Models\Setting::where('key', 'ga_measurement_id')->value('value');
    @endphp
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}');
    </script>
    @endif
</head>
<body class="bg-primary-950 text-gray-200 font-body antialiased relative selection:bg-accent-500 selection:text-white"
      x-data="{ 
          mobileMenuOpen: false,
          scrolled: false,
          init() {
              window.addEventListener('scroll', () => {
                  this.scrolled = window.scrollY > 50;
              });
          }
      }">
    <!-- Global Noise Texture -->
    <div class="fixed inset-0 pointer-events-none z-0 bg-noise mix-blend-overlay opacity-20"></div>
    
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
            :class="scrolled ? 'glass shadow-lg py-2' : 'bg-transparent py-4'"
            x-init="scrolled = window.scrollY > 50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="LOG Makine" 
                         class="h-12 transition-transform duration-300 group-hover:scale-105"
                         :class="scrolled ? '' : 'brightness-0 invert'">
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" 
                       class="font-medium transition-all duration-300 link-underline {{ request()->routeIs('home') ? 'text-accent-500' : '' }}"
                       :class="scrolled ? 'text-primary-700 hover:text-accent-500' : 'text-white hover:text-accent-400'">
                        Anasayfa
                    </a>
                    <a href="{{ route('about') }}" 
                       class="font-medium transition-all duration-300 link-underline {{ request()->routeIs('about') ? 'text-accent-500' : '' }}"
                       :class="scrolled ? 'text-primary-700 hover:text-accent-500' : 'text-white hover:text-accent-400'">
                        Hakkımızda
                    </a>
                    <a href="{{ route('projects') }}" 
                       class="font-medium transition-all duration-300 link-underline {{ request()->routeIs('projects*') ? 'text-accent-500' : '' }}"
                       :class="scrolled ? 'text-primary-700 hover:text-accent-500' : 'text-white hover:text-accent-400'">
                        Projeler
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="font-medium transition-all duration-300 link-underline {{ request()->routeIs('contact') ? 'text-accent-500' : '' }}"
                       :class="scrolled ? 'text-primary-700 hover:text-accent-500' : 'text-white hover:text-accent-400'">
                        İletişim
                    </a>
                </nav>

                <!-- CTA Button -->
                <div class="hidden lg:flex items-center">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        Teklif Alın
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="lg:hidden p-2 transition-colors"
                        :class="scrolled ? 'text-primary-700' : 'text-white'">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             x-cloak
             class="lg:hidden glass border-t border-gray-100/20">
            <nav class="px-4 py-4 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-primary-700 hover:bg-accent-50 hover:text-accent-600 transition">Anasayfa</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-primary-700 hover:bg-accent-50 hover:text-accent-600 transition">Hakkımızda</a>
                <a href="{{ route('projects') }}" class="block px-4 py-3 rounded-lg text-primary-700 hover:bg-accent-50 hover:text-accent-600 transition">Projeler</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg text-primary-700 hover:bg-accent-50 hover:text-accent-600 transition">İletişim</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 mt-2 btn-primary text-center">
                    Teklif Alın
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="gradient-dark text-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent-500/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-accent-500/5 rounded-full translate-x-1/2 translate-y-1/2"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <img src="{{ asset('images/logo1.png') }}" alt="LOG Makine" class="h-12 mb-6">
                    <p class="text-primary-300 mb-6 max-w-md leading-relaxed">
                        LOG Makine A.Ş., zemin güçlendirme ve mühendislik alanında uzman kadrosuyla Türkiye genelinde hizmet vermektedir.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-primary-700/50 rounded-lg flex items-center justify-center hover:bg-accent-500 hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-primary-700/50 rounded-lg flex items-center justify-center hover:bg-accent-500 hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-primary-700/50 rounded-lg flex items-center justify-center hover:bg-accent-500 hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Hızlı Linkler</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-primary-300 hover:text-accent-400 transition-colors link-underline">Anasayfa</a></li>
                        <li><a href="{{ route('about') }}" class="text-primary-300 hover:text-accent-400 transition-colors link-underline">Hakkımızda</a></li>
                        <li><a href="{{ route('projects') }}" class="text-primary-300 hover:text-accent-400 transition-colors link-underline">Projeler</a></li>
                        <li><a href="{{ route('contact') }}" class="text-primary-300 hover:text-accent-400 transition-colors link-underline">İletişim</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">İletişim</h4>
                    <ul class="space-y-4 text-primary-300">
                        <li class="flex items-start group">
                            <svg class="w-5 h-5 mr-3 mt-0.5 text-accent-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="leading-relaxed">Beyaz Evler Mah. 80016 SK. NO: 4/20<br>Çukurova / Adana</span>
                        </li>
                        <li class="flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-accent-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:05070093060" class="hover:text-accent-400 transition-colors">0 507 009 30 60</a>
                        </li>
                        <li class="flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-accent-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:info@logas.com.tr" class="hover:text-accent-400 transition-colors">info@logas.com.tr</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-primary-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-primary-400">
                    <p>© {{ date('Y') }} LOG Makine A.Ş. Tüm hakları saklıdır.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="{{ route('page.show', 'kvkk') }}" class="hover:text-accent-400 transition-colors">KVKK</a>
                        <a href="#" class="hover:text-accent-400 transition-colors">Çerez Politikası</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
