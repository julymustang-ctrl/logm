@extends('layouts.frontend')

@section('meta_title', 'İletişim | LOG Makine A.Ş.')

@section('content')
<!-- Page Header -->
<section class="gradient-hero text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-64 h-64 bg-accent-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4 animate-fade-in">İletişim</h1>
        <nav class="text-primary-300 animate-fade-in delay-100">
            <a href="{{ route('home') }}" class="hover:text-white transition">Anasayfa</a>
            <span class="mx-2">/</span>
            <span class="text-accent-400">İletişim</span>
        </nav>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16">
            <!-- Contact Info -->
            <div>
                <h2 class="text-2xl font-bold text-primary-800 mb-8">Bize Ulaşın</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start group">
                        <div class="w-14 h-14 bg-gradient-to-br from-accent-100 to-accent-50 rounded-xl flex items-center justify-center flex-shrink-0 mr-4 group-hover:from-accent-500 group-hover:to-accent-400 transition-all duration-300">
                            <svg class="w-6 h-6 text-accent-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-800 mb-1">Adres</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $settings['address'] ?? 'Beyaz Evler Mah. 80016 SK. NO: 4/20 Çukurova / Adana' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="w-14 h-14 bg-gradient-to-br from-accent-100 to-accent-50 rounded-xl flex items-center justify-center flex-shrink-0 mr-4 group-hover:from-accent-500 group-hover:to-accent-400 transition-all duration-300">
                            <svg class="w-6 h-6 text-accent-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-800 mb-1">Telefon</h3>
                            <a href="tel:{{ $settings['phone'] ?? '05070093060' }}" class="text-gray-600 hover:text-accent-600 transition">
                                {{ $settings['phone'] ?? '0 507 009 30 60' }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="w-14 h-14 bg-gradient-to-br from-accent-100 to-accent-50 rounded-xl flex items-center justify-center flex-shrink-0 mr-4 group-hover:from-accent-500 group-hover:to-accent-400 transition-all duration-300">
                            <svg class="w-6 h-6 text-accent-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary-800 mb-1">E-posta</h3>
                            <a href="mailto:{{ $settings['email'] ?? 'info@logas.com.tr' }}" class="text-gray-600 hover:text-accent-600 transition">
                                {{ $settings['email'] ?? 'info@logas.com.tr' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="mt-10">
                    <div class="aspect-video rounded-2xl overflow-hidden bg-gray-200 shadow-lg">
                        @if(!empty($settings['maps_embed']))
                            {!! $settings['maps_embed'] !!}
                        @else
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3185.5!2d35.3!3d36.99!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzbCsDU5JzI0LjAiTiAzNcKwMTgnMDAuMCJF!5e0!3m2!1str!2str!4v1" 
                                class="w-full h-full" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"></iframe>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <h2 class="text-2xl font-bold text-primary-800 mb-8">Mesaj Gönderin</h2>
                
                <div x-data="contactForm()" class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <!-- Success Message -->
                    <div x-show="success" x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span x-text="message"></span>
                    </div>

                    <!-- Error Message -->
                    <div x-show="error" x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span x-text="message"></span>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad *</label>
                                <input type="text" x-model="form.name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition"
                                       :class="{'border-red-300': errors.name}">
                                <p x-show="errors.name" class="text-red-500 text-sm mt-1" x-text="errors.name"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                                <input type="tel" x-model="form.phone"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">E-posta *</label>
                            <input type="email" x-model="form.email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition"
                                   :class="{'border-red-300': errors.email}">
                            <p x-show="errors.email" class="text-red-500 text-sm mt-1" x-text="errors.email"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konu *</label>
                            <input type="text" x-model="form.subject" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition"
                                   :class="{'border-red-300': errors.subject}">
                            <p x-show="errors.subject" class="text-red-500 text-sm mt-1" x-text="errors.subject"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mesajınız *</label>
                            <textarea x-model="form.message" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition resize-none"
                                      :class="{'border-red-300': errors.message}"></textarea>
                            <p x-show="errors.message" class="text-red-500 text-sm mt-1" x-text="errors.message"></p>
                        </div>

                        <button type="submit" 
                                :disabled="loading"
                                class="w-full btn-primary py-4 text-lg flex items-center justify-center group disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-show="!loading">
                                Mesajı Gönder
                                <svg class="w-5 h-5 ml-2 inline group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </span>
                            <span x-show="loading" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Gönderiliyor...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function contactForm() {
    return {
        form: {
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: ''
        },
        errors: {},
        loading: false,
        success: false,
        error: false,
        message: '',
        
        async submit() {
            this.loading = true;
            this.success = false;
            this.error = false;
            this.errors = {};
            
            try {
                const response = await fetch('{{ route("contact.submit") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.form)
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    this.success = true;
                    this.message = data.message;
                    this.form = { name: '', email: '', phone: '', subject: '', message: '' };
                } else if (response.status === 422) {
                    // Validation errors
                    this.errors = data.errors || {};
                    this.error = true;
                    this.message = 'Lütfen formu doğru şekilde doldurun.';
                } else {
                    this.error = true;
                    this.message = data.message || 'Bir hata oluştu. Lütfen tekrar deneyin.';
                }
            } catch (e) {
                this.error = true;
                this.message = 'Bağlantı hatası. Lütfen tekrar deneyin.';
            }
            
            this.loading = false;
        }
    }
}
</script>
@endpush
