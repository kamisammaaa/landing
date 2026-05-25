@props(['gallery'])

@php
    $isImage = ($gallery->file_type ?? 'image') === 'image';
    $filePath = $gallery->file_path ?? null;
    $assetPath = $filePath ? asset('storage/' . $filePath) : null;
    $judulGaleri = $gallery->judul ?? 'Dokumentasi Kegiatan';
@endphp

<div class="group relative overflow-hidden rounded-xl bg-gray-100 aspect-video cursor-pointer border border-gray-200/50 shadow-sm" 
     x-data="{ open: false }"
     @click="open = true">
    
    @if($isImage)
        @if($assetPath)
            <img src="{{ $assetPath }}" 
                 alt="{{ $judulGaleri }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
        @endif
        
        {{-- Fallback jika gambar rusak/tidak ada --}}
        <div class="{{ $assetPath ? 'hidden' : '' }} absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
            <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    @else
        {{-- Video Thumbnail / Cover --}}
        <div class="absolute inset-0 bg-gray-900 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-950 opacity-90"></div>
            <div class="z-10 w-14 h-14 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 transition-all duration-300 shadow-lg">
                <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </div>
        </div>
        
        {{-- Durasi / Indikator Video Pojok Atas --}}
        <div class="absolute top-3 right-3 px-2 py-1 bg-black/60 backdrop-blur-sm rounded-md flex items-center gap-1.5 z-10 text-[10px] font-bold text-white uppercase tracking-wider">
            <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
            Video
        </div>
    @endif
    
    {{-- Info Overlay saat Hover --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-4">
        <h4 class="text-white font-bold text-sm line-clamp-2">{{ $judulGaleri }}</h4>
        @if(isset($gallery->jurusan->nama))
            <p class="text-blue-300 text-xs mt-1 font-medium tracking-wide uppercase">{{ $gallery->jurusan->nama }}</p>
        @endif
    </div>

    {{-- Lightbox Modal (Dilempar ke penutup <body> agar z-index tidak terganggu grid) --}}
    <template x-teleport="body">
        <div x-show="open" 
             x-cloak
             @keydown.window.escape="open = false"
             class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-black/95 backdrop-blur-md p-4"
             style="display: none;">
            
            {{-- Tombol Tutup --}}
            <button class="absolute top-4 right-4 w-12 h-12 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-colors border border-white/10" 
                    @click.stop="open = false"
                    type="button"
                    aria-label="Tutup Galeri">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            {{-- Wadah Konten Utama --}}
            <div class="max-w-5xl w-full flex flex-col items-center" @click.stop>
                @if($isImage)
                    <img src="{{ $assetPath }}" 
                         alt="{{ $judulGaleri }}"
                         class="max-h-[75vh] max-w-full object-contain rounded-lg shadow-2xl border border-white/5">
                @else
                    <div class="w-full max-w-3xl aspect-video rounded-xl overflow-hidden bg-black border border-white/10 shadow-2xl">
                        <video class="w-full h-full" 
                               controls 
                               x-init="$watch('open', value => { if(!value) $el.pause() })"
                               src="{{ $assetPath }}">
                            Browsermu tidak mendukung pemutaran video HTML5.
                        </video>
                    </div>
                @endif
                
                {{-- Keterangan Teks Bawah --}}
                <div class="mt-5 text-center max-w-2xl px-4">
                    <h3 class="text-white font-bold text-lg leading-snug">{{ $judulGaleri }}</h3>
                    @if(isset($gallery->deskripsi) && $gallery->deskripsi)
                        <p class="text-gray-400 text-sm mt-2 leading-relaxed">
                            {{ strip_tags($gallery->deskripsi) }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>