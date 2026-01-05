<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@logas.com.tr',
            'password' => Hash::make('password'),
        ]);

        // Seed settings
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'LOG Makine A.Ş.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Zemin güçlendirme ve mühendislik hizmetleri', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'logo', 'value' => 'images/logo.png', 'type' => 'image', 'group' => 'general'],
            ['key' => 'logo_white', 'value' => 'images/logo1.png', 'type' => 'image', 'group' => 'general'],
            
            // Contact
            ['key' => 'phone', 'value' => '0 507 009 30 60', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@logas.com.tr', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Beyaz Evler Mah. 80016 SK. NO: 4/20 Çukurova / Adana', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'maps_embed', 'value' => '', 'type' => 'textarea', 'group' => 'contact'],
            
            // Social
            ['key' => 'facebook', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter', 'value' => '', 'type' => 'text', 'group' => 'social'],
            
            // Footer
            ['key' => 'footer_text', 'value' => '© 2024 LOG Makine A.Ş. Tüm hakları saklıdır.', 'type' => 'textarea', 'group' => 'footer'],
            ['key' => 'kvkk_text', 'value' => '', 'type' => 'textarea', 'group' => 'footer'],
            ['key' => 'cookie_text', 'value' => '', 'type' => 'textarea', 'group' => 'footer'],
            
            // Analytics
            ['key' => 'ga_measurement_id', 'value' => '', 'type' => 'text', 'group' => 'analytics'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        // Seed pages
        $pages = [
            [
                'slug' => 'hakkimizda',
                'title' => ['tr' => 'Hakkımızda', 'en' => 'About Us'],
                'content' => ['tr' => '<p>LOG Makine A.Ş. hakkında bilgiler...</p>', 'en' => '<p>About LOG Makine A.Ş....</p>'],
                'meta_title' => ['tr' => 'Hakkımızda | LOG Makine', 'en' => 'About Us | LOG Makine'],
                'meta_description' => ['tr' => 'LOG Makine A.Ş. kurumsal bilgileri', 'en' => 'LOG Makine A.Ş. corporate information'],
            ],
            [
                'slug' => 'vizyon-misyon',
                'title' => ['tr' => 'Vizyon & Misyon', 'en' => 'Vision & Mission'],
                'content' => ['tr' => '<p>Vizyonumuz ve misyonumuz...</p>', 'en' => '<p>Our vision and mission...</p>'],
                'meta_title' => ['tr' => 'Vizyon & Misyon | LOG Makine', 'en' => 'Vision & Mission | LOG Makine'],
                'meta_description' => ['tr' => 'LOG Makine vizyon ve misyon', 'en' => 'LOG Makine vision and mission'],
            ],
            [
                'slug' => 'kvkk',
                'title' => ['tr' => 'KVKK Aydınlatma Metni', 'en' => 'GDPR Privacy Policy'],
                'content' => ['tr' => '<p>KVKK metni...</p>', 'en' => '<p>Privacy policy...</p>'],
                'meta_title' => ['tr' => 'KVKK | LOG Makine', 'en' => 'Privacy | LOG Makine'],
                'meta_description' => ['tr' => 'KVKK aydınlatma metni', 'en' => 'Privacy policy'],
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }

        // Seed services
        $services = [
            [
                'slug' => 'fore-kazik',
                'name' => ['tr' => 'Fore Kazık', 'en' => 'Bored Pile'],
                'description' => ['tr' => 'Fore kazık imalatı ve uygulamaları', 'en' => 'Bored pile manufacturing and applications'],
                'icon' => 'building',
                'sort_order' => 1,
            ],
            [
                'slug' => 'iksa-sistemleri',
                'name' => ['tr' => 'İksa Sistemleri', 'en' => 'Shoring Systems'],
                'description' => ['tr' => 'İksa sistemleri tasarım ve uygulama', 'en' => 'Shoring systems design and application'],
                'icon' => 'shield',
                'sort_order' => 2,
            ],
            [
                'slug' => 'zemin-guclendirme',
                'name' => ['tr' => 'Zemin Güçlendirme', 'en' => 'Ground Improvement'],
                'description' => ['tr' => 'Zemin güçlendirme ve iyileştirme çözümleri', 'en' => 'Ground improvement solutions'],
                'icon' => 'layers',
                'sort_order' => 3,
            ],
            [
                'slug' => 'ankraj',
                'name' => ['tr' => 'Ankraj', 'en' => 'Anchoring'],
                'description' => ['tr' => 'Ankraj sistemleri ve uygulamaları', 'en' => 'Anchoring systems and applications'],
                'icon' => 'anchor',
                'sort_order' => 4,
            ],
            [
                'slug' => 'jet-grout',
                'name' => ['tr' => 'Jet Grout', 'en' => 'Jet Grouting'],
                'description' => ['tr' => 'Jet grout uygulamaları', 'en' => 'Jet grouting applications'],
                'icon' => 'droplet',
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
