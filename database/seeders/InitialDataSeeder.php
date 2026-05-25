<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings Dasar Sekolah
        $settings = [
            ['key' => 'school_name', 'value' => 'SMK BANJAR ASRI', 'group' => 'general'],
            ['key' => 'school_address', 'value' => 'Jl. Gunung Puntang Km.01 Cimaung Kab. Bandung - Jawa Barat', 'group' => 'contact'],
            ['key' => 'school_phone', 'value' => '', 'group' => 'contact'],
            ['key' => 'school_email', 'value' => 'info@smkba.sch.id', 'group' => 'contact'],
            ['key' => 'meta_description', 'value' => 'Website resmi SMK Banjar Asri. Portal informasi akademik, jurusan, kegiatan, dan sistem pembelajaran terpadu.', 'group' => 'seo'],
            ['key' => 'maintenance_mode', 'value' => 'false', 'group' => 'system'],
        ];

        $now = Carbon::now();
        foreach ($settings as $s) {
            DB::table('settings')->insert(array_merge($s, ['created_at' => $now, 'updated_at' => $now]));
        }

        // 2. Portal Links (Subdomain)
        $links = [
            ['nama' => 'E-Learning', 'url' => 'https://learning.smkba.sch.id', 'status' => 'active', 'urutan' => 1],
            ['nama' => 'Sistem PKL', 'url' => 'https://pkl.smkba.sch.id', 'status' => 'active', 'urutan' => 2],
            ['nama' => 'Ujian Pintar', 'url' => 'https://upin.smkba.sch.id', 'status' => 'active', 'urutan' => 3],
            ['nama' => 'E-Produktif', 'url' => 'https://produktif.smkba.sch.id', 'status' => 'active', 'urutan' => 4],
        ];

        foreach ($links as $l) {
            DB::table('portal_links')->insert(array_merge($l, ['created_at' => $now, 'updated_at' => $now]));
        }

        // 3. Dummy Jurusan (bisa diedit via admin)
        $jurusans = [
            ['kode' => 'RPL', 'nama' => 'Rekayasa Perangkat Lunak', 'slug' => 'rekayasa-perangkat-lunak', 'fasilitas' => json_encode(['Lab Komputer', 'Server Lokal', 'Smart Classroom'])],
            ['kode' => 'TKJ', 'nama' => 'Teknik Komputer dan Jaringan', 'slug' => 'teknik-komputer-dan-jaringan', 'fasilitas' => json_encode(['Lab Jaringan', 'Mikrotik Academy', 'Fiber Optic Lab'])],
            ['kode' => 'DKV', 'nama' => 'Desain Komunikasi Visual', 'slug' => 'desain-komunikasi-visual', 'fasilitas' => json_encode(['Studio Multimedia', 'Printing Lab', 'Drawing Room'])],
        ];

        foreach ($jurusans as $j) {
            DB::table('jurusans')->insert(array_merge($j, ['is_active' => true, 'urutan' => 1, 'created_at' => $now, 'updated_at' => $now]));
        }
    }
}