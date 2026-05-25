<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // ─────────────────────────────────────────────────────
            // GROUP: GENERAL (Identitas Sekolah)
            // ─────────────────────────────────────────────────────
            [
                'key' => 'school_name',
                'group' => 'general',
                'value' => 'SMK BANJAR ASRI',
                'type' => 'text',
                'description' => 'Nama resmi sekolah',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'school_short_name',
                'group' => 'general',
                'value' => 'SMKBA',
                'type' => 'text',
                'description' => 'Singkatan nama sekolah',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'school_address',
                'group' => 'general',
                'value' => 'Jl. Gunung Puntang Km.01 Cimaung Kab. Bandung - Jawa Barat',
                'type' => 'textarea',
                'description' => 'Alamat lengkap sekolah',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'school_postal_code',
                'group' => 'general',
                'value' => '40374',
                'type' => 'text',
                'description' => 'Kode pos',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'school_logo',
                'group' => 'general',
                'value' => null,
                'type' => 'image',
                'description' => 'Logo sekolah (format PNG/SVG, maks 2MB)',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'school_favicon',
                'group' => 'general',
                'value' => null,
                'type' => 'image',
                'description' => 'Favicon website (format ICO/PNG, 32x32px)',
                'order' => 6,
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────
            // GROUP: CONTACT (Kontak & Komunikasi)
            // ─────────────────────────────────────────────────────
            [
                'key' => 'phone',
                'group' => 'contact',
                'value' => '(022) 1234-5678',
                'type' => 'text',
                'description' => 'Nomor telepon sekolah',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'whatsapp',
                'group' => 'contact',
                'value' => '6281234567890',
                'type' => 'text',
                'description' => 'Nomor WhatsApp (format: 628xxx)',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'email',
                'group' => 'contact',
                'value' => 'info@smkba.sch.id',
                'type' => 'text',
                'description' => 'Email resmi sekolah',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'website',
                'group' => 'contact',
                'value' => 'https://smkba.sch.id',
                'type' => 'text',
                'description' => 'URL website utama',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'office_hours',
                'group' => 'contact',
                'value' => 'Senin - Jumat: 07:00 - 15:00 WIB',
                'type' => 'text',
                'description' => 'Jam operasional kantor',
                'order' => 5,
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────
            // GROUP: SOCIAL (Media Sosial)
            // ─────────────────────────────────────────────────────
            [
                'key' => 'facebook_url',
                'group' => 'social',
                'value' => 'https://facebook.com/smktanjarasri',
                'type' => 'text',
                'description' => 'URL Facebook sekolah',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'instagram_url',
                'group' => 'social',
                'value' => 'https://instagram.com/smktanjarasri',
                'type' => 'text',
                'description' => 'URL Instagram sekolah',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'youtube_url',
                'group' => 'social',
                'value' => 'https://youtube.com/@smktanjarasri',
                'type' => 'text',
                'description' => 'URL YouTube sekolah',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'tiktok_url',
                'group' => 'social',
                'value' => '',
                'type' => 'text',
                'description' => 'URL TikTok sekolah (opsional)',
                'order' => 4,
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────
            // GROUP: SEO (Search Engine Optimization)
            // ─────────────────────────────────────────────────────
            [
                'key' => 'meta_title',
                'group' => 'seo',
                'value' => 'SMK Banjar Asri - Sekolah Kejuruan Unggulan di Cimaung',
                'type' => 'text',
                'description' => 'Meta title untuk SEO (maks 60 karakter)',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'meta_description',
                'group' => 'seo',
                'value' => 'SMK Banjar Asri - Mencetak generasi kompeten, berkarakter, dan siap kerja di era digital. Jurusan: TJKT, TKR, TAV.',
                'type' => 'textarea',
                'description' => 'Meta description untuk SEO (maks 160 karakter)',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'meta_keywords',
                'group' => 'seo',
                'value' => 'SMK Banjar Asri, SMK Cimaung, TJKT, TKR, TAV, sekolah kejuruan Bandung',
                'type' => 'textarea',
                'description' => 'Keywords untuk SEO (pisahkan dengan koma)',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'google_analytics_id',
                'group' => 'seo',
                'value' => '',
                'type' => 'text',
                'description' => 'Google Analytics Tracking ID (contoh: G-XXXXXXXXXX)',
                'order' => 4,
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────
            // GROUP: BRANDING (Visi & Misi)
            // ─────────────────────────────────────────────────────

            // ─────────────────────────────────────────────────────
// GROUP: BRANDING (Tambahkan ini)
// ─────────────────────────────────────────────────────
[
    'key' => 'school_logo',
    'group' => 'branding',
    'value' => null,
    'type' => 'image',
    'description' => 'Logo utama sekolah (PNG/SVG transparan, maks 500KB)',
    'order' => 4,
    'is_active' => true,
],
[
    'key' => 'school_logo_dark',
    'group' => 'branding',
    'value' => null,
    'type' => 'image',
    'description' => 'Logo versi dark mode (opsional, untuk navbar gelap)',
    'order' => 5,
    'is_active' => true,
],
[
    'key' => 'school_logo_text',
    'group' => 'branding',
    'value' => 'SMK BANJAR ASRI',
    'type' => 'text',
    'description' => 'Teks fallback jika logo belum diupload',
    'order' => 6,
    'is_active' => true,
],
            [
                'key' => 'vision',
                'group' => 'branding',
                'value' => 'Menjadi SMK Unggulan yang Menghasilkan Lulusan Kompeten, Berkarakter, dan Berdaya Saing Global',
                'type' => 'textarea',
                'description' => 'Visi sekolah',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'mission',
                'group' => 'branding',
                'value' => "1. Menyelenggarakan pembelajaran berbasis kompetensi dan teknologi terkini\n2. Mengembangkan karakter siswa yang berakhlak mulia dan berintegritas\n3. Menjalin kemitraan strategis dengan dunia usaha dan industri\n4. Mendorong inovasi dan kewirausahaan di kalangan siswa",
                'type' => 'textarea',
                'description' => 'Misi sekolah (satu per baris)',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'motto',
                'group' => 'branding',
                'value' => 'Mencetak Generasi Kompeten, Berkarakter, dan Siap Kerja di Era Digital',
                'type' => 'text',
                'description' => 'Moto/slogan sekolah',
                'order' => 3,
                'is_active' => true,
            ],
        ]; // ← Tutup array $settings DI SINI

        // Loop insert/update data
        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('✅ SettingSeeder completed successfully!');
    }
}