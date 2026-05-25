@props(['jurusan'])

@php
    $slugUrl = route('jurusan.show', $jurusan->slug ?? 'rekayasa-perangkat-lunak');
    $isFasilitasArray = isset($jurusan->fasilitas) && (is_array($jurusan->fasilitas) || $jurusan->fasilitas instanceof \Illuminate\Support\Collection);
    $countFasilitas = $isFasilitasArray ? count($jurusan->fasilitas) : 0;
@endphp

<div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 group relative flex flex-col h-full">
    
    {{-- Tautan Utama Transparan (Membuat Seluruh Kartu Bisa Diklik) --}}
    <a href="{{ $slugUrl }}" class="absolute inset-0 z-20" aria-label="Detail Jurusan {{ $jurusan->nama ?? '' }}"></a>

    {{-- Bagian Atas: Gambar/Aksen Gradasi --}}
    <div class="h-44 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 flex items-center justify-center relative overflow-hidden flex-shrink-0">
        {{-- Pola Latar Belakang (Grid) --}}
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="card-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
                <rect width="100" height="100" fill="url(#card-grid)"/>
            </svg>
        </div>
        
        {{-- Ikon Jurusan --}}
        <div class="relative z-10 transform group-hover:scale-110 transition-transform duration-300 text-white/90">
            @if(isset($jurusan->icon))
                {{-- Mengakomodasi jika ada ikon kustom dari database --}}
                <i class="{{ $jurusan->icon }} text-5xl"></i>
            @else
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            @endif
        </div>
        
        {{-- Status Badges --}}
        <div class="absolute top-4 left-4 z-30">
            <span class="px-2.5 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-md tracking-wider uppercase">
                {{ $jurusan->kode ?? 'RPL' }}
            </span>
        </div>

        @if($jurusan->is_active ?? true)
            <div class="absolute top-4 right-4 px-2.5 py-1 bg-emerald-500/90 backdrop-blur-sm rounded-full z-30 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                <span class="text-[10px] font-extrabold text-white uppercase tracking-wider">Aktif</span>
            </div>
        @endif
    </div>
    
    {{-- Bagian Bawah: Konten Teks --}}
    <div class="p-5 flex flex-col flex-1 justify-between">
        <div>
            {{-- Nama Jurusan --}}
            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug">
                {{ $jurusan->nama ?? 'Rekayasa Perangkat Lunak' }}
            </h3>
            
            {{-- Deskripsi Singkat --}}
            <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                @if(isset($jurusan->deskripsi) && $jurusan->deskripsi)
                    {{ strip_tags($jurusan->deskripsi) }}
                @else
                    Program keahlian yang mempersiapkan siswa untuk menguasai kompetensi pengembangan perangkat lunak, aplikasi, dan pengelolaan basis data.
                @endif
            </p>
            
            {{-- Bagian Daftar Fasilitas --}}
            <div class="mb-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Fasilitas Unggulan
                </p>
                <div class="flex flex-wrap gap-1.5 relative z-30">
                    @if($countFasilitas > 0)
                        @foreach(array_slice($jurusan->fasilitas, 0, 2) as $fasilitas)
                            <span class="px-2.5 py-1 bg-gray-50 border border-gray-200/60 text-gray-600 text-xs rounded-lg font-medium">
                                {{ $fasilitas }}
                            </span>
                        @endforeach
                        @if($countFasilitas > 2)
                            <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 text-blue-600 text-xs rounded-lg font-semibold">
                                +{{ $countFasilitas - 2 }} Lainnya
                            </span>
                        @endif
                    @else
                        {{-- Standar Default jika array kosong --}}
                        <span class="px-2.5 py-1 bg-gray-50 border border-gray-200/60 text-gray-600 text-xs rounded-lg font-medium">Lab Praktik Komputer</span>
                        <span class="px-2.5 py-1 bg-gray-50 border border-gray-200/60 text-gray-600 text-xs rounded-lg font-medium">Modul Digital</span>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Tombol Aksi Semu (Penunjuk Arah Visual) --}}
        <div class="inline-flex items-center text-blue-600 font-bold text-sm tracking-wide mt-2">
            <span>Lihat Profil Jurusan</span> 
            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </div>
</div>