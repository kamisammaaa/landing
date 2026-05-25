@extends('layouts.app')

@section('content')
{{-- Page Header (Crypto Theme) --}}
<section class="bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] text-white py-16 relative border-b border-white/5">
    <div class="absolute top-0 left-1/4 w-80 h-80 bg-crypto-accent/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold mb-4 tracking-tight">
                <span class="gradient-text">Kompetensi Keahlian</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Pilih ekosistem spesialisasi yang sesuai dengan minat, bakat, dan proyeksi karir digital Anda di masa depan
            </p>
        </div>
    </div>
</section>

{{-- Jurusan List (Crypto Theme) --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($jurusans ?? [] as $jurusan)
                @include('components.jurusan-card', ['jurusan' => $jurusan])
            @empty
                {{-- Default Content: 3 Jurusan SMK Banjar Asri dengan Struktur Web3 --}}
                @php
                    $defaultJurusans = [
                        [
                            'kode' => 'TJKT', 
                            'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi', 
                            'slug' => 'teknik-jaringan-komputer-telekomunikasi',
                            'deskripsi' => 'Mempelajari arsitektur infrastruktur jaringan, server terdesentralisasi, cloud computing, dan sistem transmisi data digital global.',
                            'fasilitas' => ['Lab Jaringan Cisco', 'Mikrotik Academy', 'Cyber Security Server', 'Fiber Optic Kit'], 
                            'prospek_kerja' => ['Network Infrastructure Engineer', 'Cloud Infrastructure Specialist', 'System Architect', 'Security Analyst'],
                            'is_active' => true
                        ],
                        [
                            'kode' => 'TKR', 
                            'nama' => 'Teknik Kendaraan Ringan', 
                            'slug' => 'teknik-kendaraan-ringan',
                            'deskripsi' => 'Fokus pada diagnosa mekanikal pintar, sistem kelistrikan modular, dan rekayasa kendaraan modern bertenaga hybrid maupun konvensional.',
                            'fasilitas' => ['Bengkel Otomotif Digital', 'Engine Test Bed', 'Chassis Electrical Trainer', 'Diagnostic Scanner Pro'], 
                            'prospek_kerja' => ['Professional Diagnostic Mechanic', 'Service Consultant', 'Fleet Automation Supervisor', 'Automotive Entrepreneur'],
                            'is_active' => true
                        ],
                        [
                            'kode' => 'TAV', 
                            'nama' => 'Teknik Audio Video', 
                            'slug' => 'teknik-audio-video',
                            'deskripsi' => 'Menguasai pemrosesan sinyal frekuensi, teknik sirkuit mikroelektronika, sistem penyiaran digital, serta integrasi multimedia.',
                            'fasilitas' => ['Studio Recording & Podcast', 'Lab Mikroelektronika', 'Broadcast Production Kit', 'Acoustic Processing Lab'], 
                            'prospek_kerja' => ['Audio Signal Engineer', 'Hardware Circuit Designer', 'Broadcast Technologist', 'Multimedia Tech Specialist'],
                            'is_active' => true
                        ],
                    ];
                @endphp
                
                @foreach($defaultJurusans as $jurusanData)
                    @include('components.jurusan-card', ['jurusan' => (object)$jurusanData])
                @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- Comparison Table (Crypto Dasbor Style) --}}
<section class="py-16 bg-[#0c0e12] border-t border-b border-white/5 relative">
    <div class="absolute bottom-0 right-10 w-96 h-96 bg-crypto-success/5 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-3">Matriks Komparasi Kompetensi</h2>
            <p class="text-gray-400">Analisis parameter spesifikasi setiap program keahlian untuk akurasi minat Anda</p>
        </div>
        
        <div class="overflow-x-auto rounded-2xl border border-white/5 shadow-2xl">
            <table class="w-full bg-crypto-card text-white">
                <thead class="bg-[#181a20] border-b border-white/5 text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-sm tracking-wider">Parameter</th>
                        <th class="px-6 py-4 text-center font-semibold text-sm tracking-wider text-crypto-accent">TJKT</th>
                        <th class="px-6 py-4 text-center font-semibold text-sm tracking-wider text-crypto-success">TKR</th>
                        <th class="px-6 py-4 text-center font-semibold text-sm tracking-wider text-yellow-500">TAV</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-200 text-sm">Fokus Core</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Jaringan & Telekomunikasi</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Otomotif Kendaraan</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Audio Video & Broadcast</td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-200 text-sm">Arsitektur Skill</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Routing, Server Core, Fiber Optic</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Engine, Chassis, Intelligent System</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Micro Circuit, Broadcasting, Signal Processing</td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-200 text-sm">Sertifikasi Global</td>
                        <td class="px-6 py-4 text-center text-sm text-crypto-accent font-medium">MTCNA, CCNA, FO Installer</td>
                        <td class="px-6 py-4 text-center text-sm text-crypto-success font-medium">TOYOTA T-TEP, Astra Corp, Bosch</td>
                        <td class="px-6 py-4 text-center text-sm text-yellow-500 font-medium">Sony Pro, Panasonic Broadcast, LSP-1</td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-200 text-sm">Prospek Industri</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">ISP, Data Center, Telecommunication Provider</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">Authorized Dealer, Production Plant, Workshop Hub</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-400">TV/Radio Network, Production House, Micro Automation</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- CTA Section (Crypto Theme) --}}
<section class="py-16 bg-crypto-dark text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl font-extrabold text-white mb-4">Masih Bimbang Menentukan Sektor Karir?</h2>
        <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
            Buka saluran konsultasi dengan konselor karir kami atau jadwalkan tur ekosistem sekolah secara langsung untuk mengonfirmasi orientasi masa depan Anda.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            @php
                $whatsappNumber = isset($school_phone) ? preg_replace('/[^0-9]/', '', $school_phone) : '6281234567890';
                if (str_starts_with($whatsappNumber, '0')) {
                    $whatsappNumber = '62' . substr($whatsappNumber, 1);
                }
            @endphp
            <a href="https://wa.me/{{ $whatsappNumber }}?text=Halo%20SMK%20Banjar%20Asri,%20saya%20ingin%20konsultasi%20pemilihan%20jurusan" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex items-center px-6 py-3 bg-crypto-success text-crypto-dark font-bold rounded-xl hover:bg-crypto-success/90 shadow-lg shadow-crypto-success/20 transition-all">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                WhatsApp Konsultasi
            </a>
            <a href="{{ route('profile') }}" 
               class="inline-flex items-center px-6 py-3 border border-white/10 bg-crypto-card text-white font-semibold rounded-xl hover:bg-white/[0.05] transition-all">
                Profil Sekolah
            </a>
        </div>
    </div>
</section>
@endsection