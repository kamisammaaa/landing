@props(['announcement'])

@php
    // Definisikan konfigurasi warna secara eksplisit agar aman dari pembersihan (purging) Tailwind
    $typeConfig = [
        'info'    => ['bg' => 'bg-blue-50',    'border' => 'border-blue-200',   'text' => 'text-blue-900',   'subtext' => 'text-blue-700',   'icon' => 'text-blue-500'],
        'warning' => ['bg' => 'bg-yellow-50',  'border' => 'border-yellow-200', 'text' => 'text-yellow-900', 'subtext' => 'text-yellow-700', 'icon' => 'text-yellow-600'],
        'success' => ['bg' => 'bg-green-50',   'border' => 'border-green-200',  'text' => 'text-green-900',  'subtext' => 'text-green-700',  'icon' => 'text-green-600'],
        'danger'  => ['bg' => 'bg-red-50',     'border' => 'border-red-200',    'text' => 'text-red-900',    'subtext' => 'text-red-700',    'icon' => 'text-red-600'],
    ];

    $currentType = $announcement->tipe ?? 'info';
    $config = $typeConfig[$currentType] ?? $typeConfig['info'];
@endphp

<div class="relative overflow-hidden transition-all duration-300" 
     x-data="{ show: true }"
     x-show="show"
     x-cloak
     role="alert">
    
    <div class="{{ $config['bg'] }} border-b {{ $config['border'] }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-start gap-3">
                
                {{-- Bagian Kiri: Icon --}}
                <div class="flex-shrink-0 mt-0.5">
                    @if($currentType === 'warning')
                        <svg class="w-5 h-5 {{ $config['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    @elseif($currentType === 'success')
                        <svg class="w-5 h-5 {{ $config['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @elseif($currentType === 'danger')
                        <svg class="w-5 h-5 {{ $config['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5 {{ $config['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>
                
                {{-- Bagian Tengah: Konten Teks --}}
                <div class="flex-1 min-w-0">
                    @if(!empty($announcement->target_url))
                        <a href="{{ $announcement->target_url }}" class="block group focus:outline-none">
                            <p class="text-sm font-semibold {{ $config['text'] }} group-hover:underline decoration-2">
                                {{ $announcement->judul }}
                            </p>
                            <div class="text-sm {{ $config['subtext'] }} mt-0.5 leading-relaxed dynamic-content">
                                {!! $announcement->isi !!}
                            </div>
                        </a>
                    @else
                        <div>
                            <p class="text-sm font-semibold {{ $config['text'] }}">
                                {{ $announcement->judul }}
                            </p>
                            <div class="text-sm {{ $config['subtext'] }} mt-0.5 leading-relaxed dynamic-content">
                                {!! $announcement->isi !!}
                            </div>
                        </div>
                    @endif
                </div>
                
                {{-- Bagian Kanan: Tombol Tutup --}}
                <div class="flex-shrink-0 ml-2">
                    <button @click="show = false" 
                            type="button"
                            class="p-1 rounded-lg {{ $config['subtext'] }} hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-current transition-all"
                            aria-label="Tutup pengumuman">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>