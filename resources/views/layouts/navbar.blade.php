<nav
    x-data="{ mobileMenu: false }"
    class="bg-[#0a0f1d]/70 backdrop-blur-md border-b border-gray-800/80 sticky top-0 z-50 transition-all duration-300"
>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- LOGO COMPONENT (DARI ADMIN SETTINGS) --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">

                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full blur opacity-40 group-hover:opacity-75 transition duration-300"></div>

                    <x-school-logo class="relative rounded-full" height="10" />
                </div>

                <span class="font-bold text-lg tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 hidden sm:block">
                    SMK BANJAR ASRI
                </span>

            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center gap-6">

                @php
                    $menus = [
                        '/' => 'Beranda',
                        '/profil' => 'Profil',
                        '/jurusan' => 'Jurusan',
                        '/berita' => 'Berita',
                        '/galeri' => 'Galeri',
                    ];
                @endphp

                @foreach($menus as $url => $label)
                    @php
                        $active = request()->path() === ltrim($url, '/') || ($url === '/' && request()->is('/'));
                    @endphp

                    <a href="{{ url($url) }}"
                       class="relative py-2 text-sm font-medium tracking-wide
                       {{ $active ? 'text-emerald-400' : 'text-gray-400 hover:text-white' }}
                       transition-colors duration-200 group">

                        {{ $label }}

                        <span class="absolute bottom-0 left-0 w-full h-[2px]
                            bg-gradient-to-r from-emerald-500 to-cyan-500
                            scale-x-0 {{ $active ? 'scale-x-100' : 'group-hover:scale-x-100' }}
                            transition-transform duration-300 origin-left">
                        </span>
                    </a>
                @endforeach

                {{-- PORTAL --}}
                <a href="/portal"
                   class="px-4 py-2 rounded-lg bg-gradient-to-r from-emerald-500 to-cyan-600 text-black font-semibold text-sm shadow-lg hover:shadow-xl transition">
                    Portal Sistem
                </a>

            </div>

            {{-- MOBILE --}}
            <button @click="mobileMenu = !mobileMenu"
                    class="md:hidden p-2 text-gray-400 hover:text-emerald-400">

                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

        {{-- MOBILE MENU --}}
        <div x-show="mobileMenu" x-cloak class="md:hidden py-4 border-t border-gray-800/50">

            @foreach($menus as $url => $label)
                <a href="{{ url($url) }}"
                   class="block px-4 py-2 text-sm text-gray-400 hover:text-white">
                    {{ $label }}
                </a>
            @endforeach

            <a href="/portal"
               class="block mt-3 px-4 py-3 bg-emerald-500 text-black text-center font-bold rounded-lg">
                PORTAL SISTEM
            </a>

        </div>

    </div>
</nav>