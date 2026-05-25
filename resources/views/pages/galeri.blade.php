@extends('layouts.app')

@section('content')
{{-- Page Header (Crypto Dark Theme) --}}
<section class="bg-gradient-to-br from-[#07090e] via-crypto-dark to-[#120a21] text-white py-16 relative border-b border-white/5">
    <div class="absolute top-0 left-1/3 w-80 h-80 bg-crypto-accent/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold mb-4 tracking-tight">
                <span class="gradient-text">Galeri Kegiatan</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Dokumentasi momen berkesan, ekosistem digital, dan prestasi teknologi SMK Banjar Asri
            </p>
        </div>
    </div>
</section>

{{-- Filter Kategori (Crypto Token Style) --}}
<section class="py-6 bg-crypto-dark border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-2">
            <a href="{{ route('galeri') }}" 
               class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ request('kategori') ? 'bg-crypto-card text-gray-400 hover:text-white border border-white/5' : 'bg-crypto-success text-crypto-dark shadow-lg shadow-crypto-success/20' }}">
                Semua
            </a>
            
            @foreach(['akademik', 'ekstrakurikuler', 'prestasi', 'fasilitas'] as $kat)
                <a href="{{ route('galeri', ['kategori' => $kat]) }}" 
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ request('kategori') === $kat ? 'bg-crypto-accent text-white shadow-lg shadow-crypto-accent/20' : 'bg-crypto-card text-gray-400 hover:text-white border border-white/5 hover:border-white/10' }}">
                    {{ ucfirst($kat) }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Gallery Grid (Crypto Dark Layout) --}}
<section class="py-16 bg-crypto-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Pembungkus Grid Utama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galleries ?? [] as $gallery)
                @include('components.gallery-item', ['gallery' => $gallery])
            @empty
                {{-- Placeholder / Skeleton Loading ala Web3 Apps --}}
                @for($i = 0; $i < 12; $i++)
                    <div class="group relative overflow-hidden rounded-xl bg-crypto-card aspect-video border border-white/5 shadow-sm animate-pulse">
                        <div class="absolute inset-0 bg-gradient-to-br from-crypto-card to-[#1f222b] flex items-center justify-center">
                            <svg class="w-10 h-10 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
        
        {{-- Pagination --}}
        @if(isset($galleries) && $galleries->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $galleries->withQueryString()->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<style>
/* Style Pagination Menyesuaikan Dashboard Crypto */
.pagination { display: flex; gap: 6px; justify-content: center; }
.pagination a, .pagination span { padding: 8px 14px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.05); background: #181a20; color: #94a3b8; text-decoration: none; font-size: 0.875rem; font-weight: 600; transition: all 0.2s; }
.pagination a:hover { background: #7000ff; color: white; border-color: #7000ff; }
.pagination .active { background: #0ecb81; color: #0b0e11; border-color: #0ecb81; }
</style>
@endpush