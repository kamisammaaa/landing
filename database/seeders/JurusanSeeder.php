<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use Illuminate\Support\Str;

class JurusanSeeder extends Seeder
{
    /**
     * Seed the 3 kompetensi keahlian SMK Banjar Asri
     */
    public function run(): void
    {
        $jurusans = [
            [
                'kode' => 'TJKT',
                'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'slug' => 'teknik-jaringan-komputer-telekomunikasi',
                'deskripsi' => '<p><strong>Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</strong> mempersiapkan siswa untuk merancang, menginstalasi, dan memelihara infrastruktur jaringan komputer dan sistem telekomunikasi digital.</p><p>Materi pembelajaran mencakup: routing & switching (Cisco/Mikrotik), server administration, fiber optic, wireless network, network security, dan cloud computing basics.</p><p>Dengan pendekatan praktik 70%, siswa siap bekerja di ISP, data center, atau melanjutkan ke perguruan tinggi.</p>',
                'fasilitas' => json_encode([
                    'Lab Jaringan Cisco Packet Tracer',
                    'Mikrotik Academy Certified',
                    'Server Room dengan Virtualization',
                    'Fiber Optic Splicing Kit',
                    'Wireless & IoT Development Board'
                ]),
                'prospek_kerja' => json_encode([
                    'Network Engineer',
                    'System Administrator', 
                    'Telecom Technician',
                    'Cloud Support Specialist',
                    'IT Infrastructure Consultant',
                    'Wirausaha ISP Lokal'
                ]),
                'kurikulum_unggulan' => json_encode([
                    'CCNA Exploration (Cisco)',
                    'MTCNA Certification (Mikrotik)',
                    'Fiber Optic Technician',
                    'Linux Server Administration',
                    'Network Security Basics'
                ]),
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'kode' => 'TKR',
                'nama' => 'Teknik Kendaraan Ringan',
                'slug' => 'teknik-kendaraan-ringan',
                'deskripsi' => '<p><strong>Teknik Kendaraan Ringan (TKR)</strong> fokus pada perawatan, perbaikan, dan diagnosa kendaraan ringan bermesin bensin maupun diesel dengan teknologi terkini.</p><p>Siswa mempelajari: engine system, chassis & suspension, automotive electrical, fuel injection, hybrid technology, dan diagnostic tools.</p><p>Kerjasama dengan industri otomotif memberikan kesempatan PKL dan penyerapan kerja yang tinggi.</p>',
                'fasilitas' => json_encode([
                    'Bengkel Otomotif Standar Industri',
                    'Engine Test Bed & Chassis Trainer',
                    'Diagnostic Scanner (Bosch/Snap-on)',
                    'Automotive Electrical Lab',
                    'Hybrid Vehicle Training Unit'
                ]),
                'prospek_kerja' => json_encode([
                    'Mekanik Profesional',
                    'Service Advisor',
                    'Quality Control Automotive',
                    'Technical Trainer',
                    'Wirausaha Bengkel',
                    'Dealer Technician'
                ]),
                'kurikulum_unggulan' => json_encode([
                    'TOYOTA T-TEP Program',
                    'Astra Honda Training',
                    'Bosch Diagnostic Certification',
                    'Hybrid Vehicle Basics',
                    'Automotive Electrical Specialist'
                ]),
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'kode' => 'TAV',
                'nama' => 'Teknik Audio Video',
                'slug' => 'teknik-audio-video',
                'deskripsi' => '<p><strong>Teknik Audio Video (TAV)</strong> menguasai teknik instalasi, perawatan, dan produksi peralatan audio video, broadcast, dan sistem multimedia.</p><p>Kompetensi yang dipelajari: electronic fundamentals, audio engineering, video production, broadcast equipment, home theater installation, dan digital content creation.</p><p>Lulusan siap bekerja di industri media, entertainment, atau mengembangkan usaha di bidang audio video.</p>',
                'fasilitas' => json_encode([
                    'Studio Recording & Mixing',
                    'Lab Elektronika & Circuit Design',
                    'Broadcast Equipment (Camera, Switcher)',
                    'Home Theater Installation Lab',
                    'Video Editing Suite (Adobe/Premiere)'
                ]),
                'prospek_kerja' => json_encode([
                    'Audio Engineer',
                    'Video Editor / Producer',
                    'Broadcast Technician',
                    'Home Theater Installer',
                    'Multimedia Specialist',
                    'Event Sound & Light Technician'
                ]),
                'kurikulum_unggulan' => json_encode([
                    'Sony Professional Training',
                    'Broadcast Production Basics',
                    'Audio Mixing & Mastering',
                    'Video Editing Professional',
                    'Live Sound Engineering'
                ]),
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($jurusans as $data) {
            Jurusan::updateOrCreate(
                ['kode' => $data['kode']],
                [
                    'nama' => $data['nama'],
                    'slug' => $data['slug'],
                    'deskripsi' => $data['deskripsi'],
                    'fasilitas' => $data['fasilitas'],
                    'prospek_kerja' => $data['prospek_kerja'],
                    'kurikulum_unggulan' => $data['kurikulum_unggulan'] ?: '',
                    'urutan' => $data['urutan'],
                    'is_active' => $data['is_active'],
                ]
            );
        }
    }
}