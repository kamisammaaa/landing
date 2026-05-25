@extends('layouts.app')

@section('content')
@php
    // ========================================================================
    // HELPER: Parse string comma-separated atau JSON menjadi array
    // ========================================================================
    if (!function_exists('parseList')) {
        function parseList($value): array {
            if (empty($value)) return [];
            if (is_array($value)) return $value;
            
            // Coba decode JSON dulu
            $decoded = json_decode($value, true);
            if (is_array($decoded)) return $decoded;
            
            // Fallback: split by comma, trim, filter empty
            return array_values(array_filter(
                array_map('trim', explode(',', $value)),
                fn($v) => !empty($v)
            ));
        }
    }

    // Fallback data untuk testing/demo jika $jurusan null
    $jurusan = $jurusan ?? (object)[
        'kode' => 'TJKT', 
        'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi', 
        'slug' => 'teknik-jaringan-komputer-telekomunikasi',
        'deskripsi' => '<p><strong class="text-crypto-accent">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</strong> mempelajari instalasi, konfigurasi, dan maintenance infrastruktur jaringan komputer dan sistem telekomunikasi digital.</p><p class="mt-2">Siswa dibekali keterampilan routing & switching, server administration, fiber optic, wireless network, dan network security.</p>',
        'fasilitas' => 'Lab Jaringan Cisco, Mikrotik Academy, Server Room, Fiber Optic Kit, Wireless Lab',
        'prospek_kerja' => 'Network Engineer, System Administrator, Telecom Technician, Cloud Specialist, IT Consultant',
        'kurikulum_unggulan' => 'CCNA Exploration, MTCNA Certification, Fiber Optic Technician, Linux Server, Network Security',
        'gambar' => null, 
        'is_active' => true,
        'views' => 0,
    ];

    // Parse fields yang mungkin berupa string ke array
    $fasilitasList = parseList($jurusan->fasilitas ?? []);
    $prospekList = parseList($jurusan->prospek_kerja ?? []);
    $kurikulumList = parseList($jurusan->kurikulum_unggulan ?? []);
@endphp

{{-- Hero Section (Crypto Theme) --}}
<section class="bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] text-white py-20 relative border-b border-white/5">
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-crypto-accent/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="flex-1">
                <div class="inline-flex items-center px-4 py-2 bg-white/[0.03] border border-white/10 rounded-full mb-6">
                    <span class="gradient-text font-extrabold text-xl tracking-wider mr-3">{{ $jurusan->kode }}</span>
                    <span class="text-gray-400 text-sm border-l border-white/10 pl-3">Kompetensi Keahlian</span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold mb-6 tracking-tight leading-tight">
                    {{ $jurusan->nama }}
                </h1>
                <p class="text-base text-gray-400 mb-8 leading-relaxed max-w-2xl">
                    {{ strip_tags(Str::limit($jurusan->deskripsi, 200)) }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#kurikulum" class="px-6 py-3 bg-crypto-accent hover:bg-crypto-accent/90 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-crypto-accent/20">
                        Lihat Kurikulum
                    </a>
                    <a href="#kontak" class="px-6 py-3 bg-white/[0.03] border border-white/10 text-white font-semibold rounded-xl hover:bg-white/[0.08] transition-colors">
                        Hubungi Program
                    </a>
                </div>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-crypto-accent/20 to-purple-500/20 rounded-3xl blur-2xl"></div>
                    <div class="relative bg-crypto-card border border-white/10 rounded-3xl p-8 w-80 text-center shadow-2xl">
                        {{-- Icon: Network/Server untuk TJKT --}}
                        <svg class="w-20 h-20 mx-auto text-crypto-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                        </svg>
                        <div class="text-3xl font-extrabold text-white tracking-tight">3 Tahun</div>
                        <div class="text-gray-500 text-sm font-medium mt-1 uppercase tracking-wider">Durasi Pendidikan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Views Counter (Opsional) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <span>{{ number_format($jurusan->views ?? 0) }} kali dilihat</span>
        </div>
    </div>
</section>

{{-- Detail Content (Crypto Theme) --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-12">
                
                {{-- Deskripsi --}}
                <div id="deskripsi" class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-12 bg-crypto-accent"></div>
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Deskripsi Program</h2>
                    <div class="text-gray-400 space-y-4 leading-relaxed text-sm md:text-base prose prose-invert max-w-none">
                        {!! $jurusan->deskripsi !!}
                    </div>
                </div>
                
                {{-- Fasilitas --}}
                <div id="fasilitas" class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Fasilitas Pendukung</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse($fasilitasList as $fasilitas)
                            <div class="flex items-center gap-4 p-4 bg-[#14161d] border border-white/5 rounded-xl transition-all hover:border-white/10">
                                <div class="w-10 h-10 bg-crypto-accent/10 border border-crypto-accent/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-crypto-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-300 text-sm md:text-base">{{ $fasilitas }}</span>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-8 text-gray-500">
                                <p>Belum ada fasilitas yang ditambahkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                {{-- Kurikulum Unggulan --}}
                <div id="kurikulum" class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Kurikulum Unggulan</h2>
                    <div class="space-y-3">
                        @forelse($kurikulumList as $item)
                            <div class="flex items-center gap-3 p-3 bg-[#14161d] border border-white/5 rounded-lg">
                                <span class="w-6 h-6 bg-crypto-accent/20 text-crypto-accent rounded-full flex items-center justify-center text-xs font-bold">✓</span>
                                <span class="font-medium text-gray-300 text-sm">{{ $item }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Kurikulum disesuaikan dengan standar industri terkini.</p>
                        @endforelse
                    </div>
                </div>
                
                {{-- Prospek Kerja --}}
                <div id="prospek" class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Prospek Karir</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @forelse($prospekList as $prospek)
                            <span class="px-4 py-3 bg-[#14161d] border border-white/5 text-crypto-accent text-xs md:text-sm font-semibold rounded-xl text-center flex items-center justify-center tracking-wide hover:border-crypto-accent/30 transition-colors">
                                {{ $prospek }}
                            </span>
                        @empty
                            <span class="col-span-3 px-4 py-3 bg-[#14161d] border border-white/5 text-crypto-accent text-sm font-semibold rounded-xl text-center">Lulusan Siap Kerja di Industri</span>
                        @endforelse
                    </div>
                    <p class="mt-4 text-xs text-gray-500">
                        * Lulusan juga dapat melanjutkan ke perguruan tinggi melalui jalur prestasi, SBMPTN, atau mandiri.
                    </p>
                </div>
            </div>
            
            {{-- Sidebar --}}
            <div id="kontak" class="space-y-6">
                {{-- Quick Info Card --}}
                <div class="bg-crypto-card rounded-2xl p-6 border border-white/5 shadow-xl sticky top-24">
                    <h3 class="font-bold text-white mb-5 tracking-wide text-base border-b border-white/5 pb-3">Informasi Program</h3>
                    <ul class="space-y-5">
                        <li class="flex items-start gap-4">
                            <div class="p-2 bg-white/[0.02] border border-white/5 rounded-lg text-crypto-accent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Durasi</p>
                                <p class="font-semibold text-gray-200 text-sm mt-0.5">3 Tahun (6 Semester)</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="p-2 bg-white/[0.02] border border-white/5 rounded-lg text-crypto-accent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Gelar</p>
                                <p class="font-semibold text-gray-200 text-sm mt-0.5">SMK - Kompetensi Keahlian</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="p-2 bg-white/[0.02] border border-white/5 rounded-lg text-crypto-accent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Kuota Siswa</p>
                                <p class="font-semibold text-gray-200 text-sm mt-0.5">36 Siswa / Kelas</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="p-2 bg-white/[0.02] border border-white/5 rounded-lg text-crypto-accent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Sertifikasi</p>
                                <p class="font-semibold text-gray-200 text-sm mt-0.5">Industri & Kompetensi</p>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="mt-6 pt-6 border-t border-white/5">
                        @php
                            $waNumber = '6281234567890'; // Ganti dengan nomor WA resmi sekolah
                            $waText = urlencode("Halo SMK Banjar Asri, saya tertarik dengan jurusan {$jurusan->nama} ({$jurusan->kode}). Mohon informasi lebih lanjut.");
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full inline-flex justify-center items-center px-4 py-3 bg-white/[0.03] border border-white/10 hover:border-crypto-success/30 hover:text-crypto-success text-white font-semibold rounded-xl transition-all font-mono text-sm">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>
                
                {{-- Share Buttons (Opsional) --}}
                <div class="bg-crypto-card rounded-2xl p-6 border border-white/5 shadow-xl">
                    <h4 class="text-sm font-semibold text-gray-400 mb-3 uppercase tracking-wider">Bagikan Jurusan Ini</h4>
                    <div class="flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode($jurusan->nama . ' - SMK Banjar Asri: ' . route('jurusan.show', $jurusan->slug)) }}" 
                           target="_blank"
                           class="flex-1 px-3 py-2 bg-[#14161d] border border-white/5 rounded-lg text-center text-xs text-gray-400 hover:text-crypto-success hover:border-crypto-success/30 transition-colors">
                            WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('jurusan.show', $jurusan->slug)) }}" 
                           target="_blank"
                           class="flex-1 px-3 py-2 bg-[#14161d] border border-white/5 rounded-lg text-center text-xs text-gray-400 hover:text-blue-400 hover:border-blue-400/30 transition-colors">
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Jurusan --}}
<section class="py-16 bg-[#07090e] text-white border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-white mb-8 tracking-wide">Kompetensi Keahlian Lainnya</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @forelse($related ?? [] as $rel)
                @include('components.jurusan-card', ['jurusan' => $rel])
            @empty
                {{-- Fallback: Tampilkan 2 jurusan lainnya --}}
                @php
                    $allJurusans = [
                        ['kode' => 'TJKT', 'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi', 'slug' => 'teknik-jaringan-komputer-telekomunikasi'],
                        ['kode' => 'TKR', 'nama' => 'Teknik Kendaraan Ringan', 'slug' => 'teknik-kendaraan-ringan'],
                        ['kode' => 'TAV', 'nama' => 'Teknik Audio Video', 'slug' => 'teknik-audio-video'],
                    ];
                    $others = collect($allJurusans)->filter(fn($j) => $j['slug'] !== ($jurusan->slug ?? ''))->take(2);
                @endphp
                @foreach($others as $rel)
                    @include('components.jurusan-card', ['jurusan' => (object)[
                        'kode' => $rel['kode'],
                        'nama' => $rel['nama'],
                        'slug' => $rel['slug'],
                        'deskripsi' => '',
                        'gambar' => null,
                        'is_active' => true
                    ]])
                @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- Schema.org JSON-LD untuk SEO Jurusan --}}
@push('scripts')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "{{ $jurusan->nama }}",
  "description": "{{ strip_tags(Str::limit($jurusan->deskripsi, 160)) }}",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "{{ $school_name ?? 'SMK BANJAR ASRI' }}",
    "sameAs": "{{ config('app.url') }}"
  },
  "totalHistoricalEnrollment": 36,
  "educationalCredentialAwarded": "SMK - Kompetensi Keahlian",
  "coursePrerequisites": "Lulusan SMP/sederajat",
  "hasCourseInstance": {
    "@type": "CourseInstance",
    "courseMode": "On-campus",
    "courseSchedule": {
      "@type": "Schedule",
      "duration": "P3Y",
      "repeatFrequency": "R1/Y"
    }
  }
}
</script>
@endpush
@endsection