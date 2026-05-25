@extends('layouts.app')

@section('content')
{{-- Page Header (Crypto Theme) --}}
<section class="bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] text-white py-16 relative border-b border-white/5">
    <div class="absolute top-0 right-1/3 w-80 h-80 bg-crypto-success/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold mb-4 tracking-tight">
                <span class="gradient-text">Portal Sistem Digital</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Akses seluruh ekosistem platform pembelajaran terdesentralisasi dan administrasi pintar SMK Banjar Asri
            </p>
        </div>
    </div>
</section>

{{-- Portal Cards (Crypto Theme) --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">
            @forelse($links ?? [] as $link)
                @include('components.portal-card', ['link' => $link])
            @empty
                {{-- Default Portal Cards Modifikasi Web3 / dApp Architecture --}}
                @php
                    $defaultLinks = [
                        ['nama' => 'E-Learning Network', 'url' => 'https://learning.smkba.sch.id', 'status' => 'active', 'deskripsi' => 'Platform distribusi materi, repositori instruksi pintar, dan evaluasi terkomputasi untuk menunjang kegiatan akademis terintegrasi.'],
                        ['nama' => 'Sistem Protokol PKL', 'url' => 'https://pkl.smkba.sch.id', 'status' => 'active', 'deskripsi' => 'Arsitektur manajemen Praktik Kerja Lapangan: pelacakan node industri, bimbingan berkala, dan pelaporan logbook digital.'],
                        ['nama' => 'Ujian Pintar (Upin Engine)', 'url' => 'https://upin.smkba.sch.id', 'status' => 'active', 'deskripsi' => 'Sistem evaluasi komprehensif berbasis bank soal teracak otomatis dengan penilaian instan (*auto-grading*) presisi.'],
                        ['nama' => 'E-Produktif Workspace', 'url' => 'https://produktif.smkba.sch.id', 'status' => 'active', 'deskripsi' => 'Repositori pembelajaran berbasis proyek digital, penyimpanan jobsheet interaktif, dan portofolio kompetensi siswa.'],
                    ];
                @endphp
                @foreach($defaultLinks as $linkData)
                    @include('components.portal-card', ['link' => (object)$linkData])
                @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- Help Section (Crypto Theme) --}}
<section class="py-16 bg-[#0c0e12] border-t border-b border-white/5 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-crypto-accent/5 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-2xl font-bold text-white mb-4">Mengalami Kendala Akses Node?</h2>
        <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
            Jika akun Anda mengalami masalah otentikasi login atau kegagalan sinkronisasi sistem, buka tiket bantuan dengan tim IT Support Hub.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6281234567890?text=Halo%20IT%20Support,%20saya%20mengalami%20kendala%20akses%20sistem" 
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center px-6 py-3 bg-crypto-success text-crypto-dark font-bold rounded-xl hover:bg-crypto-success/90 shadow-lg shadow-crypto-success/10 transition-all">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                WhatsApp Support Hub
            </a>
            <a href="mailto:support@smkba.sch.id" 
               class="inline-flex items-center px-6 py-3 border border-white/10 bg-crypto-card text-white font-semibold rounded-xl hover:bg-white/[0.05] transition-all">
                <svg class="w-5 h-5 mr-2 text-crypto-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Email Support Terminal
            </a>
        </div>
    </div>
</section>

{{-- FAQ Accordion (Crypto Theme) --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">Pertanyaan Umum (FAQ)</h2>
        
        <div class="space-y-4" x-data="{ active: null }">
            @foreach([
                ['q' => 'Bagaimana cara otentikasi kredensial ke dalam sistem?', 'a' => 'Gunakan kombinasi identitas user dan kunci pengaman (password) resmi yang diterbitkan oleh administrator pusat. Jika kehilangan akses, klik fitur pemulihan sandi atau hubungi support terminal.'],
                ['q' => 'Apakah infrastruktur ekosistem mendukung akses mobile device?', 'a' => 'Ya, seluruh ekosistem Dapp digital kami sepenuhnya responsif dan dioptimalkan untuk perangkat seluler Android, iOS, tablet, maupun workstation desktop.'],
                ['q' => 'Tindakan apa yang harus diambil jika portal mengalami kegagalan muat?', 'a' => 'Periksa latensi konektivitas jaringan internet Anda terlebih dahulu. Jika kendala berasal dari core-server, silakan pantau pembaruan status sistem melalui kanal IT support.'],
            ] as $faq)
                <div class="bg-crypto-card rounded-xl border border-white/5 overflow-hidden transition-all">
                    <button @click="active = (active === {{ $loop->index }} ? null : {{ $loop->index }})" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-white/[0.02] transition-colors focus:outline-none">
                        <span class="font-semibold text-gray-200 text-sm md:text-base">{{ $faq['q'] }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="{'rotate-180 text-crypto-accent': active === {{ $loop->index }}}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="active === {{ $loop->index }}" 
                         x-collapse 
                         class="px-6 pb-4 text-sm text-gray-400 border-t border-white/[0.02] pt-3 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection