<?php

namespace Database\Seeders;

use App\Models\PortalLink;
use Illuminate\Database\Seeder;

class PortalLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'nama' => 'E-Learning',
                'url' => 'https://learning.smkba.sch.id',
                'deskripsi' => 'Platform pembelajaran online untuk siswa dan guru.',
                'icon' => 'heroicon-o-academic-cap',
                'status' => 'active',
                'is_visible' => true,
                'urutan' => 1,
            ],
            [
                'nama' => 'Sistem PKL',
                'url' => 'https://pkl.smkba.sch.id',
                'deskripsi' => 'Manajemen Praktik Kerja Lapangan dan pembimbing.',
                'icon' => 'heroicon-o-briefcase',
                'status' => 'active',
                'is_visible' => true,
                'urutan' => 2,
            ],
            [
                'nama' => 'Ujian Pintar',
                'url' => 'https://upin.smkba.sch.id',
                'deskripsi' => 'Aplikasi Ujian Berbasis Komputer (CBT) Online.',
                'icon' => 'heroicon-o-pencil-square',
                'status' => 'active',
                'is_visible' => true,
                'urutan' => 3,
            ],
            [
                'nama' => 'E-Produktif',
                'url' => 'https://produktif.smkba.sch.id',
                'deskripsi' => 'Layanan pembelajaran produktif dan penilaian kompetensi.',
                'icon' => 'heroicon-o-cpu-chip',
                'status' => 'active',
                'is_visible' => true,
                'urutan' => 4,
            ],
        ];

        foreach ($links as $link) {
            PortalLink::updateOrCreate(
                ['nama' => $link['nama']],
                $link
            );
        }

        $this->command->info('✅ PortalLinkSeeder completed! 4 sistem terintegrasi.');
    }
}