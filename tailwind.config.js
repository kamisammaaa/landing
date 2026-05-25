import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './app/Filament/**/*.php',
        './app/View/Components/**/*.php',
    ],
    
    darkMode: 'class', // Enable dark mode via class
    
    theme: {
        extend: {
            // ─────────────────────────────────────────────────────
            // ��� CUSTOM COLORS - Crypto Theme
            // ─────────────────────────────────────────────────────
            colors: {
                // Primary Crypto Palette
                crypto: {
                    dark: '#0b0e11',        // Background utama (deep dark)
                    card: '#181a20',        // Background card/komponen
                    accent: '#7000ff',      // Ungu elektrik (primary action)
                    accentHover: '#5b00cc', // Hover state
                    success: '#0ecb81',     // Hijau bullish (profit/up)
                    danger: '#f6465d',      // Merah bearish (loss/down)
                    warning: '#f0b90b',     // Kuning warning
                    info: '#00c2f8',        // Biru info
                    border: '#2b3139',      // Border subtle
                    text: '#eaecef',        // Text primary
                    textMuted: '#848e9c',   // Text secondary
                },
                
                // Gradient Palette
                gradient: {
                    start: '#7000ff',
                    end: '#00c2f8',
                },
                
                // Override default primary untuk konsistensi
                primary: {
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                    800: '#5b21b6',
                    900: '#4c1d95',
                    950: '#2e1065',
                },
            },
            
            // ─────────────────────────────────────────────────────
            // ��� TYPOGRAPHY
            // ─────────────────────────────────────────────────────
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', 'Fira Code', ...defaultTheme.fontFamily.mono],
            },
            
            fontSize: {
                '2xs': ['0.625rem', { lineHeight: '0.75rem' }],
                '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
                '5xl': ['3rem', { lineHeight: '1' }],
            },
            
            // ─────────────────────────────────────────────────────
            // ✨ ANIMATIONS & TRANSITIONS
            // ─────────────────────────────────────────────────────
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-up': 'slideUp 0.5s ease-out',
                'gradient': 'gradient 15s ease infinite',
            },
            
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                gradient: {
                    '0%, 100%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                },
            },
            
            // ─────────────────────────────────────────────────────
            // ��� BACKDROP & EFFECTS
            // ─────────────────────────────────────────────────────
            backdropBlur: {
                xs: '2px',
            },
            
            // ─────────────────────────────────────────────────────
            // ��� SPACING & SIZING
            // ─────────────────────────────────────────────────────
            spacing: {
                '18': '4.5rem',
                '112': '28rem',
                '128': '32rem',
                '144': '36rem',
            },
            
            // ─────────────────────────────────────────────────────
            // ���️ BACKGROUND & GRADIENTS
            // ─────────────────────────────────────────────────────
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                'crypto-grid': `
                    linear-gradient(rgba(112, 0, 255, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(112, 0, 255, 0.03) 1px, transparent 1px)
                `,
            },
            
            backgroundSize: {
                'grid': '40px 40px',
            },
        },
    },
    
    // ─────────────────────────────────────────────────────
    // ��� PLUGINS
    // ✅ line-clamp SUDAH BUILT-IN di Tailwind v3.3+ (tidak perlu di-require)
    // ─────────────────────────────────────────────────────
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        // require('@tailwindcss/line-clamp'), // ← DIHAPUS: sudah built-in!
    ],
    
    // ─────────────────────────────────────────────────────
    // ⚙️ ADVANCED OPTIONS
    // ─────────────────────────────────────────────────────
    safelist: [
        // Pastikan class dinamis tidak di-purge
        { pattern: /bg-(crypto|primary|gradient)-.+/ },
        { pattern: /text-(crypto|primary)-.+/ },
        { pattern: /border-(crypto|primary)-.+/ },
        'line-clamp-1', 'line-clamp-2', 'line-clamp-3', 'line-clamp-4',
    ],
    
    corePlugins: {
        // Optional: disable preflight jika pakai CSS reset custom
        // preflight: false,
    },
}
