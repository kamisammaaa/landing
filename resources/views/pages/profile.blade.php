@extends('layouts.app')

@section('content')
{{-- Page Header (Crypto Theme) --}}
<section class="bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] text-white py-16 relative border-b border-white/5">
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-crypto-accent/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold mb-4 tracking-tight">
                <span class="gradient-text">Profil Sekolah</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Mengenal lebih dekat {{ $school_name ?? 'SMK Banjar Asri' }}: Manifesto, Arsitektur Visi, dan Komitmen Transparansi Vokasi
            </p>
        </div>
    </div>
</section>

{{-- Content Grid (Crypto Theme) --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            
            {{-- Main Content Column --}}
            <div class="lg:col-span-2 space-y-12">
                
                {{-- Sejarah Singkat --}}
                <div class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-12 bg-crypto-accent"></div>
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Sejarah Singkat</h2>
                    <div class="text-gray-400 space-y-4 leading-relaxed text-sm md:text-base">
                        <p>
                            {{ $school_name ?? 'SMK Banjar Asri' }} diarsitekturi atas komitmen penuh mendirikan inkubator edukasi produktif untuk membentuk generasi muda terampil yang tangguh, berintegritas tinggi, serta adaptif terhadap dinamika ekspansi ekosistem teknologi digital global.
                        </p>
                        <p>
                            Didukung infrastruktur modern terstandarisasi dan dewan pengajar bersertifikasi pakar, orientasi kurikulum dikembangkan secara berkala guna menyelaraskan kompetensi teknikal serta ketahanan *soft skills* riil sesuai standar integrasi kualifikasi Mitra Dunia Usaha dan Dunia Industri (DUDI).
                        </p>
                    </div>
                </div>
                
                {{-- Visi Misi --}}
                <div class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-12 bg-crypto-success"></div>
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Visi & Misi</h2>
                    
                    {{-- Visi Statement --}}
                    <div class="mb-8">
                        <h3 class="font-bold text-crypto-accent mb-3 flex items-center gap-2 text-sm uppercase tracking-wider">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Core Vision
                        </h3>
                        <div class="text-gray-200 italic border-l-2 border-crypto-accent pl-4 py-3 bg-white/[0.02] rounded-r border-t border-b border-r border-white/5">
                            "Menjadi Pusat Pendidikan Vokasi Unggulan yang Menghasilkan Lulusan Berkompetensi Tinggi, Berintegritas Karakter, dan Berdaya Saing Kompetitif di Pasar Global."
                        </div>
                    </div>
                    
                    {{-- Misi List --}}
                    <div>
                        <h3 class="font-bold text-crypto-success mb-4 flex items-center gap-2 text-sm uppercase tracking-wider">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Operational Mission
                        </h3>
                        <ul class="space-y-4 text-gray-300 text-sm md:text-base">
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 bg-crypto-accent/10 text-crypto-accent border border-crypto-accent/20 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-bold mt-0.5">01</span>
                                <span>Menyelenggarakan tata kelola pembelajaran berbasis kompetensi riil dan pemanfaatan perangkat teknologi mutakhir yang tersinkronisasi industri.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 bg-crypto-success/10 text-crypto-success border border-crypto-success/20 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-bold mt-0.5">02</span>
                                <span>Menanamkan pondasi moralitas siswa yang beretika mulia, berdisiplin tinggi, akuntabel, dan bertanggung jawab secara profesional.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 bg-crypto-accent/10 text-crypto-accent border border-crypto-accent/20 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-bold mt-0.5">03</span>
                                <span>Membangun jalinan kemitraan strategis multilateral dengan konsorsium industri, korporasi nasional, serta lembaga riset lintas batas.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 bg-crypto-success/10 text-crypto-success border border-crypto-success/20 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-bold mt-0.5">04</span>
                                <span>Menumbuhkan kultur riset aplikatif, inovasi kreatif, dan mentalitas kewirausahaan tangguh di lingkungan civitas akademika.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                {{-- Struktur Organisasi Placeholder --}}
                <div class="bg-crypto-card rounded-2xl p-8 border border-white/5 shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">Struktur Organisasi</h2>
                    <div class="text-center">
                        <div class="bg-[#14161d] rounded-2xl border border-white/5 p-8 w-full">
                            <svg class="w-20 h-20 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-gray-400 font-semibold tracking-wide text-sm md:text-base">Matriks Kepengurusan Resmi</p>
                            <p class="text-xs text-gray-500 mt-2 max-w-sm mx-auto">Skema bagan tata pamong sekolah sedang mengalami penyesuaian struktural periodik oleh sistem administrator pusat.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Sidebar Column --}}
            <div class="space-y-6">
                
                {{-- Info Kontak Terminal --}}
                <div class="bg-crypto-card rounded-2xl p-6 border border-white/5 shadow-xl">
                    <h3 class="font-bold text-white mb-5 tracking-wide text-base border-b border-white/5 pb-3">Kontak Terminal</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-crypto-accent mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm text-gray-400 leading-relaxed">
                                {!! nl2br(e($school_address ?? 'Jl. Gunung Puntang Km.01 Cimaung Kab. Bandung')) !!}
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-crypto-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-sm text-gray-400 font-mono">{{ $school_phone ?? '(022) 1234-5678' }}</span>
                        </li>
                        <li class="flex items-center gap-3 border-t border-white/[0.03] pt-3 mt-2">
                            <svg class="w-5 h-5 text-crypto-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $school_email ?? 'info@smkba.sch.id' }}" class="text-sm text-crypto-accent hover:text-crypto-accent/80 hover:underline break-all transition-colors font-mono">
                                {{ $school_email ?? 'info@smkba.sch.id' }}
                            </a>
                        </li>
                    </ul>
                </div>
                
                {{-- Akreditasi Badge --}}
                <div class="bg-crypto-card rounded-2xl p-6 border border-white/5 shadow-xl relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-crypto-success/5 rounded-full blur-xl pointer-events-none"></div>
                    <h3 class="font-bold text-white mb-4 tracking-wide text-base">Sertifikasi Hub</h3>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-crypto-success/10 border border-crypto-success/20 rounded-xl flex items-center justify-center flex-shrink-0 shadow-inner">
                            <span class="text-2xl font-extrabold text-crypto-success tracking-tighter">A</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-200 text-sm">Terakreditasi Peringkat A</p>
                            <p class="text-xs text-gray-500 mt-0.5">Badan Akreditasi Nasional (BAN-PDM)</p>
                        </div>
                    </div>
                </div>
                
                {{-- Social Terminal Links --}}
                <div class="bg-crypto-card rounded-2xl p-6 border border-white/5 shadow-xl">
                    <h3 class="font-bold text-white mb-4 tracking-wide text-base">Jaringan Publik</h3>
                    <div class="flex space-x-3">
                        <a href="#" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/5 hover:border-crypto-accent/30 flex items-center justify-center text-gray-400 hover:text-white transition-all" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/5 hover:border-crypto-accent/30 flex items-center justify-center text-gray-400 hover:text-white transition-all" aria-label="Twitter / X">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/5 hover:border-crypto-accent/30 flex items-center justify-center text-gray-400 hover:text-white transition-all" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection