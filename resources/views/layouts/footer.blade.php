<footer class="bg-[#070b14] border-t border-gray-800/60 text-gray-400 relative overflow-hidden">

    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-2/3 h-32 bg-cyan-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-4 py-12 relative z-10">

        @php
            $settings = \App\Models\Setting::where('is_active', true)
                ->pluck('value', 'key');

            $logo = $settings['school_logo'] ?? null;
            $schoolName = $settings['school_name'] ?? 'SMK BANJAR ASRI';
            $schoolAddress = $settings['school_address'] ?? '-';
        @endphp

        <div class="grid md:grid-cols-4 gap-8">

            {{-- BRAND --}}
            <div class="md:col-span-2 space-y-4">

                <div class="flex items-center gap-3">
                    <x-school-logo class="h-10" />

                    <span class="text-white font-bold text-lg">
                        {{ $schoolName }}
                    </span>
                </div>

                <p class="text-sm text-gray-400">
                    {{ $schoolAddress }}
                </p>

            </div>

            {{-- NAV --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Navigasi</h4>

                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    @if(Route::has('profile')) <li><a href="{{ route('profile') }}">Profil</a></li> @endif
                    @if(Route::has('jurusan')) <li><a href="{{ route('jurusan') }}">Jurusan</a></li> @endif
                    @if(Route::has('berita')) <li><a href="{{ route('berita') }}">Berita</a></li> @endif
                    @if(Route::has('galeri')) <li><a href="{{ route('galeri') }}">Galeri</a></li> @endif
                </ul>
            </div>

            {{-- SYSTEM --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Sistem</h4>

                @php
                    $portalLinks = \App\Models\PortalLink::where('is_visible', true)
                        ->where('status', 'active')
                        ->orderBy('urutan')
                        ->limit(4)
                        ->get();
                @endphp

                <ul class="space-y-2 text-sm">
                    @forelse($portalLinks as $link)
                        <li><a href="{{ $link->url }}" target="_blank">{{ $link->nama }}</a></li>
                    @empty
                        <li>E-Learning</li>
                        <li>PKL</li>
                        <li>Ujian</li>
                    @endforelse
                </ul>

            </div>

        </div>

        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} {{ $schoolName }}
        </div>

    </div>
</footer>