@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<section class="bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] text-white overflow-hidden relative border-b border-white/5">
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-crypto-accent/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-crypto-success/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Hero Text --}}
            <div class="space-y-6 text-center lg:text-left">
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    <span class="gradient-text">SMK BANJAR ASRI</span>
                </h1>

                <p class="text-lg lg:text-xl text-gray-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Mencetak Generasi Kompeten, Berkarakter, dan Siap Kerja di Era Digital
                </p>

                <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-2">

                    {{-- Portal --}}
                    <a href="{{ route('portal') }}"
                       class="px-8 py-3.5 bg-crypto-success text-crypto-dark font-bold rounded-xl hover:bg-[#0bc17b] transition-all shadow-lg shadow-crypto-success/20 hover:shadow-crypto-success/30 hover:-translate-y-0.5 duration-200">
                        Akses Sistem
                    </a>

                    {{-- FIXED --}}
                    <a href="{{ route('jurusan.index') }}"
                       class="px-8 py-3.5 border-2 border-white/10 text-white font-semibold rounded-xl bg-white/5 hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                        Lihat Jurusan
                    </a>

                </div>
            </div>

            {{-- Hero Stats --}}
            <div class="hidden lg:block relative">
                <div class="absolute inset-0 bg-gradient-to-r from-crypto-accent/20 to-primary-500/10 rounded-3xl blur-2xl"></div>

                <div class="relative bg-crypto-card/60 backdrop-blur-md rounded-3xl p-8 border border-white/10 shadow-2xl">

                    <div class="grid grid-cols-2 gap-4">

                        {{-- Statistik --}}
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/5 card-hover">
                            <div class="text-3xl font-extrabold tracking-tight text-white">
                                {{ $activeJurusan->count() }}
                            </div>
                            <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">
                                Kompetensi
                            </div>
                        </div>

                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/5 card-hover">
                            <div class="text-3xl font-extrabold tracking-tight text-white">
                                500+
                            </div>
                            <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">
                                Siswa Aktif
                            </div>
                        </div>

                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/5 card-hover">
                            <div class="text-3xl font-extrabold tracking-tight text-white">
                                50+
                            </div>
                            <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">
                                Guru & Staf
                            </div>
                        </div>

                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/5 card-hover">
                            <div class="text-3xl font-extrabold tracking-tight text-white">
                                100+
                            </div>
                            <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">
                                Alumni
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Portal Section --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-3 tracking-tight">
                Sistem Terintegrasi
            </h2>

            <p class="text-gray-400 max-w-2xl mx-auto">
                Akses platform pembelajaran dan administrasi digital SMK Banjar Asri
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($portalLinks as $link)
                @include('components.portal-card', ['link' => $link])
            @endforeach
        </div>

    </div>
</section>

{{-- Jurusan --}}
<section class="py-16 bg-crypto-card text-white border-y border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-3 tracking-tight">
                Kompetensi Keahlian
            </h2>

            <p class="text-gray-400 max-w-2xl mx-auto">
                Pilih jurusan sesuai minat dan bakat Anda
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($activeJurusan as $jurusan)
                @include('components.jurusan-card', ['jurusan' => $jurusan])
            @endforeach
        </div>

        <div class="text-center mt-10">
            {{-- FIXED --}}
            <a href="{{ route('jurusan.index') }}"
               class="inline-flex items-center px-6 py-3 bg-crypto-accent text-white font-semibold rounded-xl hover:bg-primary-600 shadow-lg shadow-crypto-accent/20 transition-all duration-200">
                Lihat Semua Jurusan
            </a>
        </div>

    </div>
</section>

{{-- Berita --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-end mb-12">

            <div>
                <h2 class="text-3xl font-bold text-white mb-3 tracking-tight">
                    Berita & Kegiatan
                </h2>

                <p class="text-gray-400">
                    Update terbaru dari SMK Banjar Asri
                </p>
            </div>

            {{-- FIXED --}}
            <a href="{{ route('berita.index') }}"
               class="hidden sm:inline-flex items-center text-crypto-success hover:text-white font-semibold group transition-colors">
                Lihat Semua
            </a>

        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($featuredPosts as $post)
                @include('components.post-card', ['post' => $post])
            @empty
                <div class="col-span-full text-center text-gray-400">
                    Belum ada berita tersedia.
                </div>
            @endforelse

        </div>

        <div class="text-center mt-10 sm:hidden">
            {{-- FIXED --}}
            <a href="{{ route('berita.index') }}"
               class="inline-flex justify-center w-full px-6 py-3 bg-crypto-accent text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                Lihat Semua Berita
            </a>
        </div>

    </div>
</section>

{{-- Galeri --}}
<section class="py-16 bg-crypto-card text-white border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-3 tracking-tight">
                Galeri Kegiatan
            </h2>

            <p class="text-gray-400">
                Dokumentasi aktivitas dan prestasi sekolah
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

            @forelse($latestGallery as $gallery)
                @include('components.gallery-item', ['gallery' => $gallery])
            @empty
                <div class="col-span-full text-center text-gray-400">
                    Belum ada galeri tersedia.
                </div>
            @endforelse

        </div>

        <div class="text-center mt-10">
            <a href="{{ route('galeri') }}"
               class="inline-flex items-center px-6 py-3 border-2 border-white/10 text-white font-semibold rounded-xl bg-white/5 hover:bg-white/10 hover:border-white/20 transition-all duration-200">
                Lihat Semua Galeri
            </a>
        </div>

    </div>
</section>
@endsection