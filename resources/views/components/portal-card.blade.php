@props(['link'])

@php
    $status = $link->status ?? 'active';
    $isMaintenance = $status === 'maintenance' || $status === 'offline';
    $targetUrl = $isMaintenance ? '#' : ($link->url ?? '#');
    
    // Konfigurasi warna status yang bersih tanpa string concatenation yang rentan
    $statusStyles = [
        'active' => ['bg' => 'bg-emerald-50 border-emerald-200 text-emerald-700', 'dot' => 'bg-emerald-500', 'label' => 'Aktif'],
        'maintenance' => ['bg' => 'bg-amber-50 border-amber-200 text-amber-700', 'dot' => 'bg-amber-500', 'label' => 'Maintanance'],
        'offline' => ['bg' => 'bg-rose-50 border-rose-200 text-rose-700', 'dot' => 'bg-rose-500', 'label' => 'Offline'],
    ];

    $currentStyle = $statusStyles[$status] ?? $statusStyles['active'];
@endphp

<div x-data="{ 
        linkId: {{ $link->id ?? 'null' }},
        isMaintenance: {{ $isMaintenance ? 'true' : 'false' }},
        trackClick() {
            if (!this.linkId || this.isMaintenance) return;
            
            // Menggunakan beacon API agar data tetap terkirim walaupun tab berpindah/tertutup
            navigator.sendBeacon('/api/portal-click', JSON.stringify({
                _token: '{{ csrf_token() }}',
                link_id: this.linkId
            }));
        }
     }"
     class="h-full">
     
    <a href="{{ $targetUrl }}" 
       @click="trackClick()"
       class="flex flex-col h-full p-5 bg-white rounded-xl shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative"
       {{ !$isMaintenance ? 'target=_blank rel=noopener+noreferrer' : '' }}>
       
        {{-- Cegah klik jika sistem sedang dinonaktifkan --}}
        @if($isMaintenance)
            <div @click.prevent class="absolute inset-0 z-10 cursor-not-allowed" title="Layanan sedang tidak dapat diakses"></div>
        @endif

        <div class="flex items-start gap-4 flex-1">
            {{-- Bagian Ikon --}}
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300 text-white">
                    @if(isset($link->icon) && $link->icon)
                        <i class="{{ $link->icon }} text-lg"></i>
                    @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    @endif
                </div>
            </div>
            
            {{-- Bagian Informasi Konten --}}
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors text-base line-clamp-1">
                    {{ $link->nama ?? 'Nama Sistem' }}
                </h3>
                
                <p class="text-sm text-gray-500 mt-1 line-clamp-2 leading-relaxed">
                    {{ isset($link->deskripsi) && $link->deskripsi ? strip_tags($link->deskripsi) : 'Platform digital resmi penunjang kegiatan operasional dan ekosistem pendidikan.' }}
                </p>
            </div>
            
            {{-- Bagian Ikon Panah Penunjuk --}}
            <div class="flex-shrink-0 self-start pt-0.5">
                @if($isMaintenance)
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                @else
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                @endif
            </div>
        </div>
        
        {{-- Footer Kartu: Indikator Status & Host --}}
        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between gap-2 flex-wrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold border {{ $currentStyle['bg'] }}">
                <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $currentStyle['dot'] }} {{ $status === 'active' ? 'animate-pulse' : '' }}"></span>
                {{ $currentStyle['label'] }}
            </span>
            <span class="text-xs text-gray-400 font-medium truncate max-w-[180px] group-hover:text-gray-600 transition-colors">
                {{ parse_url($link->url ?? '#', PHP_URL_HOST) ?? 'sistem.internal' }}
            </span>
        </div>
    </a>
</div>