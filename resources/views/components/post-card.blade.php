@props(['post'])

@php
    $slugUrl = route('berita.show', $post->slug ?? 'sample-post');
    $coverPath = $post->gambar_cover ?? null;
    $assetCover = $coverPath ? asset('storage/' . $coverPath) : null;
    $judulBerita = $post->judul ?? 'Judul Berita Kegiatan Sekolah';
    
    // Pemetaan warna badge kategori agar Tailwind tidak melakukan 'purging'
    $kategoriConfig = [
        'akademik' => ['bg' => 'bg-blue-600', 'label' => 'Akademik'],
        'ekstrakurikuler' => ['bg' => 'bg-purple-600', 'label' => 'Ekstrakurikuler'],
        'prestasi' => ['bg' => 'bg-amber-500', 'label' => 'Prestasi'],
        'pengumuman' => ['bg' => 'bg-rose-600', 'label' => 'Pengumuman'],
    ];

    $kategoriKey = $post->kategori ?? 'akademik';
    $config = $kategoriConfig[$kategoriKey] ?? ['bg' => 'bg-blue-600', 'label' => ucfirst($kategoriKey)];
@endphp

<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 group relative flex flex-col h-full">
    
    {{-- Tautan Utama Transparan (Seluruh area kartu bisa diklik) --}}
    <a href="{{ $slugUrl }}" class="absolute inset-0 z-20" aria-label="Baca selengkapnya: {{ $judulBerita }}"></a>

    {{-- Bagian Atas: Gambar Cover --}}
    <div class="h-48 bg-gradient-to-br from-slate-700 via-slate-800 to-slate-950 relative overflow-hidden flex-shrink-0">
        @if($assetCover)
            <img src="{{ $assetCover }}" 
                 alt="{{ $judulBerita }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 relative z-10"
                 onerror="this.style.opacity='0'; this.nextElementSibling.classList.remove('hidden');">
        @endif
        
        {{-- Fallback Desain jika gambar cover kosong atau gagal dimuat --}}
        <div class="{{ $assetCover ? 'hidden' : '' }} absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-800 flex items-center justify-center">
            <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4-17l4 4m0 0l-4 4m4-4H13"/>
            </svg>
        </div>
        
        {{-- Overlay Gelap Bawah Gambar --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent z-10"></div>
        
        {{-- Lencana Kategori --}}
        <div class="absolute top-4 left-4 z-30">
            <span class="px-2.5 py-1 {{ $config['bg'] }} text-white text-[11px] font-extrabold uppercase tracking-wide rounded-md shadow-sm">
                {{ $config['label'] }}
            </span>
        </div>
        
        {{-- Lencana Unggulan (Featured) --}}
        @if($post->is_featured ?? false)
            <div class="absolute top-4 right-4 z-30">
                <span class="px-2.5 py-1 bg-white text-blue-700 text-[11px] font-extrabold uppercase tracking-wide rounded-md shadow-sm flex items-center gap-1 border border-blue-500/10">
                    <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Featured
                </span>
            </div>
        @endif
    </div>
    
    {{-- Bagian Bawah: Konten Teks --}}
    <div class="p-5 flex flex-col flex-1 justify-between">
        <div class="mb-4">
            {{-- Judul Berita --}}
            <h3 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors leading-snug">
                {{ $judulBerita }}
            </h3>
            
            {{-- Cuplikan / Excerpt Konten --}}
            <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                {{ isset($post->konten) ? Str::limit(strip_tags($post->konten), 130) : 'Deskripsi singkat dari berita atau kegiatan yang sedang berlangsung di sekolah. Informasi ini berisi update terbaru untuk para siswa dan guru.' }}
            </p>
        </div>
        
        {{-- Footer Kartu: Informasi Metadata --}}
        <div class="flex items-center justify-between pt-3 border-t border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3 text-xs text-gray-400 font-medium">
                {{-- Komponen Tanggal --}}
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ isset($post->published_at) ? (is_string($post->published_at) ? date('d M Y', strtotime($post->published_at)) : $post->published_at->format('d M Y')) : date('d M Y') }}
                </span>
                
                {{-- Komponen Total Pengunjung --}}
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    {{ number_format($post->views ?? 0) }}
                </span>
            </div>
            
            {{-- Foto Profil Singkat Penulis (Author) --}}
            @if(isset($post->author->name))
                <div class="relative z-30 flex items-center gap-1.5" title="Penulis: {{ $post->author->name }}">
                    <div class="w-5 h-5 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center shadow-sm">
                        <span class="text-[9px] text-white font-extrabold uppercase">{{ substr($post->author->name, 0, 1) }}</span>
                    </div>
                    <span class="text-[11px] font-semibold text-gray-500 max-w-[70px] truncate">{{ explode(' ', $post->author->name)[0] }}</span>
                </div>
            @endif
        </div>
    </div>
</article>