@extends('layouts.app')

@section('content')

{{-- ========================================================= --}}
{{-- PAGE HEADER --}}
{{-- ========================================================= --}}
<section class="relative overflow-hidden border-b border-white/5 bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] py-16 text-white">

    {{-- Background Glow --}}
    <div class="pointer-events-none absolute top-0 right-1/4 h-80 w-80 rounded-full bg-crypto-accent/10 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 left-0 h-72 w-72 rounded-full bg-crypto-success/5 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">

            {{-- Breadcrumb --}}
            <div class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="transition hover:text-white">
                    Home
                </a>

                <span>/</span>

                <span class="text-crypto-success">
                    Berita
                </span>
            </div>

            <h1 class="mb-4 text-4xl font-extrabold tracking-tight lg:text-5xl">
                <span class="gradient-text">
                    Berita & Kegiatan
                </span>
            </h1>

            <p class="mx-auto max-w-2xl text-lg leading-relaxed text-gray-400 lg:text-xl">
                Update terbaru seputar akademik, kegiatan sekolah, prestasi siswa,
                teknologi, dan perkembangan digital SMK Banjar Asri.
            </p>

        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- FILTER & SEARCH --}}
{{-- ========================================================= --}}
<section class="border-b border-white/5 bg-crypto-dark py-6">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-5 px-4 sm:px-6 lg:flex-row lg:px-8">

        {{-- Categories --}}
        <div class="flex flex-wrap justify-center gap-2 lg:justify-start">

            {{-- Semua --}}
            <a href="{{ route('berita.index') }}"
               class="rounded-xl px-4 py-2 text-sm font-semibold transition-all duration-200
               {{ !request('kategori')
                    ? 'bg-crypto-success text-crypto-dark shadow-lg shadow-crypto-success/20'
                    : 'border border-white/5 bg-crypto-card text-gray-400 hover:border-white/10 hover:text-white'
               }}">
                Semua
            </a>

            {{-- Dynamic Categories --}}
            @foreach(['akademik', 'ekstrakurikuler', 'prestasi', 'pengumuman'] as $kat)

                <a href="{{ route('berita.index', ['kategori' => $kat]) }}"
                   class="rounded-xl px-4 py-2 text-sm font-semibold transition-all duration-200
                   {{ request('kategori') === $kat
                        ? 'bg-crypto-accent text-white shadow-lg shadow-crypto-accent/20'
                        : 'border border-white/5 bg-crypto-card text-gray-400 hover:border-white/10 hover:text-white'
                   }}">

                    {{ ucfirst($kat) }}

                </a>

            @endforeach

        </div>

        {{-- Search --}}
        <form action="{{ route('berita.index') }}"
              method="GET"
              class="relative w-full sm:w-72">

            @if(request('kategori'))
                <input type="hidden"
                       name="kategori"
                       value="{{ request('kategori') }}">
            @endif

            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari berita..."
                   class="w-full rounded-xl border border-white/10 bg-crypto-card py-3 pr-4 pl-11 text-sm text-white placeholder-gray-500 transition-all focus:border-crypto-accent focus:ring-1 focus:ring-crypto-accent focus:outline-none">

            <button type="submit"
                    class="absolute top-3 left-3 text-gray-500 transition hover:text-crypto-success">

                <svg class="h-5 w-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />

                </svg>

            </button>
        </form>

    </div>
</section>

{{-- ========================================================= --}}
{{-- POSTS SECTION --}}
{{-- ========================================================= --}}
<section class="bg-crypto-dark py-16 text-white">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        @if(isset($posts) && $posts->count())

            @php
                $firstPost = $posts->first();
                $showFeatured = $firstPost->is_featured
                                && !request('kategori')
                                && !request('q');
            @endphp

            {{-- ========================================================= --}}
            {{-- FEATURED POST --}}
            {{-- ========================================================= --}}
            @if($showFeatured)

                <article class="group mb-14 overflow-hidden rounded-3xl border border-white/5 bg-crypto-card transition-all duration-300 hover:border-white/10 hover:shadow-2xl hover:shadow-black/30">

                    <div class="grid lg:grid-cols-2">

                        {{-- Image --}}
                        <div class="relative h-72 overflow-hidden lg:h-full">

                            @if($firstPost->gambar_cover)

                                <img
                                    src="{{ asset('storage/' . $firstPost->gambar_cover) }}"
                                    alt="{{ $firstPost->judul }}"
                                    class="h-full w-full object-cover opacity-80 transition duration-500 group-hover:scale-105 group-hover:opacity-100"
                                >

                            @else

                                <div class="flex h-full items-center justify-center bg-gradient-to-br from-crypto-accent/30 to-primary-900">

                                    <svg class="h-20 w-20 text-white/20"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />

                                    </svg>

                                </div>

                            @endif

                            {{-- Badge --}}
                            <div class="absolute top-5 left-5">
                                <span class="rounded-xl bg-crypto-success px-4 py-1.5 text-xs font-bold tracking-wide text-crypto-dark shadow-lg shadow-crypto-success/20">
                                    Featured News
                                </span>
                            </div>

                        </div>

                        {{-- Content --}}
                        <div class="flex flex-col justify-center p-8 lg:p-10">

                            {{-- Category --}}
                            <div class="mb-4">

                                <span class="inline-flex rounded-lg bg-crypto-accent/20 px-3 py-1 text-xs font-semibold tracking-wide text-primary-200">

                                    {{ ucfirst($firstPost->kategori ?? 'Akademik') }}

                                </span>

                            </div>

                            {{-- Title --}}
                            <h2 class="mb-4 text-3xl font-extrabold leading-tight tracking-tight">

                                <a href="{{ route('berita.show', $firstPost->slug) }}"
                                   class="transition-colors hover:text-crypto-success">

                                    {{ $firstPost->judul }}

                                </a>

                            </h2>

                            {{-- Excerpt --}}
                            <p class="mb-6 line-clamp-4 leading-relaxed text-gray-400">

                                {!! Str::limit(strip_tags($firstPost->konten), 240) !!}

                            </p>

                            {{-- Meta --}}
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">

                                <span>
                                    {{ $firstPost->published_at
                                        ? \Carbon\Carbon::parse($firstPost->published_at)->format('d M Y')
                                        : now()->format('d M Y') }}
                                </span>

                                <span>•</span>

                                <span>
                                    {{ number_format($firstPost->views ?? 0) }} views
                                </span>

                            </div>

                        </div>

                    </div>

                </article>

            @endif

            {{-- ========================================================= --}}
            {{-- POSTS GRID --}}
            {{-- ========================================================= --}}
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

                @foreach($showFeatured ? $posts->skip(1) : $posts as $post)

                    @include('components.post-card', ['post' => $post])

                @endforeach

            </div>

            {{-- ========================================================= --}}
            {{-- PAGINATION --}}
            {{-- ========================================================= --}}
            <div class="mt-14 flex justify-center">

                {{ $posts->withQueryString()->links() }}

            </div>

        @else

            {{-- ========================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ========================================================= --}}
            <div class="rounded-3xl border border-white/5 bg-crypto-card py-20 text-center">

                <svg class="mx-auto mb-5 h-20 w-20 text-gray-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />

                </svg>

                <h3 class="mb-2 text-xl font-bold text-white">
                    Belum Ada Berita
                </h3>

                <p class="mx-auto max-w-md text-gray-500">
                    Berita yang Anda cari belum tersedia atau belum dipublikasikan.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection

@push('styles')
<style>

/* ========================================================= */
/* PAGINATION DARK THEME */
/* ========================================================= */

.pagination{
    display:flex;
    gap:8px;
    justify-content:center;
    align-items:center;
    flex-wrap:wrap;
}

.pagination a,
.pagination span{
    padding:10px 16px;
    border-radius:12px;
    border:1px solid rgba(255,255,255,.05);
    background:#181a20;
    color:#94a3b8;
    text-decoration:none;
    font-size:.875rem;
    font-weight:600;
    transition:all .2s ease;
}

.pagination a:hover{
    background:#7000ff;
    border-color:#7000ff;
    color:white;
    transform:translateY(-1px);
}

.pagination .active span{
    background:#0ecb81;
    border-color:#0ecb81;
    color:#0b0e11;
}

.pagination svg{
    width:18px;
    height:18px;
}

</style>
@endpush